<x-app-layout>
    <div class="max-w-7xl mx-auto p-2">
        <div class="overflow-hidden">
            <div class="text-gray-900">
                <!-- Cabeçalho -->
                <div class="py-6 px-2 pb-0 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex column items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-14 h-14 text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>

                        <h1 class="mb-0 font-bold text-gray-800">Entregues</h1>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                        <form action="{{ route('adminOrdemDeServico.service-orders.delete-old') }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja deletar todas as ordens de serviço entregues há mais de 6 meses?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Deletar Ordens Antigas
                            </button>
                        </form>
                        <input type="text" id="search" data-page="entregues"
                            placeholder="Buscar Ordens de Serviço..."
                            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                    </div>
                </div>
                <hr>

                @if (Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="p-2 py-0">
                    <table class="table table-hover border-collapse border border-gray-400 table-auto rounded-md">
                        <thead class="text-white">
                            <tr class="text-center">
                                <th class="px-4 align-middle border border-gray-400">CÓD.Arte</th>
                                <th class="align-middle border border-gray-400">Cliente</th>
                                <th class="align-middle border border-gray-400">Serviços</th>
                                <th class="align-middle border border-gray-400">Funcionário</th>
                                <th class="align-middle border border-gray-400">Data e Hora de Entrega</th>
                                <th class="align-middle border border-gray-400">Status</th>
                                <th class="align-middle border border-gray-400">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ordemdeservicos as $ordemdeservico)
                                <tr>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ $ordemdeservico->id }}</td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ $ordemdeservico->cliente }}</td>
                                    <td class="align-middle text-center border border-gray-300"
                                        style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $ordemdeservico->servico }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ $ordemdeservico->nome_funcionario }}</td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ date('d/m/Y', strtotime($ordemdeservico->data_de_entrega)) }}
                                        {{ $ordemdeservico->hora_de_entrega }}
                                    </td>
                                    <td class="align-middle border border-gray-300">
                                        <span
                                            class="px-3 py-2 rounded w-28 text-center text-white bg-success">Entregue</span>
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        <div class="btn-group justify-center" role="group">
                                            <a href="{{ route('adminOrdemDeServico.show', $ordemdeservico->id) }}"
                                                class="btn bg-gray-700 text-white rounded px-3 py-1">
                                                Ver Mais
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Nenhuma ordem entregue encontrada</td>
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
