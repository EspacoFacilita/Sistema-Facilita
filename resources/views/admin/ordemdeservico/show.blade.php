<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
        @if (Session::has('success'))
            <div x-data="{ show: true, progress: 100 }" x-init="setInterval(() => { if (progress > 0) progress -= 1 }, 40);
            setTimeout(() => { show = false }, 4000)" x-show="show" x-cloak
                x-transition:enter="transform ease-out duration-500 transition"
                x-transition:enter-start="translate-x-10 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform ease-in duration-500 transition"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-10 opacity-0"
                class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 inline-flex items-center gap-2 no-print">
                {{ Session::get('success') }}
            </div>
        @endif
        @php
            $rotaVoltar = match ($ordemServico->status) {
                'Entregue' => route('adminOrdemDeServico.entregues'),
                'Impressão' => route('adminOrdemDeServico.Impressao'),
                'Produção' => route('adminOrdemDeServico.producao'),
                'Concluído' => route('adminOrdemDeServico.concluidas'),
                'Laser' => route('adminOrdemDeServico.laser'),
                default => route('adminOrdemDeServico.index'),
            };
        @endphp

        <a id="botaoVoltar" style="span, svg:hover{}" href="{{ $rotaVoltar }}"
            class="flex w-24 items-center gap-1.5 transition no-print border border-gray-300 rounded-md px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" vieawBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mb-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Voltar
        </a>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
            <div class="p-6 text-gray-900">
                <div class="d-flex justify-content-between d-flex align-items-center no-print">
                    <div class="d-flex flex-row d-flex align-items-center">
                        <h3 class="m-0">Estados da Ordem de Serviço:</h3>
                        <div class="row ms-1">
                            <div class="col border-2 rounded ms-3" style="border: 2px solid ##dee2e6;">
                                <h4 class="m-0 p-1 ">{{ $ordemServico->status }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between d-flex align-items-center">
                        @if ($ordemServico->status !== 'Concluido' && $ordemServico->status !== 'Entregue')
                            <span class="ml-2 text-center  bg-emerald-600 rounded me-3">
                                <a href="{{ route('adminOrdemDeServico.concluir', $ordemServico->id) }}"
                                    onclick="return confirm('Você tem certeza que quer concluir o serviço?')"
                                    class="mx-1 d-flex align-items-center btn  text-white">Concluir</a>
                            </span>
                        @endif


                        <a style="background-color: #DC1C2E;border: 2px solid #DC1C2E;"
                            href="{{ route('adminOrdemDeServico.destroy', ['id' => $ordemServico->id]) }}"
                            onclick="return confirm('Você tem certeza que quer Deletar?')"
                            class="btn btn-primary me-3">Deletar</a>


                        <button style= "background-color: #094081;border: 2px solid #094081;"
                            class="btn btn-primary me-3" onclick="window.print()">Imprimir</button>

                        <div class="row">
                            <div class="d-grid">
                                @if ($ordemServico->status !== 'Entregue')
                                    <a href="{{ route('adminOrdemDeServico.edit', ['id' => $ordemServico->id]) }}"
                                        style="  background-color: #FF8A00; border: 2px solid #FF8A00;"
                                        class="btn text-white">Editar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="no-print" />
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between align-items-center border border-black">
                        <div class="col-4">
                            <x-application-logo class="block h-20 p-2 fill-current text-gray-800 " />
                        </div>
                        <div class=" ml-4 d-flex flex-row mt-3 col-4">
                            <label class=" pe-3 ms-3 fs-5"for="floatingInput">CÓD. ARTE:</label>
                            <p class="fs-5 m-0 border-bottom border-dark  col-4 d-flex justify-content-center">
                                {{ $ordemServico->id }}</p>
                        </div>
                        <div class=" d-flex flex-row ml-4 mt-3  me-5 col-4">
                            <label class=" pe-3 ms-3 fs-5"for="floatingInput">ORC DE VENDA:</label>
                            <p class="fs-5 m-0 border-bottom border-dark  col-4 d-flex justify-content-center">
                                {{ $ordemServico->ORC_venda }}</p>
                        </div>
                    </div>
                    <div class="col-6 border border-black ">
                        <div class="row mb-3 mt-3">
                            <div class=" d-flex flex-row col align-items-center">
                                <label class="  mx-2 fs-5"for="">Cliente:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">{{ $ordemServico->cliente }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class=" d-flex flex-row  col d-flex align-items-center">
                                <label class="fs-5  mx-2"for="">Serviço:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">{{ $ordemServico->servico }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col  d-flex flex-row d-flex align-items-center">
                                <label class="fs-5  mx-2"for="">Endereço:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-9">{{ $ordemServico->end }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col d-flex align-items-center" x-data="{ telefone: ' ' }">
                                <label class="fs-5  mx-2"for="">Fone:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">{{ $ordemServico->fone }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col d-flex align-items-center">
                                <label class="fs-5 mx-2">Valor:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-8">{{ $ordemServico->valor }}</p>
                            </div>
                            <div class="col-7 form-floating d-flex justify-content-between d-flex align-items-center">
                                <span class="fs-5 ">Pago:</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-black rounded-0 opacity-100"
                                        type="radio" name="pago1" id="pago_sim" value="sim"
                                        {{ $ordemServico->pago == 'sim' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label opacity-100 fs-5" for="pago_sim">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-black rounded-0 opacity-100"
                                        type="radio" name="pago1" id="pago_nao" value="nao"
                                        {{ $ordemServico->pago == 'nao' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label opacity-100 fs-5" for="pago_nao">Não</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-black rounded-0 opacity-100"
                                        type="radio" name="pago1" id="pago_50" value="50%"
                                        {{ $ordemServico->pago == '50%' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label  opacity-100 fs-5" for="pago_50">50%</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col  d-flex flex-row  align-items-center">
                                <label class="fs-5  mx-2 ">Falta:</label>
                                <p class="fs-5 text-danger m-0 border-bottom border-dark  col-10">
                                    {{ $ordemServico->falta }}</p>
                            </div>
                        </div>
                        <div style="border: 2px solid #FF8A00;" class="col-13 row d-flex justify-content-evenly">
                            <h5 style="background-color: #FF8A00;"
                                class="col-12 d-flex justify-content-center text-white">PRAZO DE ENTREGA DO
                                SERVIÇO</h5>
                            <div class=" d-flex justify-content-evenly">
                                <div class="col-5">
                                    <div class="row mb-3 ">
                                        <div class="col d-flex align-items-center">
                                            <label class="fs-5  mx-2">D.R:</label>
                                            <p class="m-0 fs-5 ">
                                                {{ date('d/m/Y', strtotime($ordemServico->data_de_recebimento)) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col d-flex  align-items-center">
                                            <label class="fs-5  mx-2">D.E:</label>
                                            <p class="fs-5 m-0">
                                                {{ date('d/m/Y', strtotime($ordemServico->data_de_entrega)) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 col-6 d-flex align-items-center">
                                    <div>
                                        <label class=" fs-5 mx-2 mb-3 d-flex justify-content-center">HORA
                                            ENTREGA:</label>
                                        <p class="fs-5 d-flex justify-content-center m-0 border-bottom border-dark  ">
                                            {{ $ordemServico->hora_de_entrega }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" p-0 flex-wrap col-6 form-floating d-flex d-flex justify-content-evenly">
                        <div class="col-12 row d-flex justify-content-evenly border border-success border-bottom-0 ">
                            <h5 style="background-color: #094081;"
                                class="col-12 d-flex justify-content-center text-light align-items-center">PERÍODO
                                DE ENTREGA DO SERVIÇO
                            </h5>
                            <div class="row mb-3 col-6 align-items-center">
                                <div class="col d-flex  align-items-center">
                                    <label class="  mx-2">D.I:</label>
                                    <p class="fs-5 m-0">
                                        {{ date('d/m/Y', strtotime($ordemServico->dia_do_recebimento_do_controle)) }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-3 col-6 align-items-center">
                                <div class="col  d-flex  align-items-center">
                                    <label class="  mx-2">D.F:</label>
                                    <p class="fs-5 m-0">
                                        {{ date('d/m/Y', strtotime($ordemServico->prazo_da_impressao_data)) }}</p>
                                </div>
                            </div>

                        </div>

                        <div style="border: 2px solid #8F00FF;"
                            class="col-12 row d-flex justify-content-evenly  border-bottom-0 ">
                            <h5 style="background-color: #8F00FF;"
                                class="col-12 d-flex justify-content-center text-white align-items-center">SERVIÇO
                                EXTERNO</h5>
                            <div class="col-6 form-floating d-flex justify-content-between d-flex align-items-center">
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input border border-black  rounded-0 opacity-100"
                                        type="radio" name="servico_externo" id="servico_externo" value="1"
                                        {{ $ordemServico->servico_externo == '1' ? 'checked' : '' }} disabled>
                                    <label class="fs-5 form-check-label opacity-100" for="inlineRadio1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  border border-black  rounded-0 opacity-100"
                                        type="radio" name="servico_externo" id="servico_externo" value="0"
                                        {{ $ordemServico->servico_externo == '0' ? 'checked' : '' }} disabled>
                                    <label class="fs-5 form-check-label opacity-100" for="inlineRadio2">Não</label>
                                </div>
                            </div>
                        </div>
                        <div style="border: 2px solid #D80707;" class="col-12 row d-flex justify-content-evenly  ">
                            <h5 style="background-color: #D80707;"
                                class="col-12 d-flex justify-content-center text-white align-items-center">FORMAS
                                DE PAGAMENTO SERVIÇO EXTERNO</h5>
                            <div class=" d-flex justify-content-evenly">
                                <div class="d-flex flex-column">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  border border-black rounded-0 opacity-100"
                                            type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                            value="pix"{{ $ordemServico->formas_de_pagamento == 'pix' ? 'checked' : '' }}
                                            disabled>
                                        <label class="fs-5 form-check-label opacity-100"
                                            for="inlineRadio1">PIX</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  border border-black  rounded-0 opacity-100"
                                            type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                            value="transfbanc./deposito"
                                            {{ $ordemServico->formas_de_pagamento == 'transfbanc./deposito' ? 'checked' : '' }}
                                            disabled>
                                        <label class="fs-5 form-check-label opacity-100"
                                            for="inlineRadio1">CARTÃO</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-5">
                                        <input class="form-check-input  border border-black  rounded-0 opacity-100"
                                            type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                            value="pag.naloja"
                                            {{ $ordemServico->formas_de_pagamento == 'pag.naloja' ? 'checked' : '' }}
                                            disabled>
                                        <label class="fs-5 form-check-label opacity-100"
                                            for="inlineRadio1">TRANSF.BANC./DEPÓSITO</label>
                                    </div>
                                </div>
                                <div class=" d-flex flex-column">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  border border-black  rounded-0 opacity-100"
                                            type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                            value="dinheiro"
                                            {{ $ordemServico->formas_de_pagamento == 'dinheiro' ? 'checked' : '' }}
                                            disabled>
                                        <label class="fs-5 form-check-label opacity-100"
                                            for="inlineRadio1">DINHEIRO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  border border-black  rounded-0 opacity-100"
                                            type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                            value="cartao"
                                            {{ $ordemServico->formas_de_pagamento == 'cartao' ? 'checked' : '' }}
                                            disabled>
                                        <label class="fs-5 form-check-label opacity-100" for="inlineRadio1">PAG.
                                            NA LOJA</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="border border-black">
                            <h4 style="background-color: #9B9A9C;" class="d-flex justify-content-center col-12">
                                OBSERVAÇÃO:</h4>
                            <div class="row mb-3">
                                <div class="col form-floating mx-2">
                                    @foreach (explode("\n", $ordemServico->observacoes_pedido) as $linha)
                                        <p class="fs-5 m-0 border-bottom border-dark">
                                            {{ mb_strtoupper(e($linha), 'UTF-8') }}
                                        </p>
                                    @endforeach
                                    @error('observacoes_pedido')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-dark">
                        <div class="col d-flex flex-row  d-flex align-items-center mt-3">
                            <h4 class="m-0 ">LAYOUT:</h4>
                        </div>
                        <div class="border border-dark-subtle mt-3">
                            <div class="d-flex justify-content-center" style="height: 300px" id="layout">
                                <img class="m-3 "
                                    src="{{ asset('uploads/ordemdeservico/' . $ordemServico->layout) }}"
                                    alt="Nenhuma imagem selecionada ">
                            </div>
                        </div>
                        <div class="col-6 form-floating d-flex justify-content-between d-flex align-items-center mt-3">
                            <h4 class="m-0">EMBALAGEM:</h4>
                            <div class="form-check form-check-inline ms-2">
                                <input class="form-check-input rounded-0  border border-black opacity-100"
                                    type="radio" name="embalagem" id="embalagem" value="sim"
                                    {{ $ordemServico->embalagem == 'sim' ? 'checked' : '' }} disabled>
                                <label class="fs-5 form-check-label opacity-100" for="inlineRadio1">SIM</label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input rounded-0 border border-black opacity-100"
                                    type="radio" name="embalagem" id="embalagem" value="nao"
                                    {{ $ordemServico->embalagem == 'nao' ? 'checked' : '' }} disabled>
                                <label class="fs-5 form-check-label opacity-100" for="inlineRadio1">NÃO</label>
                            </div>
                            <div class="col d-flex flex-row d-flex align-items-center ">
                                <h4 class="d-flex align-items-center m-0 p-2">OBS:</h4>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">
                                    {{ $ordemServico->observacoes_layout }}</p>
                                @error('observacoes_layout')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between mt-5 ">
                    <div class="col-9 ">
                        <div class="col-10">
                            <p class="fs-5 m-0 border-bottom border-dark  col-12 d-flex justify-content-center mt-4">
                            </p>
                        </div>
                        <div class="col-10">
                            <h4 class=" d-flex justify-content-center">Serviço Autorizado pelo cliente</h4>
                            <p class="fs-5 d-flex justify-content-center">Declaro Ter Lido. Corrigido Tanto
                                Textualmente Quando Visualmante Meu Serviço</p>
                        </div>
                    </div>
                    <div class="col-3 ">
                        <p class="fs-5 m-0 border-bottom border-dark  col-12 d-flex justify-content-center">
                            {{ $ordemServico->nome_funcionario }}</p>
                        <h4 class=" d-flex justify-content-center">Funcionario(a)</h4>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center border border-black px-2 ">
                    <div class="d-flex flex-column col-8 mb-3">
                        <h3 class="ms-4 mt-2">2 Via</h3>
                        <div class="row mb-3 mt-2">
                            <div class=" d-flex flex-row col align-items-center">
                                <label class=" fs-5 mx-2  "for="">Cliente:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">{{ $ordemServico->cliente }}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class=" d-flex flex-row  col d-flex align-items-center">
                                <label class="fs-5  mx-2"for="">Serviço:</label>
                                <p class="fs-5 m-0 border-bottom border-dark  col-10">{{ $ordemServico->servico }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="d-flex  align-items-center">
                                <label class="fs-5  mx-2">D.E:</label>
                                <p class="fs-5 d-flex justify-content-center m-0 border-bottom border-dark  ">
                                    {{ date('d/m/Y', strtotime($ordemServico->data_de_entrega)) }}</p>
                            </div>
                            <div class="d-flex flex-row ms-3">
                                <label class="fs-5 d-flex justify-content-center mx-2">HORA ENTREGA:</label>
                                <p class="fs-5 d-flex justify-content-center m-0 border-bottom border-dark  ">
                                    {{ $ordemServico->hora_de_entrega }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class=" ml-4 d-flex flex-row mt-3 d-flex justify-content-center ">
                            <label class="fs-5 pe-3 ms-3"for="floatingInput">CÓD. ARTE:</label>
                            <p class="fs-5 m-0 border-bottom border-dark  col-4 d-flex justify-content-center">
                                {{ $ordemServico->id }}</p>
                        </div>
                        <div class="d-flex flex-row mt-3 ml-3 d-flex justify-content-center">
                            <p class="fs-5 mx-2">Pago:</p>
                            <div class="form-check form-check-inline">
                                <input class=" form-check-input border border-black rounded-0 opacity-100"
                                    type="radio" name="pago2" id="pago_sim" value="sim"
                                    {{ $ordemServico->pago == 'sim' ? 'checked' : '' }} disabled>
                                <label class="fs-5 form-check-label opacity-100" for="pago_sim">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border border-black rounded-0 opacity-100"
                                    type="radio" name="pago2" id="pago_nao" value="nao"
                                    {{ $ordemServico->pago == 'nao' ? 'checked' : '' }} disabled>
                                <label class="fs-5 form-check-label opacity-100" for="pago_nao">Não</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border border-black rounded-0 opacity-100"
                                    type="radio" name="pago2" id="pago_50" value="50%"
                                    {{ $ordemServico->pago == '50%' ? 'checked' : '' }} disabled>
                                <label class="fs-5 form-check-label  opacity-100" for="pago_50">50%</label>
                            </div>
                        </div>
                        <div class="d-flex flex-column ">
                            <div>
                                <p class="fs-5 m-0 border-bottom border-dark  col-12 d-flex justify-content-center">
                                    {{ $ordemServico->nome_funcionario }}</p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p class="fs-5">Funcionario(a)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/input_image.js') }}"></script>
    <script src="{{ asset('js/mascara.js') }}"></script>
    {{-- Script que imprime a página quando alguém clica no botão do index --}}
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        window.onload = function() {
            if (getQueryParam('print') === '1') {
                window.print();
            }
        };
    </script>


</x-app-layout>
