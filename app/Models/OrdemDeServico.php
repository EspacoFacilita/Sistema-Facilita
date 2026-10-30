<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrdemDeServico extends Model
{
    use HasFactory;
    protected $table = 'ordem_de_servicos';
    protected $fillable = [
        'status',
        'ORC_venda',
        'cliente',
        'cliente_id',
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
        'data_retirada',
        'entrada_producao',
        'entrada_impressao_e_laser',
    ];
    protected $dates = [
        'data_retirada',
    ];
    protected $casts = [
        'data_retirada' => 'datetime',
        'data_conclusao' => 'datetime',
    ];

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ordem_de_servico_user')
            ->withPivot('percentual')
            ->withTimestamps();
    }
}
