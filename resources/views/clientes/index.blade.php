<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Clientes</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-2">
        <div class="overflow-hidden">
            <div class="text-gray-900">
                <div class="py-6 px-2 pb-0 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex column items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-14 text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v18m0-18h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75m0-18v18m0-9h-3m3-6h-3m3 12h-3" />
                        </svg>
                        <h1 class="mb-0 font-bold text-gray-800">Lista de Clientes</h1>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto md:mt-0">
                        <input type="text" id="search-cliente" placeholder="Buscar cliente..."
                            class="w-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                        <a href="{{ route('clientes.create') }}"
                            class="no-underline px-3 py-2 flex gap-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Cadastrar Cliente
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
                                    <td class="align-middle">
                                        <div class="d-flex justify-center">
                                            <div class="btn-group" role="group" aria-label="Ações Cliente">
                                                <span
                                                    class="mr-2 text-center bg-blue-600 hover:bg-blue-500 transition rounded">
                                                    <a href="{{ route('clientes.edit', $cliente) }}" type="button"
                                                        class="btn text-white fs-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-5">
                                                            <path
                                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                            <path
                                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                        </svg>
                                                    </a>
                                                </span>
                                                <span
                                                    class="text-center bg-red-700 hover:bg-red-600 transition rounded">
                                                    <form action="{{ route('clientes.destroy', $cliente) }}"
                                                        method="POST" onsubmit="return confirm('Você tem certeza que deseja excluir?')"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn text-white fs-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="size-5">
                                                                <path fill-rule="evenodd"
                                                                    d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </span>
                                            </div>
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
