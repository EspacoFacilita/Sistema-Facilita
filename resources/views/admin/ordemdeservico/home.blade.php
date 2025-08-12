<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagina das Ordens de Serviço') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h1 class="mb-0">Lista das Ordens de Serviços</h1>
                        <input type="text" id="search" data-page="home" placeholder="Buscar Status, Clientes ou Serviços" class="form-control w-25" />
                        <a href="{{ route('adminOrdemDeServico.create') }}" class="btn btn-primary">Adicionar Ordem</a>
                    </div>
                    <hr/>
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th class="align-middle">CÓD.Arte</th>
                                <th class="align-middle">Cliente</th>
                                <th class="align-middle">Serviços</th>
                                <th class="align-middle">Funcionário</th>
                                <th class="align-middle">Data e Hora de Entrega</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ordemdeservicos as $ordemdeservico)
                                <tr>
                                    <td class="align-middle text-center">{{ $ordemdeservico->id }}</td>
                                    <td class="align-middle text-center">{{ $ordemdeservico->cliente }}</td>
                                    <td class="align-middle">{{ $ordemdeservico->servico }}</td>
                                    <td class="align-middle text-center">{{ $ordemdeservico->nome_funcionario }}</td>
                                    <td class="align-middle text-center">
                                    {{ date('d/m/Y', strtotime($ordemdeservico->data_de_entrega)) }} 
                                    {{ $ordemdeservico->hora_de_entrega }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column align-items-start">
                                            @php
                                                $statusClass = '';
                                                $statusTextClass = '';
                                                switch($ordemdeservico->status) {
                                                    case 'Pendente':
                                                        $statusClass = 'bg-danger';
                                                        $statusTextClass = 'text-white'; // Bootstrap text color for better contrast
                                                        break;
                                                    case 'Impressão':
                                                        $statusClass = 'bg-warning';
                                                        $statusTextClass = 'text-dark';
                                                        break;
                                                    case 'Laser':
                                                        $statusClass = 'backgroundColorLaser'; 
                                                        $statusTextClass = 'text-darkLaser';
                                                        break;
                                                    case 'Produção':
                                                        $statusClass = 'bg-primary';
                                                        $statusTextClass = 'text-white';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-secondary';
                                                        $statusTextClass = 'text-white';
                                                }
                                            @endphp
                                            <span class="px-3 py-2 rounded {{ $statusClass }} {{ $statusTextClass }} text-center w-28">
                                                {{ ucfirst($ordemdeservico->status) }}
                                            </span>
                                            @php
                                                $dataHoraEntrega = \Carbon\Carbon::parse($ordemdeservico->data_de_entrega . ' ' . $ordemdeservico->hora_de_entrega);
                                            @endphp
                                            @if ($dataHoraEntrega->isPast())
                                                <span class="px-3 py-2 w-28 text-center mt-1 rounded bg-dark text-white">
                                                    Atrasado
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column mr-2">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <span class="mr-2 text-center">
                                                    <a href="{{route('adminOrdemDeServico.show', $ordemdeservico->id) }} " type="button" class="btn bg-secondary text-white fs-6 w-24">Ver Mais</a>
                                                </span>
                                                <span>
                                                    <a href="{{ route('adminOrdemDeServico.show', $ordemdeservico->id) }}?print=1" type="button" class="btn bg-black text-white fs-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                                    </svg>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Nenhuma Ordem Encontrada</td>
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
                        <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                    </button>
                </div>

                    <h5 class="d-flex justify-content-center me-4 m-3">Para listar todas as Ordens de Serviços atrasadas, pesquise: Atrasado</h5>
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
                                            @php
                                                $statusClass = '';
                                                $statusTextClass = '';
                                                switch($ordem->status) {
                                                    case 'Pendente':
                                                        $statusClass = 'bg-danger';
                                                        $statusTextClass = 'text-white'; // Bootstrap text color for better contrast
                                                        break;
                                                    case 'Impressão':
                                                        $statusClass = 'bg-warning';
                                                        $statusTextClass = 'text-dark';
                                                        break;
                                                    case 'Laser':
                                                        $statusClass = 'backgroundColorLaser'; 
                                                        $statusTextClass = 'text-darkLaser';
                                                        break;
                                                    case 'Produção':
                                                        $statusClass = 'bg-primary';
                                                        $statusTextClass = 'text-white';
                                                        break;
                                                    case 'Concluido':
                                                        $statusClass = 'bg-success';
                                                        $statusTextClass = 'text-white';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-secondary';
                                                        $statusTextClass = 'text-white';
                                                }
                                            @endphp
                                            <span class="px-3 py-2 rounded  {{ $statusClass }} {{ $statusTextClass }}">
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
