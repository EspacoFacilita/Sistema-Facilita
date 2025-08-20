<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeServico;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function getCalendario()
    {
        return view('admin.ordemdeservico.calendario');
    }

    public function getEvents()
    {
        $ordemdeservicos = OrdemDeServico::where('servico_externo', true)
    ->where('status', 'Produção')
    ->get();


        $events = $ordemdeservicos->map(function ($ordem) {
            return [
                'id'    => $ordem->id,
                'title' => $ordem->cliente . ' - ' . $ordem->servico,
                'start' => $ordem->data_de_entrega  . 'T' . ($ordem->hora_de_entrega ?? '00:00:00'),
                'end'   => $ordem->data_de_entrega . 'T' . ($ordem->hora_de_entrega ?? '00:00:00'),
                'url'   => route('adminOrdemDeServico.show', $ordem->id),
            ];
        });

        return response()->json($events);
    }

}
