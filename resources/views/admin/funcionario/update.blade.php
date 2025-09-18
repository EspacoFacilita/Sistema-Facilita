<x-app-layout>
    <x-guest-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h2 class="mb-0 text-center text-4.5xl">Editar Funcionário</h2>
                <hr>

                @if (session()->has('error'))
                    <div class="text-red-600 text-center mt-2">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('adminFuncionario.update', [$funcionario->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div class="mt-3">
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ $funcionario->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Função -->
                    <div class="mt-4">
                        <x-input-label for="usertype" :value="__('Função')" />
                        <select id="usertype" name="usertype" class="block mt-1 w-full" required>
                            <option value="" disabled>-- Selecione a função do funcionário --</option>
                            <option value="Guichê" {{ $funcionario->usertype === 'Guichê' ? 'selected' : '' }}>Guichê
                            </option>
                            <option value="Impressão" {{ $funcionario->usertype === 'Impressão' ? 'selected' : '' }}>
                                Impressão</option>
                            <option value="Produção" {{ $funcionario->usertype === 'Produção' ? 'selected' : '' }}>
                                Produção</option>
                            <option value="Caixa" {{ $funcionario->usertype === 'Caixa' ? 'selected' : '' }}>Caixa
                            </option>
                            <option value="Design" {{ $funcionario->usertype === 'Design' ? 'selected' : '' }}>Design
                            </option>
                            <option value="Admin" {{ $funcionario->usertype === 'Admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('usertype')" class="mt-2 p-0" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 p-0" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmação de senha')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 p-0" />
                    </div>
                    <div class="flex items-center justify-end mt-6 gap-1">
                        <a href="{{ route('adminFuncionario.home', ['id' => $funcionario->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 transition ease-in-out duration-150 no-underline">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Pronto') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{ asset('js/input_image.js') }}"></script>
        <script src="{{ asset('js/mascara.js') }}"></script>
    </x-guest-layout>
</x-app-layout>
