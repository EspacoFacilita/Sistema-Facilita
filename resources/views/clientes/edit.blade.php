<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar Cliente</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('clientes.update', $cliente) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nome:</label>
                <input type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" class="border p-2 w-full"
                    required>
            </div>

            <div class="mb-4">
                <label>Telefone:</label>
                <input type="text" name="fone" value="{{ old('fone', $cliente->fone) }}"
                    class="border p-2 w-full" placeholder="(99) 99999-9999" required>
            </div>

            <div class="mb-4">
                <label>Endereço:</label>
                <input type="text" name="endereco" value="{{ old('endereco', $cliente->endereco) }}"
                    class="border p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Atualizar</button>
        </form>
    </div>
</x-app-layout>
