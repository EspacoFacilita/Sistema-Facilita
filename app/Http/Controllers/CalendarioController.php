<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeServico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    // Retorna a view do calendário
    public function getCalendario()
    {
        return view('admin.ordemdeservico.calendario');
    }

    // Retorna os eventos do calendário
    public function getEvents()
    {
       $ordens = OrdemDeServico::where('servico_externo', 1)
        ->whereNotIn('status', ['Concluido', 'Entregue'])
        ->orderBy('data_de_recebimento', 'asc')
        ->get();


        $events = collect();

        foreach ($ordens as $ordem) {
            $inicio = Carbon::parse($ordem->dia_do_recebimento_do_controle);
            $fim = $ordem->prazo_da_impressao_data
                ? Carbon::parse($ordem->prazo_da_impressao_data)
                : $inicio;

            $hora = $ordem->hora_de_entrega ?? '00:00:00';

            // Se tiver intervalo, repete todo dia
            if ($fim->gt($inicio)) {
                for ($data = $inicio->copy(); $data->lte($fim); $data->addDay()) {
                    $events->push([
                        'id'    => $ordem->id,
                        'title' => $ordem->cliente . ' - ' . $ordem->servico,
                        'start' => $data->format('Y-m-d') . 'T' . $hora,
                        'end'   => $data->format('Y-m-d') . 'T' . $hora,
                        'url'   => route('adminOrdemDeServico.show', $ordem->id),
                        'backgroundColor' => $ordem->cor ?? 'orange',
                        'extendedProps' => [
                            'cliente' => $ordem->cliente,
                            'servico' => $ordem->servico,
                        ],
                    ]);
                }
            } else {
                // Evento único
                $events->push([
                    'id'    => $ordem->id,
                    'title' => $ordem->cliente . ' - ' . $ordem->servico,
                    'start' => $inicio->format('Y-m-d') . 'T' . $hora,
                    'end'   => $inicio->format('Y-m-d') . 'T' . $hora,
                    'url'   => route('adminOrdemDeServico.show', $ordem->id),
                    'backgroundColor' => $ordem->cor ?? 'orange',
                    'extendedProps' => [
                        'cliente' => $ordem->cliente,
                        'servico' => $ordem->servico,
                    ],
                ]);
            }
        }

        return response()->json($events);
    }

    // Atualiza a cor do evento
    public function updateColor(Request $request, $id)
    {
        $ordem = OrdemDeServico::findOrFail($id);
        $ordem->cor = $request->cor;
        $ordem->save();

        return response()->json(['success' => true]);
    }
}
