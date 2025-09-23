<x-app-layout>

    <div class="max-w-7xl mx-auto p-4">
        @if (Session::has('success'))
            <div x-data="{ show: true, progress: 100 }" x-init="setInterval(() => { if (progress > 0) progress -= 1 }, 40);
            setTimeout(() => { show = false }, 4000)" x-show="show" x-cloak
                x-transition:enter="transform ease-out duration-500 transition"
                x-transition:enter-start="translate-x-10 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform ease-in duration-500 transition"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-10 opacity-0"
                class="fixed top-4 right-2 w-80 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 inline-flex items-center gap-2">
                {{ Session::get('success') }}
            </div>
        @endif

        <a id="botaoVoltar" style="span, svg:hover{}" href="{{ route('adminOrdemDeServico.index') }}"
            class="inline-flex items-center gap-1.5 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" vieawBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Voltar
        </a>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
            <div class="p-6 text-gray-900">
                @if (session()->has('error'))
                    <div>
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('adminOrdemDeServico.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="d-flex justify-content-between d-flex align-items-center">
                        <div class="d-flex flex-row align-items-center">
                            <h3 class="m-0">Estados da Ordem de Serviço:</h3>
                            <div class="row ms-1">
                                <div class="col">
                                    <select id="status" name="status" class="form-control pe-5" required>
                                        <option value="">Selecione uma Categoria</option>
                                        @php
                                            $userType = Auth::user()->usertype;
                                        @endphp
                                        @if (in_array($userType, ['Guichê', 'Impressão', 'Produção', 'Caixa', 'Admin', 'Design']))
                                            <option value="Pendente"
                                                {{ old('status') === 'Pendente' ? 'selected' : '' }}>Pendente
                                            </option>
                                            <option value="Impressão"
                                                {{ old('status') === 'Impressão' ? 'selected' : '' }}>Impressão
                                            </option>
                                            <option value="Laser" {{ old('status') === 'Laser' ? 'selected' : '' }}>
                                                Laser</option>
                                            <option value="Produção"
                                                {{ old('status') === 'Produção' ? 'selected' : '' }}>Produção
                                            </option>
                                        @endif
                                        @if (in_array($userType, ['Impressão', 'Produção', 'Caixa', 'Admin', 'Design']))
                                            <option value="Concluido"
                                                {{ old('status') === 'Concluido' ? 'selected' : '' }}>Concluído
                                            </option>
                                        @endif
                                        @if (in_array($userType, ['Caixa', 'Admin', 'Design']))
                                            <option value="Entregue"
                                                {{ old('status') === 'Entregue' ? 'selected' : '' }}>Entregue
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between d-flex align-items-center">
                            <div class="row">
                                <div class="d-grid">
                                    <button style="background-color: #19940E;border: 2px solid #19940E;"
                                        class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center border border-black">
                            <x-application-logo class="block h-20 p-2 fill-current text-gray-800" />
                            <div class=" form-floating ml-4">
                                <input type="text" name="" class="form-control floatingInput" id=""
                                    placeholder="CÓD. ARTE" value="{{ old('') }}" disabled="disabled">
                                <label class="  ms-3"for="floatingInput">CÓD. ARTE</label>
                                @error('ORC_venda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" form-floating ml-4">
                                <input type="text" name="ORC_venda" class="form-control floatingInput" id="ORC_venda"
                                    placeholder="ORC de venda" value="{{ old('ORC_venda') }}">
                                <label class="  ms-3"for="floatingInput">ORC DE VENDA</label>
                                @error('ORC_venda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mt-4 border border-black ">
                            <div class="row mb-3 mt-4">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <label class="mx-2" for="">Cliente:</label>
                                    <input type="text" name="cliente" class="form-control" id="cliente"
                                        placeholder="Nome do Cliente" value="{{ old('cliente') }}" required
                                        autocomplete="off">
                                    @error('cliente')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div id="clienteList"></div>
                            <input type="hidden" name="cliente_id" id="cliente_id" value="{{ old('cliente_id') }}"
                                data-cliente-id="{{ old('cliente_id') }}">
                            <div class="row mb-3">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <label class="  mx-2"for="">Serviço:</label>
                                    <input type="text" name="servico" class="form-control " id="servico"
                                        placeholder="Serviço" value="{{ old('servico') }}" required>
                                    @error('servico')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <label class="  mx-2"for="">Endereço:</label>
                                    <input type="text" name="end" class="form-control" id="end"
                                        placeholder="Endereço" value="{{ old('end') }}">
                                    @error('end')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col d-flex justify-content-between align-items-center"
                                    x-data="{ telefone: ' ' }">
                                    <label class="  mx-2"for="">Fone:</label>
                                    <input type="text" name="fone" class="form-control " id="fone"
                                        placeholder="Fone" x-mask="(99) 99999-9999" value="{{ old('fone') }}"
                                        required>
                                    @error('fone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 d-flex justify-content-between align-items-center">
                                    <label class=" col-3 mx-2">Valor R$:</label>
                                    <input type="text" name="valor" class="form-control " id="valor"
                                        placeholder="Valor R$" value="{{ old('valor') }}"
                                        onInput="mascaraMoeda(event);" required>
                                    @error('valor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="col-6 form-floating d-flex justify-content-between d-flex align-items-center">
                                    <span>Pago:</span>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input border border-black rounded-0" type="radio"
                                            name="pago" id="pago_sim" value="sim"
                                            {{ old('pago') === 'sim' ? 'checked' : '' }}required>
                                        <label class="form-check-label" for="pago_sim">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input border border-black rounded-0" type="radio"
                                            name="pago" id="pago_nao" value="nao"
                                            {{ old('pago') === 'nao' ? 'checked' : '' }}required>
                                        <label class="form-check-label" for="pago_nao">Não</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input border border-black rounded-0" type="radio"
                                            name="pago" id="pago_50" value="50%"
                                            {{ old('pago') === '50%' ? 'checked' : '' }}required>
                                        <label class="form-check-label" for="pago_50">50%</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <label class="  mx-2">Falta:</label>
                                    <input type="text" name="falta" class="form-control " id="falta"
                                        placeholder="Falta" value="{{ old('falta') }}"
                                        onInput="mascaraMoeda(event);">
                                </div>
                            </div>
                            <div style="border: 2px solid #FF8A00;" class="col-13 row d-flex justify-content-evenly">
                                <h5 style="background-color: #FF8A00;"
                                    class="col-12 d-flex justify-content-center text-white">PRAZO DE ENTREGA DO
                                    SERVIÇO</h5>
                                <div class=" d-flex justify-content-between">
                                    <div class="col-5">
                                        <div class="row mb-3 ">
                                            <div class="col d-flex justify-content-between align-items-center">
                                                <label class="  mx-2">D.R:</label>
                                                <input type="date" name="data_de_recebimento"
                                                    class="form-control " id="data_de_recebimento"
                                                    placeholder="Data de recebimento"
                                                    value='<?php echo date('Y-m-d'); ?>'required>
                                                @error('data_de_recebimento')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col d-flex justify-content-between align-items-center">
                                                <label class="  mx-2">D.E:</label>
                                                <input type="date" name="data_de_entrega" class="form-control "
                                                    id="data_de_entrega" placeholder="Data de entrega"
                                                    value="{{ old('data_de_entrega') }}"required>
                                                @error('data_de_entrega')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 col-6 d-flex align-items-center">
                                        <div>
                                            <label class="mx-2 mb-2">HORA ENTREGA:</label>
                                            <input type="time" name="hora_de_entrega" class=" form-control "
                                                id="hora_de_entrega" placeholder="Hora de entrega"
                                                value="{{ old('hora_de_entrega') }}"required>
                                            @error('hora_de_entrega:')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-4 p-0 flex-wrap col-6 form-floating d-flex d-flex justify-content-evenly background-color: ">
                            <div
                                class="col-12 row d-flex justify-content-evenly border border-success border-bottom-0 ">
                                <h5 style="background-color: #094081;"
                                    class="col-12 d-flex justify-content-center text-light align-items-center">
                                    PERÍODO DE ENTREGA DO SERVIÇO</h5>
                                <div class="row mb-3 col-6 align-items-center">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2">D.I:</label>
                                        <input type="date" name="dia_do_recebimento_do_controle"
                                            class="form-control " id="dia_do_recebimento_do_controle"
                                            placeholder="Rec. do controle"
                                            value="{{ old('dia_do_recebimento_do_controle') }}">
                                        @error('dia_do_recebimento_do_controle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 col-6 align-items-center">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2">D.F:</label>
                                        <input type="date" name="prazo_da_impressao_data" class="form-control"
                                            id="prazo_da_impressao_data" placeholder="Data de entrega da impressão"
                                            value="{{ old('prazo_da_impressao_data') }}">
                                        @error('prazo_da_impressao_data')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div style="border: 2px solid #8F00FF;"
                                class="col-12 row d-flex justify-content-evenly  border-bottom-0 ">
                                <h5 style="background-color: #8F00FF;"
                                    class="col-12 d-flex justify-content-center text-white align-items-center">
                                    SERVIÇO EXTERNO</h5>
                                <div
                                    class="col-6 form-floating d-flex justify-content-between d-flex align-items-center">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input border border-black  rounded-0" type="radio"
                                            name="servico_externo" id="servico_externo"
                                            value="1"{{ old('servico_externo') === '1' ? 'checked' : '' }}required>
                                        <label class="form-check-label" for="inlineRadio1">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  border border-black  rounded-0" type="radio"
                                            name="servico_externo" id="servico_externo"
                                            value="0"{{ old('servico_externo') === '0' ? 'checked' : '' }}required>
                                        <label class="form-check-label" for="inlineRadio2">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div style="border: 2px solid #D80707;"
                                class="col-12 row d-flex justify-content-evenly  ">
                                <h5 style="background-color: #D80707;"
                                    class="col-12 d-flex justify-content-center text-white align-items-center">
                                    FORMAS DE PAGAMENTO SERVIÇO EXTERNO</h5>
                                <div class=" d-flex justify-content-evenly ">
                                    <div class="d-flex flex-column">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  border border-black rounded-0"
                                                type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                                value="pix"{{ old('formas_de_pagamento') === 'pix' ? 'checked' : '' }}required>
                                            <label class="form-check-label" for="inlineRadio1">PIX</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  border border-black  rounded-0"
                                                type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                                value="transfbanc./deposito"{{ old('formas_de_pagamento') === 'transfbanc./deposito' ? 'checked' : '' }}required>
                                            <label class="form-check-label" for="inlineRadio1">CARTÃO</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mb-5 border border-black  rounded-0"
                                                type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                                value="pag.naloja"{{ old('formas_de_pagamento') === 'pag.naloja' ? 'checked' : '' }}required>
                                            <label class="form-check-label"
                                                for="inlineRadio1">TRANSF.BANC./DEPÓSITO</label>
                                        </div>
                                    </div>
                                    <div class=" d-flex flex-column">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input  border border-black  rounded-0"
                                                type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                                value="dinheiro"{{ old('formas_de_pagamento') === 'dinheiro' ? 'checked' : '' }}required>
                                            <label class="form-check-label" for="inlineRadio1">DINHEIRO</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-8">
                                            <input class="form-check-input  border border-black  rounded-0"
                                                type="radio" name="formas_de_pagamento" id="formas_de_pagamento"
                                                value="cartao"{{ old('formas_de_pagamento') === 'cartao' ? 'checked' : '' }}required>
                                            <label class="form-check-label" for="inlineRadio1">PAG. NA
                                                LOJA</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 mt-4">
                            <div class="border border-black">
                                <h4 style="background-color: #9B9A9C;" class="d-flex justify-content-center col-12 ">
                                    OBSERVAÇÃO:</h4>
                                <div class="row mb-3">
                                    <div class="col form-floating">
                                        <textarea name="observacoes_pedido" class="form-control floatingInput" style="height:100px" id="observacoes_pedido"
                                            placeholder="Observacoes da ordem" required>{{ old('observacoes_pedido') }}</textarea>
                                        <label class="ms-3" for="floatingInput">OBSERVAÇÕES</label>
                                        @error('observacoes_pedido')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-dark">
                            @if (session('success'))
                                <p>{{ session('success') }}</p>
                                <div id="image-preview" class="position-relative">
                                    <img src="{{ asset('storage/' . session('path')) }}" alt="Imagem carregada"
                                        id="preview-image"
                                        style="max-width: 100%; max-height: 300px; object-fit: contain;">

                                </div>
                            @endif
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="col-12 d-flex flex-row">
                                <div class="col-6 d-flex flex-row d-flex align-items-center mt-3">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="m-0">LAYOUT:</h4>
                                        <div class="row">
                                            <div class="col ms-3 d-flex flex-row">
                                                <!-- Input de arquivo -->
                                                <input type="file" name="layout" class="form-control"
                                                    id="layout" accept="image/*" onchange="previewImage(event)">
                                                @error('layout')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end col-6 mt-3">
                                    <button type="button" id="removeImageButton" class="btn btn-danger"
                                        onclick="removeImage()">Remover</button>
                                </div>
                            </div>
                            <div class="border border-dark-subtle mt-3">
                                <!-- Área para exibir o preview da imagem -->
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 300px; cursor: pointer;" id="layout-preview"
                                    onclick="triggerFileInput()" onpaste="handlePaste(event)">
                                    <img class="m-3" id="preview" src=""
                                        alt="Nenhuma imagem selecionada"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;">
                                    <p id="no-image-message" style="display: block;">Nenhuma imagem selecionada
                                    </p>
                                </div>
                            </div>
                            <div
                                class="col-6 form-floating d-flex justify-content-between d-flex align-items-center mt-3">
                                <h4 class="m-0">EMBALAGEM:</h4>
                                <div class="form-check form-check-inline ms-2">
                                    <input class="form-check-input rounded-0  border border-black " type="radio"
                                        name="embalagem" id="embalagem"
                                        value="sim"{{ old('embalagem') === 'sim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">SIM</label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input rounded-0 border border-black" type="radio"
                                        name="embalagem" id="embalagem"
                                        value="nao"{{ old('embalagem') === 'nao' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">NÃO</label>
                                </div>
                                <div class="col d-flex flex-row ">
                                    <h4 class="d-flex align-items-center m-0 p-2">OBS:</h4>
                                    <input type="text" name="observacoes_layout" class="form-control "
                                        id="observacoes_layout" placeholder="Observacoes"
                                        value="{{ old('observacoes_layout') }}">
                                    @error('observacoes_layout')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-floating d-flex justify-content-end mt-5 me-4">
                        <div class="row mb-3">
                            <div class="col me-5 ">
                                <input type="text" name="nome_funcionario" class="form-control floatingInput"
                                    id="nome_funcionario" placeholder="Nome do funcionario"
                                    value="{{ Auth::user()->name }}" required>
                                <h2 class="d-flex justify-content-center">Funcionario</h2>
                                @error('nome_funcionario')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            function buscarClientes(query) {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('clientes.autocomplete') }}",
                    method: "POST",
                    data: {
                        search: query,
                        _token: _token
                    },
                    success: function(data) {
                        var html = '<ul class="dropdown-menu show">';
                        $.each(data, function(key, value) {
                            html += '<li class="dropdown-item" data-cliente_id="' + value.id +
                                '" data-endereco="' +
                                value.endereco + '" data-fone="' +
                                value.fone + '">' +
                                value.nome + '</li>';
                        });
                        html += '</ul>';
                        $('#clienteList').html(html);
                    }

                });
            }

            // Abre autocomplete ao pressionar ArrowDown
            $('#cliente').keydown(function(e) {
                if (e.key === "ArrowDown") {
                    buscarClientes($(this).val());
                }
            });

            // Atualização ao vivo se lista estiver aberta
            $('#cliente').on('input', function() {
                if ($('#clienteList').children().length > 0) {
                    buscarClientes($(this).val());
                }
            });

            // Clique em item
            $(document).on('click', '.dropdown-item', function() {
                $('#cliente').val($(this).text());
                $('#end').val($(this).data('endereco'));
                $('#fone').val($(this).data('fone'));
                $('#cliente_id').val($(this).data('cliente_id')); // valor do hidden
                $('#cliente_id').attr('data-cliente-id', $(this).data('cliente_id')); // atributo data
                $('#clienteList').html('');
            });



            // Fecha lista ao clicar fora
            $(document).click(function(e) {
                if (!$(e.target).closest('#cliente, #clienteList').length) {
                    $('#clienteList').html('');
                }
            });

        });
    </script>

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/input_image.js') }}"></script>
    <script src="{{ asset('js/mascara.js') }}"></script>

</x-app-layout>
