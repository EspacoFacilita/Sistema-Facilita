<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use UnexpectedValueException;

class CommissionReportController extends Controller
{
    public function index(Request $request)
    {
        abort_unless((int) $request->user()->getKey() === 6, 403);

        $filters = $request->validate([
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'month' => ['nullable', 'integer', 'between:1,12'],
            'year' => ['nullable', 'integer', 'between:2000,2100'],
        ]);

        $month = (int) ($filters['month'] ?? now()->month);
        $year = (int) ($filters['year'] ?? now()->year);
        $funcionarios = User::orderBy('name')->get();
        $funcionarioSelecionado = null;
        $ordens = collect();
        $totalAgregadoCentavos = 0;

        if (!empty($filters['user_id'])) {
            $funcionarioSelecionado = User::findOrFail($filters['user_id']);
            $inicio = Carbon::createFromDate($year, $month, 1, 'America/Sao_Paulo')->startOfMonth();
            $fim = $inicio->copy()->endOfMonth();

            $ordens = $funcionarioSelecionado->ordensDeServico()
                ->whereIn('ordem_de_servicos.status', ['Concluido', 'Entregue'])
                ->whereBetween('ordem_de_servicos.data_conclusao', [$inicio, $fim])
                ->orderBy('ordem_de_servicos.data_conclusao')
                ->get()
                ->map(function ($ordem) use (&$totalAgregadoCentavos) {
                    $valorTotalCentavos = $this->valorEmCentavos($ordem->valor);
                    $percentual = (float) $ordem->pivot->percentual;
                    $valorAgregadoCentavos = (int) round(
                        $valorTotalCentavos * $percentual / 100,
                        0,
                        PHP_ROUND_HALF_UP
                    );

                    $totalAgregadoCentavos += $valorAgregadoCentavos;

                    return [
                        'ordem' => $ordem,
                        'valor_total_centavos' => $valorTotalCentavos,
                        'percentual' => $percentual,
                        'valor_agregado_centavos' => $valorAgregadoCentavos,
                    ];
                });
        }

        return view('admin.relatorios.comissoes', compact(
            'funcionarios',
            'funcionarioSelecionado',
            'month',
            'year',
            'ordens',
            'totalAgregadoCentavos'
        ));
    }

    private function valorEmCentavos(string $valor): int
    {
        $normalizado = preg_replace('/[^\d,.-]/u', '', $valor);

        if ($normalizado === null || $normalizado === '') {
            throw new UnexpectedValueException('O valor de uma ordem de serviço não está em um formato monetário válido.');
        }

        if (str_contains($normalizado, ',')) {
            $normalizado = str_replace('.', '', $normalizado);
            $normalizado = str_replace(',', '.', $normalizado);
        }

        if (!preg_match('/^-?\d+(?:\.\d{1,2})?$/', $normalizado)) {
            throw new UnexpectedValueException('O valor de uma ordem de serviço não está em um formato monetário válido.');
        }

        return (int) round((float) $normalizado * 100, 0, PHP_ROUND_HALF_UP);
    }
}
