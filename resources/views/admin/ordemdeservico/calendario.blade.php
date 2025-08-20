<x-app-layout>
    {{-- FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/pt-br.global.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendário das Ordens de Serviço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-3">Agenda de Produção</h1>
                    <hr />
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listWeek',
                locale: 'pt-br',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Semana'
                },
                noEventsContent: 'Nenhum evento para exibir',
                events: '{{ route('adminOrdemDeServico.calendario.events') }}',
                displayEventTime: true,
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },

                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.view.type !== 'listWeek' && info.event.url) {
                        window.location.href = info.event.url;
                    }
                },

                eventDidMount: function(info) {
                    if(info.view.type === 'listWeek') {
                        // Banner retangular
                        let badge = document.createElement('div');
                        badge.style.width = '60px';
                        badge.style.height = '20px';
                        badge.style.backgroundColor = info.event.backgroundColor || '#3788d8';
                        badge.style.color = 'white';
                        badge.style.display = 'inline-block';
                        badge.style.textAlign = 'center';
                        badge.style.lineHeight = '20px';
                        badge.style.borderRadius = '4px';
                        badge.style.marginLeft = '8px';
                        badge.innerText = ''; // pode colocar texto se quiser

                        // Botões de cor
                        let btnOrange = document.createElement('button');
                        btnOrange.innerText = '🟠';
                        btnOrange.style.border = 'none';
                        btnOrange.style.background = 'none';
                        btnOrange.style.cursor = 'pointer';
                        btnOrange.style.marginLeft = '4px';
                        btnOrange.onclick = function(e) {
                            e.stopPropagation();
                            info.event.setProp('backgroundColor', 'orange');
                            badge.style.backgroundColor = 'orange';
                        };

                        let btnBlue = document.createElement('button');
                        btnBlue.innerText = '🔵';
                        btnBlue.style.border = 'none';
                        btnBlue.style.background = 'none';
                        btnBlue.style.cursor = 'pointer';
                        btnBlue.style.marginLeft = '2px';
                        btnBlue.onclick = function(e) {
                            e.stopPropagation();
                            info.event.setProp('backgroundColor', 'blue');
                            badge.style.backgroundColor = 'blue';
                        };

                        // Inserindo badge e botões no container correto
                        let container = info.el.querySelector('.fc-list-event-title') || info.el.querySelector('.fc-event-title');
                        if(container) {
                            container.appendChild(badge);
                            container.appendChild(btnOrange);
                            container.appendChild(btnBlue);
                        }
                    }
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
