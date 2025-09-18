<x-app-layout>

    <style>
        /* Dias da semana e números dos dias */
        .fc-col-header-cell-cushion,
        .fc-daygrid-day-number {
            color: black !important;
            text-decoration: none;
        }

        /* Cabeçalho da lista (dias da semana) */
        .fc-listWeek-view .fc-list-day-cushion {
            font-size: 1.2rem;
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
            color: #111827;
            border: none;
            box-shadow: none;
        }

        .fc .fc-button:hover,
        .fc .fc-button:focus {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* Bolinha de evento */
        .fc-list-event-dot {
            margin-right: 0.5rem;
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-content-between items-center">
                        <div class="flex column items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="size-14 text-gray-800">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <h1 class="m-0">Agenda de Produção</h1>
                        </div>
                        <input type="text" id="search-calendar" placeholder="Pesquisar por cliente ou serviço"
                            class="form-control w-25">
                    </div>
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
                weekends: false,
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
                    if (info.event.url) window.location.href = info.event.url;
                },
                eventDidMount: function(info) {
                    const el = info.el;
                    const bgColor = info.event.backgroundColor || 'orange';

                    // Adiciona atributos para pesquisa
                    el.setAttribute('data-cliente', info.event.extendedProps.cliente.toLowerCase());
                    el.setAttribute('data-servico', info.event.extendedProps.servico.toLowerCase());

                    // Estilo do mês
                    if (info.view.type === 'dayGridMonth') {
                        el.style.backgroundColor = bgColor;
                        el.style.color = 'white';
                        let dot = el.querySelector('.fc-daygrid-event-dot');
                        if (dot) dot.style.display = 'none';
                    }

                    // Estilo da lista
                    if (info.view.type === 'listWeek') {
                        let dot = el.querySelector('.fc-event-dot');
                        if (dot) dot.style.display = 'inline-block';

                        // Mantém o banner
                        let banner = document.createElement('div');
                        banner.style.width = '10rem';
                        banner.style.height = '80%';
                        banner.style.backgroundColor = bgColor;
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
                                    if (response.success) calendar.refetchEvents();
                                })
                                .catch(() => alert('Erro ao atualizar a cor do evento.'));
                        };

                        el.style.position = 'relative';
                        banner.style.position = 'absolute';
                        banner.style.right = '0';
                        banner.style.top = '0';
                        el.appendChild(banner);
                    }
                }
            });

            calendar.render();

            // Pesquisa por cliente ou serviço
            const searchInput = document.getElementById('search-calendar');
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                document.querySelectorAll('#calendar .fc-event').forEach(el => {
                    const cliente = el.getAttribute('data-cliente') || '';
                    const servico = el.getAttribute('data-servico') || '';
                    el.style.display = (cliente.includes(query) || servico.includes(query)) ? '' :
                        'none';
                });
            });
            setInterval(function() {
                console.log('Atualizando calendário...');
                calendar.refetchEvents();
            }, 5000);
        });
    </script>
</x-app-layout>
