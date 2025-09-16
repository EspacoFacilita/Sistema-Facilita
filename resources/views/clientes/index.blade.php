<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Clientes</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('clientes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Novo Cliente</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Nome</th>
                    <th class="p-2">Telefone</th>
                    <th class="p-2">Endereço</th>
                    <th class="p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="border-t">
                        <td class="p-2">{{ $cliente->nome }}</td>
                        <td class="p-2">{{ $cliente->telefone }}</td>
                        <td class="p-2">{{ $cliente->endereco }}</td>
                        <td class="p-2">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600"
                                    onclick="return confirm('Deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
