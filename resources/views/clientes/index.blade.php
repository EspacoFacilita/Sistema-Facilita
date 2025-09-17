<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Clientes</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-2">
        <div class="overflow-hidden">
            <div class="text-gray-900">
                <!-- Cabeçalho com ícone -->
                <div class="py-6 px-2 pb-0 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex column items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-14 text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v18m0-18h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75m0-18v18m0-9h-3m3-6h-3m3 12h-3" />
                        </svg>
                        <h1 class="mb-0 font-bold text-gray-800">Lista de Clientes</h1>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto mt-2 md:mt-0">
                        <input type="text" id="search-cliente" placeholder="Buscar Cliente..."
                            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                        <a href="{{ route('clientes.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition no-underline">
                            Novo Cliente
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
                    <table
                        class="table table-hover border-collapse border border-gray-400 table-auto rounded-md w-full">
                        <thead class="text-white">
                            <tr class="text-center bg-blue-600">
                                <th class="px-4 py-2 align-middle border border-gray-400">Nome</th>
                                <th class="px-4 py-2 align-middle border border-gray-400">Telefone</th>
                                <th class="px-4 py-2 align-middle border border-gray-400">Endereço</th>
                                <th class="px-4 py-2 align-middle border border-gray-400">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                                <tr>
                                    <td class="align-middle text-center border border-gray-300">{{ $cliente->nome }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">{{ $cliente->fone }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">{{ $cliente->endereco }}
                                    </td>
                                    <td class="align-middle text-center border border-gray-300">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('clientes.edit', $cliente) }}"
                                                class="px-3 py-1 rounded text-white"
                                                style="background-color: #FF8A00; border: 2px solid #FF8A00;">
                                                Editar
                                            </a>
                                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition"
                                                    onclick="return confirm('Deseja excluir?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">Nenhum Cliente Encontrado</td>
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
