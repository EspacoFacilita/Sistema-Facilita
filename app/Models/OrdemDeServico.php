<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class OrdemDeServico extends Model
{
    use HasFactory;
    protected $table = 'ordem_de_servicos';
    protected $fillable = [
        'status',
        'ORC_venda',
        'cliente',
        'servico',
        'end',
        'fone',
        'valor',
        'pago',
        'falta',
        'data_de_recebimento',
        'data_de_entrega',
        'hora_de_entrega',
        'prazo_da_impressao_data',
        'prazo_da_impressao_hora',
        'dia_do_recebimento_do_controle',
        'hora_do_recebimento_do_controle',
        'servico_externo',
        'formas_de_pagamento',
        'observacoes_pedido',
        'layout',
        'embalagem',
        'observacoes_layout',
        'nome_funcionario',
    ];
}
