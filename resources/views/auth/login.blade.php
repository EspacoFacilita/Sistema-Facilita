<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-30 h-20 fill-current text-gray-500" />
            </a>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4 col-12 d-flex row">
                    <div class="col-6">
                        <x-input-label for="usuarioId" :value="__('Código')" />
                        <x-text-input id="usuarioId" class="block mt-1 w-full"
                                      type="text"
                                      name="id"
                                      required  oninput="somenteNumeros(event)" />
                        <x-input-error :messages="$errors->get('id')" class="mt-2" />
                    </div>
                    <div class="col-6">
                        <!-- Campo de entrada para o nome do usuário -->
                        <x-input-label for="resultadoNome" :value="__('Nome do Usuário')" />
                        <x-text-input id="resultadoNome" class="block mt-1 w-full" type="text" name="nome" readonly />
                    </div>
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="d-flex justify-content-center">
                    <x-primary-button class="m-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</x-guest-layout>
