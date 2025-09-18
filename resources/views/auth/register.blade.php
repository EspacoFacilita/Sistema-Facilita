<x-app-layout>
    <x-guest-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h2 class="mb-0 text-center text-4.5xl">Cadastrar Funcionário</h2>
                <hr>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="usertype" :value="__('Função')" />
                        <select id="usertype" name="usertype" class="block mt-1 w-full" required>
                            <option value="" disabled selected>-- Selecione a função do funcionário --</option>
                            <option value="Guichê" {{ old('usertype') === 'Guichê' ? 'selected' : '' }}>Guichê</option>
                            <option value="Impressão" {{ old('usertype') === 'Impressão' ? 'selected' : '' }}>Impressão
                            </option>
                            <option value="Produção" {{ old('usertype') === 'Produção' ? 'selected' : '' }}>Produção
                            </option>
                            <option value="Caixa" {{ old('usertype') === 'Caixa' ? 'selected' : '' }}>Caixa</option>
                            <option value="Design" {{ old('usertype') === 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Admin" {{ old('usertype') === 'Admin' ? 'selected' : '' }}>Admin</option>
                            <!-- Adicione mais opções conforme necessário -->
                        </select>
                        <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmação de senha')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4 gap-1">
                        <a href="{{ route('adminFuncionario.home') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 transition ease-in-out duration-150 no-underline">
                            Cancelar
                        </a>
                        <x-primary-button>
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </x-guest-layout>
</x-app-layout>
