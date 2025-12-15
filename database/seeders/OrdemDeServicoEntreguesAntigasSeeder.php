<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdemDeServico;
use Carbon\Carbon;

class OrdemDeServicoEntreguesAntigasSeeder extends Seeder
{
    public function run(): void
    {
        $dataEntrega = Carbon::now()->subMonths(7); // mais de 6 meses atrás

        for ($i = 1; $i <= 100; $i++) {
            OrdemDeServico::create([
                'status' => 'Entregue',
                'cor' => null,
                'ORC_venda' => 'ORC-' . rand(1000, 9999),
                'cliente' => 'Cliente Teste ' . $i,
                'cliente_id' => null,
                'servico' => 'Serviço Teste',
                'end' => 'Rua Teste, 123',
                'fone' => '(11) 99999-9999',
                'valor' => '100,00',
                'pago' => 'Sim',
                'falta' => null,
                'data_de_recebimento' => $dataEntrega->copy()->subDays(5)->toDateString(),
                'data_de_entrega' => $dataEntrega->toDateString(),
                'hora_de_entrega' => '10:00',
                'prazo_da_impressao_data' => null,
                'prazo_da_impressao_hora' => null,
                'dia_do_recebimento_do_controle' => null,
                'hora_do_recebimento_do_controle' => null,
                'servico_externo' => false,
                'formas_de_pagamento' => 'Dinheiro',
                'observacoes_pedido' => 'Seeder de teste para exclusão automática',
                'layout' => null,
                'embalagem' => null,
                'observacoes_layout' => null,
                'nome_funcionario' => 'Funcionário Teste',
                'data_retirada' => $dataEntrega->copy()->addDays(1),
                'entrada_producao' => $dataEntrega->copy()->subDays(3),
                'entrada_impressao_e_laser' => $dataEntrega->copy()->subDays(2),
            ]);
        }
    }
}
