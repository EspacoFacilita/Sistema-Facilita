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
        $ordens = OrdemDeServico::where('status', 'Produção')
        ->where('servico_externo', 1) // só mostra os com servico_externo = 1
        ->orderBy('data_de_recebimento', 'asc')
        ->get();


        $events = collect();

        foreach ($ordens as $ordem) {
            $inicio = \Carbon\Carbon::parse($ordem->data_de_entrega);
            $fim = $ordem->prazo_da_impressao_data 
                ? \Carbon\Carbon::parse($ordem->prazo_da_impressao_data) 
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
                ]);
            }
        }

        return response()->json($events);
    }



    public function updateColor(Request $request, $id)
{
    $ordem = OrdemDeServico::findOrFail($id);
    $ordem->cor = $request->cor;
    $ordem->save();

    return response()->json(['success' => true]);
}


}
