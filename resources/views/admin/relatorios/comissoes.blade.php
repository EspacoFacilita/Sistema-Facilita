<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="mb-4 font-bold text-gray-800">Relatório de Comissões por Funcionário</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('adminComissoes.index') }}" method="GET"
                    class="row g-3 align-items-end mb-4">
                    <div class="col-12 col-md-5">
                        <label for="user_id" class="form-label">Funcionário</label>
                        <select id="user_id" name="user_id" class="form-select" required>
                            <option value="">Selecione um funcionário</option>
                            @foreach ($funcionarios as $funcionario)
                                <option value="{{ $funcionario->id }}"
                                    @selected((string) request('user_id') === (string) $funcionario->id)>
                                    {{ $funcionario->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="month" class="form-label">Mês</label>
                        <select id="month" name="month" class="form-select">
                            @foreach ([1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'] as $numero => $nome)
                                <option value="{{ $numero }}" @selected($month === $numero)>{{ $nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="year" class="form-label">Ano</label>
                        <input id="year" name="year" type="number" min="2000" max="2100"
                            value="{{ $year }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </form>

                <div class="card border-success mb-4">
                    <div class="card-body">
                        <h2 class="card-title text-uppercase text-sm font-semibold text-gray-600">
                            Valor total agregado no mês
                        </h2>
                        <p class="mb-0 text-3xl font-bold text-green-700">
                            R$ {{ number_format($totalAgregadoCentavos / 100, 2, ',', '.') }}
                        </p>
                        @if ($funcionarioSelecionado)
                            <p class="mb-0 mt-1 text-gray-600">
                                {{ $funcionarioSelecionado->name }} — {{ sprintf('%02d/%04d', $month, $year) }}
                            </p>
                        @endif
                    </div>
                </div>

                @if (!$funcionarioSelecionado)
                    <p class="text-gray-600">Selecione um funcionário para consultar as ordens concluídas no período.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover border-collapse border border-gray-400 table-auto rounded-md">
                            <thead class="text-white bg-green-600">
                                <tr class="text-center">
                                    <th class="align-middle border border-gray-400">O.S.</th>
                                    <th class="align-middle border border-gray-400">Data de Conclusão</th>
                                    <th class="align-middle border border-gray-400">Valor Total da O.S.</th>
                                    <th class="align-middle border border-gray-400">Participação</th>
                                    <th class="align-middle border border-gray-400">Valor Agregado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ordens as $linha)
                                    <tr>
                                        <td class="align-middle text-center border border-gray-300">
                                            {{ $linha['ordem']->id }}
                                        </td>
                                        <td class="align-middle text-center border border-gray-300">
                                            {{ $linha['ordem']->data_conclusao->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="align-middle text-center border border-gray-300">
                                            R$ {{ number_format($linha['valor_total_centavos'] / 100, 2, ',', '.') }}
                                        </td>
                                        <td class="align-middle text-center border border-gray-300">
                                            {{ rtrim(rtrim(number_format($linha['percentual'], 6, ',', '.'), '0'), ',') }}%
                                        </td>
                                        <td class="align-middle text-center border border-gray-300">
                                            R$ {{ number_format($linha['valor_agregado_centavos'] / 100, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-gray-600">
                                            Nenhuma ordem concluída para este funcionário no período.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
