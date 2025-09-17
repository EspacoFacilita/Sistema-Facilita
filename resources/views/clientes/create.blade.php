<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Novo Cliente</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('clientes.store') }}">
            @csrf
            <div class="mb-4">
                <label>Nome:</label>
                <input type="text" name="nome" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label>Telefone:</label>
                <input type="text" name="fone" id="fone"
                       placeholder="(99) 99999-9999"
                       class="border p-2 w-full"
                       value="{{ old('fone') }}" required>
            </div>
            <div class="mb-4">
                <label>Endereço:</label>
                <input type="text" name="endereco" class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#fone').mask('(00) 00000-0000');
        });
    </script>
</x-app-layout>
