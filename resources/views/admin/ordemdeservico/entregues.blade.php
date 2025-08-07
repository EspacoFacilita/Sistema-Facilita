<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ordens Entregues') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <div class="">
                        <div class="d-flex align-items-center col mb-3">
                            <h1 class="m-0 me-auto p-2 col-6">Lista de Ordens Entregues</h1>
                            <div class="p-2 d-flex flex-row col-6">
                                <form action="{{ route('adminOrdemDeServico.service-orders.delete-old') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar todas as ordens de serviço entregues há mais de 6 meses?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" my-0 mx-3 btn btn-danger">Deletar Ordens Antigas </button>
                                </form>
                                <input type="text" id="search" data-page="entregues" placeholder="Buscar Ordens de Serviço..." class="p-2 my-0 form-control w-50" />
                            </div>
                            
                        </div>
                        
                    </div>
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
                                        <span class=" px-3 py-2 rounded text-white bg-success">Entregue</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('adminOrdemDeServico.show', $ordemdeservico->id) }}" class="btn btn-secondary">Ver Mais</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Nenhuma ordem entregue encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/input_search.js') }}"></script>
</x-app-layout>
