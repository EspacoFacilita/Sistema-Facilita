
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between d-flex align-items-center"   >
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Funcionário') }}
            </span>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 col-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                    @endif
                    <form action="{{ route('adminFuncionario.update',[$funcionario->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <span class="col-12 d-flex row">
                            <h1 class="col-8">Editar Funcionário</h1>
                            <div class="col-4 d-flex align-items-center">
                                <a style="background-color: #DC1C2E;border: 2px solid #DC1C2E;"  href="{{ route('adminFuncionario.home',['id'=> $funcionario->id])}}" class="btn btn-primary me-3">Cancelar</a>
                                <div class="row">
                                    <div class="d-grid">
                                        <button style="background-color: #198754;border: 2px solid #198754;" href="" class="btn btn-primary">Pronto</button>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <hr/>
                        <div class="col-12 d-flex row">
                            <div class="col-6 mb-3">
                                <div class="">
                                    <label class=" mb-2" for="">Nome</label>
                                    <input type="text" name="name" class="form-control"  id="name" placeholder="Nome do Funcionario" value="{{$funcionario->name}}" required>
                                    @error('nome')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="">
                                    <label class="m-0 mb-2">Niveis de acesso:</label>
                                    <div class="">
                                        <select id="usertype" name="usertype" class="form-control pe-5" required >
                                            <option value="" disabled selected>Selecione uma Categoria</option>
                                            <option value="Guichê" {{ $funcionario->usertype === 'Guichê' ? 'selected' : '' }}>Guichê</option>
                                            <option value="Impressão" {{  $funcionario->usertype === 'Impressão' ? 'selected' : '' }}>Impressão</option>
                                            <option value="Produção" {{ $funcionario->usertype === 'Produção' ? 'selected' : '' }}>Produção</option>
                                            <option value="Caixa" {{  $funcionario->usertype === 'Caixa' ? 'selected' : '' }}>Caixa</option>
                                            <option value="Design" {{  $funcionario->usertype === 'Design' ? 'selected' : '' }}>Design</option>
                                            <option value="Admin" {{  $funcionario->usertype === 'Admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 d-flex row mt-3">
                            <div class="col-6">
                                <x-input-label for="password" :value="__('Senha')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="col-6">
                                <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/input_image.js') }}"></script>
    <script src="{{ asset('js/mascara.js') }}"></script>
</x-app-layout>