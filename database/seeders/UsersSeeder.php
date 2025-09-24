<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
            'usertype' => 'Admin',
        ]);
        for ($i = 1; $i <= 1000; $i++) {
            DB::table('ordem_de_servicos')->insert([
                'status' => 'Entregue',
                'cor' => null,
                'ORC_venda' => null,
                'cliente' => "Cliente {$i}",
                'servico' => 'KIT PREMIUM ESCOLINHA/COLEGIO SIMPLES',
                'end' => "{$i} Rua Agostinho Carlos Santiago",
                'fone' => '(88) 99318-4948',
                'valor' => 'R$ 99,99',
                'pago' => 'sim',
                'falta' => null,
                'data_de_recebimento' => Carbon::now()->toDateString(),
                'data_de_entrega' => Carbon::now()->addDays(2)->toDateString(),
                'hora_de_entrega' => '15:53',
                'prazo_da_impressao_data' => Carbon::now()->addDays(2)->toDateString(),
                'prazo_da_impressao_hora' => null,
                'dia_do_recebimento_do_controle' => Carbon::now()->toDateString(),
                'hora_do_recebimento_do_controle' => null,
                'servico_externo' => '1',
                'formas_de_pagamento' => 'pix',
                'observacoes_pedido' => '9999',
                'layout' => null,
                'embalagem' => null,
                'observacoes_layout' => null,
                'nome_funcionario' => 'CAIXA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'data_retirada' => Carbon::now()->toDateTimeString(),
                'cliente_id' => $i,
            ]);
        }
    }
}
