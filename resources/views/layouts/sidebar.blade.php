@php
    $ordemAtivo = request()->routeIs('adminOrdemDeServico.*') && !request()->routeIs('adminOrdemDeServico.calendario*');
    $clienteAtivo = request()->routeIs('clientes.*');
    $agendaAtivo =
        request()->routeIs('adminOrdemDeServico.calendario') || request()->routeIs('adminOrdemDeServico.calendario.*');
    $funcAtivo = request()->routeIs('adminFuncionario.*');
@endphp

<aside
    class="fixed top-0 left-0  h-screen bg-gray-900 text-white flex flex-col min-h-screen shadow-lg text-lg font-semibold p-1.5">
    <a href="{{ route('adminOrdemDeServico.index') }}" class="block">
        <div class="p-6 text-2xl font-bold flex justify-center">
            <img class="h-14" src="{{ asset('img/logo_branca.png') }}" alt="">
        </div>
    </a>

    <nav class="flex-1 overflow-y-auto">
        <ul class="p-0">

            <!-- Ordem de Serviço com dropdown -->
            <li x-data="{ open: true }" class="px-0">
                <div
                    class="flex items-center transition-colors rounded {{ $ordemAtivo ? 'bg-blue-500 text-white' : 'hover:bg-gray-800 text-white' }}">
                    <!-- Texto link para index -->

                    <a href="{{ route('adminOrdemDeServico.index') }}"
                        class="flex no-underline transition-colors text-white">
                        <div class="flex items-center gap-1.5 pl-6"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            Ordem de Serviço</div>
                    </a>

                    <!-- Botão seta toggle -->
                    <button @click="open = !open"
                        class="text-white focus:outline-none px-3 py-3 flex items-center justify-center">
                        <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <!-- Sublinks -->
                <ul x-show="open" class="space-y-1 p-0 mt-1.5 " x-cloak>
                    @php
                        $subLinks = [
                            ['route' => 'adminOrdemDeServico.Impressao', 'label' => 'Impressão'],
                            ['route' => 'adminOrdemDeServico.laser', 'label' => 'Laser'],
                            ['route' => 'adminOrdemDeServico.producao', 'label' => 'Produção'],
                            ['route' => 'adminOrdemDeServico.concluidas', 'label' => 'Concluídas'],
                            ['route' => 'adminOrdemDeServico.entregues', 'label' => 'Entregues'],
                        ];
                    @endphp

                    @foreach ($subLinks as $link)
                        @php
                            $active = request()->routeIs($link['route']);
                            $statusColors = [
                                'Impressão' => 'fill-yellow-500',
                                'Laser' => 'fill-orange-500',
                                'Produção' => 'fill-blue-500',
                                'Concluídas' => 'fill-green-500',
                                'Entregues' => 'fill-gray-500',
                            ];
                            $color = $statusColors[$link['label']] ?? 'fill-gray-400';
                        @endphp

                        <li>
                            <a href="{{ route($link['route']) }}"
                                class="flex items-center no-underline px-4 py-1 rounded transition-colors 
            {{ $active ? 'bg-neutral-200 text-gray-900' : 'text-white hover:text-gray-300 hover:bg-gray-800' }}">

                                @if ($active)
                                    <svg class="w-5 h-5 mx-2 {{ $color }}" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="6" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 mx-2 text-gray-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="6" />
                                    </svg>
                                @endif

                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </li>

            <li>
                <a href="{{ route('adminOrdemDeServico.calendario') }}"
                    class="flex items-center gap-1.5 no-underline px-6 py-2 mt-1.5 rounded transition-colors 
                    {{ $agendaAtivo ? 'bg-blue-600 text-white' : 'text-white hover:text-gray-300 hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    Agenda
                </a>
            </li>

            <!-- Clientes -->
            <li>
                <a href="{{ route('clientes.index') }}"
                    class="flex items-center gap-1.5 no-underline px-6 py-2 mt-1.5 rounded transition-colors 
                    {{ $clienteAtivo ? 'bg-blue-600 text-white' : 'text-white hover:text-gray-300 hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v18m0-18h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75m0-18v18m0-9h-3m3-6h-3m3 12h-3" />
                    </svg>
                    Clientes
                </a>
            </li>

            <!-- Funcionários -->
            @if (Auth::user()->usertype == 'Admin' || Auth::user()->usertype == 'Design')
                <li>
                    <a href="{{ route('adminFuncionario.home') }}"
                        class="mt-1.5 flex items-center gap-1.5 no-underline px-6 py-2 rounded transition-colors 
                        {{ $funcAtivo ? 'bg-blue-600 text-white' : 'text-white hover:text-gray-300 hover:bg-gray-800' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Funcionários
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <!-- Logout -->

    <div class="px-2 pb-2 flex justify-center items-center gap-1.5 text-gray-500"><svg
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
        <span>{{ Auth::user()->name }}</span>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        <hr class="my-0">
        <div class="p-3 pb-2 flex justify-center">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-400 flex items-center gap-1.5 "><svg
                    class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 18V6h-5v12h5Zm0 0h2M4 18h2.5m3.5-5.5V12M6 6l7-2v16l-7-2V6Z" />
                </svg>

                Sair do sistema</button>
        </div>
    </form>

</aside>
