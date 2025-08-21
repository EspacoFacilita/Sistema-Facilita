<x-app-layout>
    <style>
        /* Dias da semana (dom, seg, ter...) e números dos dias */
        .fc-col-header-cell-cushion,
        .fc-daygrid-day-number {
            color: black !important;
            text-decoration: none;
        }

        /* Cabeçalho da lista (dias da semana) */
        .fc-listWeek-view .fc-list-day-cushion {
            font-size: 1.2rem;
            /* aumenta fonte */
            font-weight: bold;
            color: black;
        }

        /* Eventos dentro da semana */
        .fc-listWeek-view .fc-list-event-title {
            font-size: 1.3rem;
            font-weight: 500;
        }

        /* Horário do evento */
        .fc-listWeek-view .fc-list-event-time {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        /* Botões do calendário */
        .fc .fc-button {
            background-color: #e9e9e9;
            /* cor de fundo */
            color: #111827;
            /* cor do texto */
            border: none;
            box-shadow: none;
        }

        /* Hover e focus nos botões */
        .fc .fc-button:hover,
        .fc .fc-button:focus {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* Bolinha de evento */
        .fc-list-event-dot {
            margin-right: 0.5rem;
            /* ajusta espaço entre bolinha e hora/título */
            vertical-align: middle;
        }

        /* Links dos dias e datas */
        .fc-list-day-cushion a,
        .fc-list-day-text a {
            color: inherit;
            text-decoration: none;
            cursor: default;
        }
    </style>

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
                height: 'auto',
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
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },

                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },

                eventDidMount: function(info) {
                    if (info.view.type === 'dayGridMonth') {
                        let titleEl = info.el.querySelector('.fc-event-title');
                        let timeEl = info.el.querySelector('.fc-event-time');

                        let cor = info.event.backgroundColor;
                        if (titleEl) titleEl.style.color = cor;
                        if (timeEl) timeEl.style.color = cor;

                        let dot = info.el.querySelector('.fc-event-dot');
                        if (dot) dot.style.display = 'none';
                    }

                    if (info.view.type === 'listWeek') {
                        let banner = document.createElement('div');
                        banner.style.width = '10rem'; // largura menor, ajustável
                        banner.style.height = '80%'; // ocupa toda a altura do evento
                        banner.style.backgroundColor = info.event.backgroundColor || '#3788d8';
                        banner.style.marginTop = '0.3125rem';
                        banner.style.borderTopLeftRadius = '0.6rem';
                        banner.style.borderBottomLeftRadius = '0.6rem';

                        banner.style.cursor = 'pointer';

                        banner.onclick = function(e) {
                            e.stopPropagation();
                            let novaCor = (banner.style.backgroundColor === 'orange') ? 'blue' :
                                'orange';
                            banner.style.backgroundColor = novaCor;
                            info.event.setProp('backgroundColor', novaCor);

                            fetch('/admin/ordemdeservico/' + info.event.id + '/update-color', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        cor: novaCor
                                    })
                                })
                                .then(res => res.json())
                                .then(response => {
                                    if (response.success) {
                                        calendar.refetchEvents();
                                    }
                                })
                                .catch(() => {
                                    alert('Erro ao atualizar a cor do evento.');
                                });
                        };

                        // Posiciona à direita, ocupando toda altura
                        info.el.style.position = 'relative';
                        banner.style.position = 'absolute';
                        banner.style.right = '0';
                        banner.style.top = '0';
                        info.el.appendChild(banner);
                    }

                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
