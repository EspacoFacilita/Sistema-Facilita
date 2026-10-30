<x-app-layout>
    <div class="max-w-7xl mx-auto p-2">
        <div class="overflow-hidden">
            <div class="text-gray-900">
                <div class="py-6 px-2 pb-0 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-14 h-14 text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>

                        <h1 class="mb-0 font-bold text-gray-800">Ordens Concluídas</h1>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                        <button id="btn-hoje"
                            class="px-3 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg shadow transition">
                            Hoje
                        </button>
                        <div class="flex rounded-lg focus-within:ring-2 focus-within:ring-blue-500">
                            <input type="text" id="search" data-page="concluidas"
                                placeholder="Buscar Ordens de Serviço..."
                                class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none" />

                            <button type="submit" aria-label="Pesquisar"
                                class="px-3 py-2 bg-white text-white rounded-r-lg border-gray-300 focus:outline-none"
                                style="border: 1px solid #dce1e7; border-left: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 text-gray-500">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                @if (Session::has('success'))
                    <div x-data="{ show: true, progress: 100 }" x-init="setInterval(() => { if (progress > 0) progress -= 1 }, 40);
                    setTimeout(() => { show = false }, 2500)" x-show="show" x-cloak
                        x-transition:enter="transform ease-out duration-500 transition"
                        x-transition:enter-start="translate-x-10 opacity-0"
                        x-transition:enter-end="translate-x-0 opacity-100"
                        x-transition:leave="transform ease-in duration-500 transition"
                        x-transition:leave-start="translate-x-0 opacity-100"
                        x-transition:leave-end="translate-x-10 opacity-0"
                        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 inline-flex items-center gap-2 no-print">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('warning'))
                    <div x-data="{ show: true, progress: 100 }" x-init="setInterval(() => { if (progress > 0) progress -= 1 }, 40);
                    setTimeout(() => { show = false }, 8000)" x-show="show" x-cloak
                        x-transition:enter="transform ease-out duration-500 transition"
                        x-transition:enter-start="translate-x-10 opacity-0"
                        x-transition:enter-end="translate-x-0 opacity-100"
                        x-transition:leave="transform ease-in duration-500 transition"
                        x-transition:leave-start="translate-x-0 opacity-100"
                        x-transition:leave-end="translate-x-10 opacity-0"
                        class="fixed top-20 right-4 bg-amber-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 inline-flex items-center gap-2 no-print">
                        {{ Session::get('warning') }}
                    </div>
                @endif
                <div class="p-2 py-0">
                    <table class="table table-hover border-collapse border border-gray-400 table-auto rounded-md">
                        <thead class="text-white bg-green-600">
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
                                        {{ $ordemdeservico->id }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300"
                                        style='max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>
                                        {{ $ordemdeservico->cliente }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300"
                                        style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $ordemdeservico->servico }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ $ordemdeservico->nome_funcionario }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ date('d/m/Y', strtotime($ordemdeservico->data_de_entrega)) }}
                                        {{ $ordemdeservico->hora_de_entrega }}
                                    </td>

                                    <!-- Status -->
                                    <td class="align-middle text-center border border-gray-300">
                                        <span class="px-3 py-2 rounded bg-green-600 text-white font-medium">
                                            Concluído
                                        </span>
                                    </td>

                                    <!-- Ações -->
                                    <td class="align-middle text-center border border-gray-300">
                                        <div class="d-flex justify-center">
                                            <div class="btn-group" role="group">
                                                {{-- Ver mais --}}
                                                <span class="mr-2 text-center bg-gray-700 rounded">
                                                    <a href="{{ route('adminOrdemDeServico.show', $ordemdeservico->id) }}"
                                                        class="btn text-white fs-6" title="Ver Mais">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423
                                                              7.51 7.36 4.5 12 4.5c4.638 0 8.573
                                                              3.007 9.963 7.178.07.207.07.431
                                                              0 .639C20.577 16.49 16.64 19.5
                                                              12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </a>
                                                </span>
                                                <span>
                                                    <a href="{{ route('adminOrdemDeServico.show', $ordemdeservico->id) }}?print=1"
                                                        type="button" class="btn bg-black text-white fs-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415
                                                                42.415 0 0 1 10.56 0m-10.56
                                                                0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66
                                                                18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12
                                                                1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34
                                                                18m11.318 0h1.091A2.25 2.25 0 0 0 21
                                                                15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055
                                                                48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25
                                                                2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015
                                                                1.837-2.175a48.041 48.041 0 0
                                                                1 1.913-.247m10.5 0a48.536
                                                                48.536 0 0 0-10.5
                                                                0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621
                                                                0-1.125.504-1.125 1.125v3.659M18
                                                                10.5h.008v.008H18V10.5Zm-3
                                                                0h.008v.008H15V10.5Z" />
                                                        </svg>
                                                    </a>
                                                </span>
                                                @if (Auth::user()->usertype === 'Caixa' || Auth::user()->usertype === 'Admin')
                                                    {{-- Entregar --}}
                                                    <span class="ml-2 text-center bg-emerald-600 rounded">
                                                        @if ($ordemdeservico->funcionarios_count > 0)
                                                            <form action="{{ route('adminOrdemDeServico.entregar', $ordemdeservico->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="mx-1 d-flex align-items-center btn text-white">Entregar</button>
                                                            </form>
                                                        @else
                                                            <a href="{{ route('adminOrdemDeServico.entregar.form', $ordemdeservico->id) }}"
                                                                class="mx-1 d-flex align-items-center btn text-white">Entregar</a>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Nenhuma ordem concluída encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('btn-hoje').addEventListener('click', function() {
            const hoje = new Date();
            const dia = String(hoje.getDate()).padStart(2, '0');
            const mes = String(hoje.getMonth() + 1).padStart(2, '0');
            const ano = hoje.getFullYear();
            document.getElementById('search').value = `${dia}/${mes}/${ano}`;

            // se quiser já disparar a busca automática:
            document.getElementById('search').dispatchEvent(new Event('input'));
        });
    </script>
    <script src="{{ asset('js/input_search.js') }}"></script>
</x-app-layout>
