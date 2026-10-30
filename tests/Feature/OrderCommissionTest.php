<?php

use App\Models\OrdemDeServico;
use App\Models\User;
use Illuminate\Support\Facades\DB;

function createCommissionTestOrder(): OrdemDeServico
{
    return OrdemDeServico::create([
        'status' => 'Produção',
        'ORC_venda' => null,
        'cliente' => 'Cliente de teste',
        'cliente_id' => null,
        'servico' => 'Serviço de teste',
        'end' => null,
        'fone' => '88999999999',
        'valor' => 'R$ 120,00',
        'pago' => 'sim',
        'falta' => null,
        'data_de_recebimento' => now()->toDateString(),
        'data_de_entrega' => now()->toDateString(),
        'hora_de_entrega' => '12:00',
        'prazo_da_impressao_data' => null,
        'prazo_da_impressao_hora' => null,
        'dia_do_recebimento_do_controle' => null,
        'hora_do_recebimento_do_controle' => null,
        'servico_externo' => true,
        'formas_de_pagamento' => 'pix',
        'observacoes_pedido' => 'Teste',
        'layout' => null,
        'embalagem' => null,
        'observacoes_layout' => null,
        'nome_funcionario' => 'Atendimento',
    ]);
}

it('does not show the legacy employee before an order is concluded', function () {
    $admin = createCommissionTestUser('Admin');
    $order = createCommissionTestOrder();

    $this->actingAs($admin)
        ->get(route('adminOrdemDeServico.show', $order->id))
        ->assertOk()
        ->assertDontSee('Atendimento');

    $order->update(['status' => 'Concluido']);

    $this->get(route('adminOrdemDeServico.show', $order->id))
        ->assertOk()
        ->assertSee('Atendimento');
});

function createCommissionTestUser(string $name, ?int $id = null): User
{
    return User::forceCreate(array_filter([
        'id' => $id,
        'name' => $name,
        'password' => 'password',
        'usertype' => 'Admin',
    ], fn ($value) => $value !== null));
}

it('concludes an order and splits participation equally among selected employees', function () {
    $admin = createCommissionTestUser('Admin');
    $firstEmployee = createCommissionTestUser('Funcionário 1');
    $secondEmployee = createCommissionTestUser('Funcionário 2');
    $commissionViewer = createCommissionTestUser('Visualizador de comissões', 6);
    $order = createCommissionTestOrder();

    $this->actingAs($admin)
        ->post(route('adminOrdemDeServico.concluir', $order->id), [
            'funcionarios' => [$firstEmployee->id, $secondEmployee->id],
        ])
        ->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    $order->refresh();

    expect($order->status)->toBe('Concluido')
        ->and($order->data_conclusao)->not->toBeNull()
        ->and($order->funcionarios)->toHaveCount(2)
        ->and((float) $order->funcionarios->first()->pivot->percentual)->toBe(50.0)
        ->and((float) $order->funcionarios->last()->pivot->percentual)->toBe(50.0);

    $this->actingAs($admin)
        ->get(route('adminComissoes.index', [
            'user_id' => $firstEmployee->id,
            'month' => $order->data_conclusao->month,
            'year' => $order->data_conclusao->year,
        ]))
        ->assertForbidden();

    $this->actingAs($commissionViewer)
        ->get(route('adminComissoes.index', [
            'user_id' => $firstEmployee->id,
            'month' => $order->data_conclusao->month,
            'year' => $order->data_conclusao->year,
        ]))
        ->assertOk()
        ->assertSee('R$ 60,00');

    $this->get(route('adminOrdemDeServico.show', $order->id))
        ->assertOk()
        ->assertSee('Funcionário 1')
        ->assertSee('Funcionário 2');
});

it('requires at least one employee before concluding an order', function () {
    $admin = createCommissionTestUser('Admin');
    $order = createCommissionTestOrder();

    $this->actingAs($admin)
        ->from(route('adminOrdemDeServico.concluir.form', $order->id))
        ->post(route('adminOrdemDeServico.concluir', $order->id), ['funcionarios' => []])
        ->assertSessionHasErrors('funcionarios');

    expect($order->fresh()->status)->toBe('Produção')
        ->and(DB::table('ordem_de_servico_user')->where('ordem_de_servico_id', $order->id)->count())->toBe(0);
});

it('assigns the full participation to a single selected employee', function () {
    $admin = createCommissionTestUser('Admin');
    $employee = createCommissionTestUser('Funcionário');
    $order = createCommissionTestOrder();

    $this->actingAs($admin)
        ->get(route('adminOrdemDeServico.concluir.form', $order->id))
        ->assertOk()
        ->assertSee('Funcionários em destaque');

    $this->post(route('adminOrdemDeServico.concluir', $order->id), [
        'funcionarios' => [$employee->id],
    ])->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    expect((float) $order->fresh()->funcionarios->first()->pivot->percentual)->toBe(100.0);
});

it('shows employees 32, 34, and 33 first in the employee selection form', function () {
    $admin = createCommissionTestUser('Admin', 7);
    createCommissionTestUser('Funcionário 40', 40);
    createCommissionTestUser('Funcionário 32', 32);
    createCommissionTestUser('Funcionário 34', 34);
    createCommissionTestUser('Funcionário 33', 33);
    $order = createCommissionTestOrder();

    $this->actingAs($admin)
        ->get(route('adminOrdemDeServico.concluir.form', $order->id))
        ->assertOk()
        ->assertSeeInOrder(['value="32"', 'value="34"', 'value="33"', 'value="40"']);
});

it('allows selecting employees when delivering an already concluded order', function () {
    $admin = createCommissionTestUser('Admin');
    $firstEmployee = createCommissionTestUser('Funcionário 1');
    $secondEmployee = createCommissionTestUser('Funcionário 2');
    $order = createCommissionTestOrder();
    $completionDate = now()->subDay();

    $order->update([
        'status' => 'Concluido',
        'data_conclusao' => $completionDate,
    ]);

    $this->actingAs($admin)
        ->get(route('adminOrdemDeServico.entregar.form', $order->id))
        ->assertOk()
        ->assertSee('Entregar Ordem de Serviço');

    $this->post(route('adminOrdemDeServico.entregar', $order->id), [
        'funcionarios' => [$firstEmployee->id, $secondEmployee->id],
    ])->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    $order->refresh();

    expect($order->status)->toBe('Entregue')
        ->and($order->data_conclusao->toDateTimeString())->toBe($completionDate->toDateTimeString())
        ->and($order->funcionarios)->toHaveCount(2)
        ->and((float) $order->funcionarios->first()->pivot->percentual)->toBe(50.0)
        ->and((float) $order->funcionarios->last()->pivot->percentual)->toBe(50.0);
});

it('delivers an order without asking to select employees when participation already exists', function () {
    $admin = createCommissionTestUser('Admin');
    $firstEmployee = createCommissionTestUser('Funcionário 1');
    $secondEmployee = createCommissionTestUser('Funcionário 2');
    $order = createCommissionTestOrder();
    $completionDate = now()->subDay();

    $order->update([
        'status' => 'Concluido',
        'data_conclusao' => $completionDate,
    ]);
    $order->funcionarios()->attach([
        $firstEmployee->id => ['percentual' => 50],
        $secondEmployee->id => ['percentual' => 50],
    ]);

    $this->actingAs($admin)
        ->post(route('adminOrdemDeServico.entregar', $order->id))
        ->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    $order->refresh();

    expect($order->status)->toBe('Entregue')
        ->and($order->data_conclusao->toDateTimeString())->toBe($completionDate->toDateTimeString())
        ->and($order->funcionarios)->toHaveCount(2)
        ->and((float) $order->funcionarios->first()->pivot->percentual)->toBe(50.0)
        ->and((float) $order->funcionarios->last()->pivot->percentual)->toBe(50.0);
});

it('allows changing employees on a concluded order without changing its status or completion date', function () {
    $admin = createCommissionTestUser('Admin');
    $firstEmployee = createCommissionTestUser('Funcionário 1');
    $secondEmployee = createCommissionTestUser('Funcionário 2');
    $thirdEmployee = createCommissionTestUser('Funcionário 3');
    $order = createCommissionTestOrder();
    $completionDate = now()->subDay();

    $order->update([
        'status' => 'Concluido',
        'data_conclusao' => $completionDate,
    ]);
    $order->funcionarios()->attach([
        $firstEmployee->id => ['percentual' => 100],
    ]);

    $this->actingAs($admin)
        ->get(route('adminOrdemDeServico.funcionarios.edit', $order->id))
        ->assertOk()
        ->assertSee('Alterar Funcionários da O.S.');

    $this->actingAs($admin)
        ->put(route('adminOrdemDeServico.funcionarios.update', $order->id), [
            'funcionarios' => [$secondEmployee->id, $thirdEmployee->id],
        ])
        ->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    $order->refresh();

    expect($order->status)->toBe('Concluido')
        ->and($order->data_conclusao->toDateTimeString())->toBe($completionDate->toDateTimeString())
        ->and($order->funcionarios)->toHaveCount(2)
        ->and((float) $order->funcionarios->first()->pivot->percentual)->toBe(50.0)
        ->and((float) $order->funcionarios->last()->pivot->percentual)->toBe(50.0);
});

it('includes an older delivered order in commissions after employees are assigned', function () {
    $admin = createCommissionTestUser('Admin');
    $employee = createCommissionTestUser('Funcionário');
    $order = createCommissionTestOrder();
    $deliveryDate = now()->subMonth()->setDay(15);

    $order->update([
        'status' => 'Entregue',
        'data_retirada' => $deliveryDate,
        'data_conclusao' => null,
    ]);

    $this->actingAs($admin)
        ->put(route('adminOrdemDeServico.funcionarios.update', $order->id), [
            'funcionarios' => [$employee->id],
        ])
        ->assertRedirect(route('adminOrdemDeServico.show', $order->id));

    $order->refresh();

    expect($order->data_conclusao->toDateString())->toBe($deliveryDate->toDateString());

    $commissionViewer = createCommissionTestUser('Visualizador de comissões', 6);

    $this->actingAs($commissionViewer)
        ->get(route('adminComissoes.index', [
            'user_id' => $employee->id,
            'month' => $deliveryDate->month,
            'year' => $deliveryDate->year,
        ]))
        ->assertOk()
        ->assertSee('R$ 120,00')
        ->assertSee((string) $order->id);
});
