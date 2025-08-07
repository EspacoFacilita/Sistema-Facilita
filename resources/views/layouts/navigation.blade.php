<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 no-print">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 d-flex align-items-center">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('adminOrdemDeServico.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex bg-danger text-white rounded">
                    <x-nav-link :href="route('adminOrdemDeServico.index')" :active="request()->routeIs('adminOrdemDeServico.index')"  class="text-white  text-decoration-none"> 
                        {{ __('Ordens De Serviço') }}
                    </x-nav-link>
                </div>
                <div  class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex bg-warning text-dark rounded">
                    <x-nav-link :href="route('adminOrdemDeServico.Impressao')" :active="request()->routeIs ('adminOrdemDeServico.Impressao')"  class="text-dark  text-decoration-none"> 
                        {{ __('Impressão') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex backgroundColorLaser text-darkLaser rounded">
                    <x-nav-link :href="route('adminOrdemDeServico.laser')" 
                                :active="request()->routeIs('adminOrdemDeServico.laser')"
                                class="text-dark  text-decoration-none">
                        {{ __('Laser') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex bg-primary text-white rounded">
                    <x-nav-link :href="route('adminOrdemDeServico.producao')" 
                                :active="request()->routeIs('adminOrdemDeServico.producao')" 
                                class="text-white  text-decoration-none">  <!-- Adicionando text-white aqui -->
                        {{ __('Produção') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex bg-success text-white rounded">
                    <x-nav-link :href="route('adminOrdemDeServico.concluidas')" :active="request()->routeIs('adminOrdemDeServico.concluidas')"  class="text-white  text-decoration-none"> 
                        {{ __('Concluídas') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('adminOrdemDeServico.entregues')" :active="request()->routeIs('adminOrdemDeServico.entregues')">
                        {{ __('Entregues') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="flex ">
               
                @if ( Auth::user()->usertype == 'Admin' || Auth::user()->usertype == 'Design')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex me-5">
                        <x-nav-link :href="route('adminFuncionario.home')" :active="request()->routeIs('adminFuncionario.home')">
                            {{ __('Funcionário') }}
                        </x-nav-link>
                    </div>
                @endif
                <x-dropdown class="" align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden ">
                <button @click="open = ! open" class="d-flex align-items-centerinline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('adminOrdemDeServico.index')" :active="request()->routeIs('adminOrdemDeServico.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
