<x-app-layout>
    <x-guest-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h2 class="mb-0 text-center text-4.5xl">Editar Cliente</h2>
                <hr>

                <form method="POST" action="{{ route('clientes.update', $cliente) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div class="mt-3">
                        <x-input-label for="nome" :value="__('Nome')" />
                        <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome"
                            value="{{ old('nome', $cliente->nome) }}" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2 p-0" />
                    </div>

                    <!-- Telefone -->
                    <div class="mt-4">
                        <x-input-label for="fone" :value="__('Telefone')" />
                        <x-text-input id="fone" class="block mt-1 w-full" type="text" name="fone"
                            value="{{ old('fone', $cliente->fone) }}" placeholder="(99) 99999-9999" required />
                        <x-input-error :messages="$errors->get('fone')" class="mt-2 p-0" />
                    </div>

                    <!-- Endereço -->
                    <div class="mt-4">
                        <x-input-label for="endereco" :value="__('Endereço')" />
                        <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco"
                            value="{{ old('endereco', $cliente->endereco) }}" required />
                        <x-input-error :messages="$errors->get('endereco')" class="mt-2 p-0" />
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end mt-6 gap-1">
                        <a href="{{ route('clientes.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 transition ease-in-out duration-150 no-underline">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Atualizar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery Mask Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#fone').mask('(00) 00000-0000');
            });
        </script>
    </x-guest-layout>
</x-app-layout>
