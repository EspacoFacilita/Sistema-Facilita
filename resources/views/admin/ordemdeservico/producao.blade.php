<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagina das Ordens Para Produção') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h1 class="mb-0">Lista das Ordens Para Produção</h1>
                        <input type="text" id="search" data-page="producao" placeholder="Buscar Data, Clientes ou Serviços" class="form-control w-25" />
                    </div>
                    <hr/>
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>CÓD.Arte</th>
                                <th>Cliente</th>
                                <th>Serviços</th>
                                <th>Funcionário</th>
                                <th>Data e Hora de Entrega</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ordemdeservicos as $ordemdeservico)
                                <tr>
                                    <td class="align-middle">{{ $ordemdeservico->id }}</td>
                                    <td class="align-middle">{{ $ordemdeservico->cliente }}</td>
                                    <td class="align-middle">{{ $ordemdeservico->servico }}</td>
                                    <td class="align-middle">{{ $ordemdeservico->nome_funcionario }}</td>
                                    <td class="align-middle">
                                    {{ date('d/m/Y', strtotime($ordemdeservico->data_de_entrega)) }} 
                                    {{ $ordemdeservico->hora_de_entrega }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column align-items-start">
                                            <span class="px-3 py-2 rounded bg-primary text-white">
                                                {{ ucfirst($ordemdeservico->status) }}
                                            </span>
                                            @php
                                                $dataHoraEntrega = \Carbon\Carbon::parse($ordemdeservico->data_de_entrega . ' ' . $ordemdeservico->hora_de_entrega);
                                            @endphp
                                            @if ($dataHoraEntrega->isPast())
                                                <span class="px-3 py-2 mt-2 mx-1 rounded bg-dark text-white">
                                                    Atrasado
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <spam class="p-2 ">
                                                <a href="{{route('adminOrdemDeServico.show', $ordemdeservico->id) }} " type="button" class="btn bg-secondary text-white fs-6">Ver Mais</a>
                                            </spam>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Nenhuma Ordem Encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($ordensVencidas->isNotEmpty())
        <div class="modal fade" id="ordensVencidasModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ordens de Serviço Vencidas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"  style="font-size: 2rem;">&times;</span>
                        </button>
                    </div>
                    <h5 class="d-flex justify-content-center me-4 m-0 m-3">Para listar todas as Ordens de Serviços atrasadas, pesquise: Atrasado</h5>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>CÓD.Arte</th>
                                    <th>Cliente</th>
                                    <th>Serviços</th>
                                    <th>Funcionário</th>
                                    <th>Data e Hora de Entrega</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordensVencidas as $ordem)
                                    <tr>
                                        <td>{{ $ordem->id }}</td>
                                        <td>{{ $ordem->cliente }}</td>
                                        <td>{{ $ordem->servico }}</td>
                                        <td>{{ $ordem->nome_funcionario }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($ordem->data_de_entrega . ' ' . $ordem->hora_de_entrega)) }}</td>
                                        <td>
                                            <span class="px-3 py-2 rounded bg-primary text-white">
                                                {{ ucfirst($ordem->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="{{ asset('js/input_search.js') }}"></script>
    <script src="{{ asset('js/ordens_vencidas.js') }}"></script>
</x-app-layout>
