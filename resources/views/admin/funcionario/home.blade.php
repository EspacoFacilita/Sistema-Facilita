<x-app-layout>
    <div class="max-w-7xl mx-auto p-2">
        <div class="overflow-hidden">
            <div class="text-gray-900">
                <!-- Cabeçalho com ícone -->
                <div class="py-6 px-2 pb-0 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex column items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-14 text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>

                        <h1 class="mb-0 font-bold text-gray-800">Lista de Funcionários</h1>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                        <input type="text" id="search-funcionario" placeholder="Buscar Funcionário..."
                            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition no-underline">
                            Cadastrar Funcionário
                        </a>
                    </div>
                </div>
                <hr />

                @if (Session::has('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="p-2 py-0">
                    <table class="table table-hover border-collapse border border-gray-400 table-auto rounded-md">
                        <thead class="text-white">
                            <tr class="text-center bg-blue-600">
                                <th class="px-4 align-middle border border-gray-400">Código de Acesso</th>
                                <th class="align-middle border border-gray-400">Nome</th>
                                <th class="align-middle border border-gray-400">Função</th>
                                <th class="align-middle border border-gray-400">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($funcionarios as $funcionario)
                                <tr>
                                    <td class="align-middle text-center border border-gray-300">{{ $funcionario->id }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">{{ $funcionario->name }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        {{ $funcionario->usertype }}</td>
                                    <td class="align-middle text-center border border-gray-300">
                                        <div class="d-flex justify-center gap-2">
                                            <a href="{{ route('adminFuncionario.edit', $funcionario->id) }}"
                                                class="px-3 py-1 rounded text-white"
                                                style="background-color: #FF8A00; border: 2px solid #FF8A00;">
                                                Editar
                                            </a>
                                            <a href="{{ route('adminFuncionario.destroy', ['id' => $funcionario->id]) }}"
                                                onclick="return confirm('Você tem certeza?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center">
                                                Deletar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">Nenhum Funcionário Encontrado</td>
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
