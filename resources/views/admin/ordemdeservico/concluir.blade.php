<x-app-layout>
    @php
        $modoEdicao = $modoEdicao ?? false;
        $funcionariosSelecionados = (array) old(
            'funcionarios',
            $modoEdicao ? $ordemServico->funcionarios->pluck('id')->all() : [],
        );
    @endphp

    <div class="max-w-7xl mx-auto p-4">
        <a href="{{ route('adminOrdemDeServico.show', $ordemServico->id) }}"
            class="mb-3 inline-flex items-center gap-1.5 border border-gray-300 rounded-md px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Voltar para a O.S.
        </a>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
            <div class="p-6 text-gray-900">
                <h1 class="mb-1 font-bold text-gray-800">
                    {{ $modoEdicao ? 'Alterar Funcionários da O.S.' : 'Concluir Ordem de Serviço' }}
                </h1>
                <p class="mb-4">O.S. #{{ $ordemServico->id }} — {{ $ordemServico->cliente }} — {{ $ordemServico->servico }}</p>

                @if (session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ $modoEdicao ? route('adminOrdemDeServico.funcionarios.update', $ordemServico->id) : route('adminOrdemDeServico.concluir', $ordemServico->id) }}"
                    method="POST">
                    @csrf
                    @if ($modoEdicao)
                        @method('PUT')
                    @endif
                    <h2 class="mb-2 text-lg font-semibold">Acesso rápido</h2>
                    <div class="row g-2 mb-4">
                        @foreach ($funcionarios->take(5) as $funcionario)
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="flex items-center gap-2 rounded border border-blue-300 bg-blue-50 p-3">
                                    <input class="form-check-input" type="checkbox" name="funcionarios[]"
                                        value="{{ $funcionario->id }}"
                                        @checked(in_array($funcionario->id, $funcionariosSelecionados))>
                                    <span>{{ $funcionario->name }}</span>
                                    <span class="ms-auto text-sm text-blue-700">Destaque</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @if ($funcionarios->count() > 5)
                        <h2 class="mb-2 text-lg font-semibold">Outros</h2>
                        <div class="row g-2 mb-4">
                            @foreach ($funcionarios->slice(5) as $funcionario)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="flex items-center gap-2 rounded border border-gray-300 p-3">
                                        <input class="form-check-input" type="checkbox" name="funcionarios[]"
                                            value="{{ $funcionario->id }}"
                                            @checked(in_array($funcionario->id, $funcionariosSelecionados))>
                                        <span>{{ $funcionario->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <p class="text-sm text-gray-600">
                        O valor da O.S. será dividido igualmente entre os funcionários selecionados.
                        @if ($modoEdicao)
                            O status e a data de conclusão serão preservados.
                        @endif
                    </p>
                    <button type="submit" class="btn btn-success">
                        {{ $modoEdicao ? 'Salvar funcionários' : 'Concluir O.S.' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
