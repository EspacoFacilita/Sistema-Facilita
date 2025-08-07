<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between d-flex align-items-center"   >
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Visualizar Ordem de Serviço') }}
            </span>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                    @endif                
                    <form action="{{ route('adminOrdemDeServico.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-between d-flex align-items-center">
                            <div class="d-flex flex-row d-flex align-items-center">
                                <h3 class="m-0">Estados da ordem de serviço:</h3>
                                <div class="row ms-1">
                                    <div class="col ">
                                        @php
                                            $userType = Auth::user()->usertype;
                                        @endphp
                                        @if($userType == 'Guichê' && $ordemServico->status === 'Concluido')
                                            <select id="status" name="status" class="form-control pe-5" required disabled >
                                                <option value="Pendente" {{ $ordemServico->status === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                                <option value="Impressão" {{ $ordemServico->status === 'Impressão' ? 'selected' : '' }}>Impressão</option>
                                                <option value="Laser" {{ $ordemServico->status === 'Laser' ? 'selected' : '' }}>Laser</option>
                                                <option value="Produção" {{ $ordemServico->status === 'Produção' ? 'selected' : '' }}>Produção</option>
                                                <option value="Concluido" {{ $ordemServico->status === 'Concluido' ? 'selected' : '' }}>Concluído</option>
                                                <option value="Entregue" {{ $ordemServico->status === 'Entregue' ? 'selected' : '' }}>Entregue</option>
                                            </select>
                                        @else
                                            <select id="status" name="status" class="form-control pe-5" required >
                                            @if(in_array($userType, ['Guichê', 'Impressão', 'Produção', 'Caixa', 'Admin', 'Design']))
                                                <option value="Pendente" {{ $ordemServico->status === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                                <option value="Impressão" {{ $ordemServico->status === 'Impressão' ? 'selected' : '' }}>Impressão</option>
                                                <option value="Produção" {{ $ordemServico->status === 'Produção' ? 'selected' : '' }}>Produção</option>
                                                <option value="Laser" {{ $ordemServico->status === 'Laser' ? 'selected' : '' }}>Laser</option>
                                            @endif
                                            @if(in_array($userType, ['Impressão', 'Produção', 'Caixa', 'Admin', 'Design']))
                                                <option value="Concluido" {{ $ordemServico->status === 'Concluido' ? 'selected' : '' }}>Concluído</option>
                                            @endif
                                            @if(in_array($userType, ['Caixa', 'Admin', 'Design']))
                                                <option value="Entregue" {{ $ordemServico->status === 'Entregue' ? 'selected' : '' }}>Entregue</option>
                                            @endif
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between d-flex align-items-center">
                                <a style="background-color: #DC1C2E;border: 2px solid #DC1C2E;"  href="{{ route('adminOrdemDeServico.show',['id'=> $ordemServico->id])}}" class="btn btn-primary me-3">Cancelar</a>
                                <div class="row">
                                    <div class="d-grid">
                                        <button style="background-color: #198754;border: 2px solid #198754;" href="" class="btn btn-primary">Pronto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-between align-items-center border border-black">
                                <x-application-logo class="block h-20 p-2 fill-current text-gray-800" />
                                <div class=" form-floating ml-4">
                                    <input type="text" name="" class="form-control floatingInput" id="" placeholder="CÓD. ARTE" value=""  disabled="disabled">
                                    <label class="  ms-3"for="floatingInput">CÓD. ARTE</label>
                                    @error('ORC_venda')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class=" form-floating ml-4">
                                    <input type="text" name="ORC_venda" class="form-control floatingInput" id="ORC_venda" placeholder="ORC de venda" value="{{$ordemServico->ORC_venda}}">
                                    <label class="  ms-3"for="floatingInput">ORC DE VENDA</label>
                                    @error('ORC_venda')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mt-4 border border-black ">
                                <div class="row mb-3 mt-4">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2  "for="">Cliente:</label>
                                        <input type="text" name="cliente" class="form-control " id="cliente" placeholder="Nome do Cliente" value="{{$ordemServico->cliente}}" required>
                                        @error('cliente')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2"for="">Serviço:</label>
                                        <input type="text" name="servico" class="form-control " id="servico" placeholder="Serviço" value="{{$ordemServico->servico}}" required>
                                        @error('servico')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2"for="">Endereço:</label>
                                        <input type="text" name="end" class="form-control" id="end" placeholder="Endereço" value="{{$ordemServico->end}}">
                                        @error('end')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-between align-items-center" x-data="{ telefone : ' ' }">
                                        <label class="  mx-2"for="">Fone:</label>
                                        <input type="text" name="fone" class="form-control " id="fone" placeholder="Fone" x-mask="(99) 99999-9999" value="{{$ordemServico->fone}}">
                                        @error('fone')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 d-flex justify-content-between align-items-center">
                                        <label class=" col-3 mx-2">Valor R$:</label>
                                        <input type="text" name="valor" class="form-control " id="valor" placeholder="Valor R$" value="{{$ordemServico->valor}}" onInput="mascaraMoeda(event);" required>
                                        @error('valor')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 form-floating d-flex justify-content-between d-flex align-items-center">
                                        <span>Pago:</span>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-black rounded-0" type="radio" name="pago" id="pago_sim" value="sim" {{ $ordemServico->pago == 'sim' ? 'checked' : '' }}  required>
                                            <label class="form-check-label" for="pago_sim">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-black rounded-0" type="radio" name="pago" id="pago_nao" value="nao"  {{ $ordemServico->pago == 'nao' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="pago_nao">Não</label>
                                            
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input border border-black rounded-0" type="radio" name="pago" id="pago_50" value="50%" {{ $ordemServico->pago == '50%' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="pago_50">50%</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <label class="  mx-2">Falta:</label>
                                        <input type="text" name="falta" class="form-control " id="falta" placeholder="Falta" value="{{$ordemServico->falta}}" onInput="mascaraMoeda(event);">
                                    </div>
                                </div>
                                <div style="border: 2px solid #094081;" class="col-13 row d-flex justify-content-evenly  ">
                                    <h5 style="background-color: #094081;" class="col-12 d-flex justify-content-center text-white">PRAZO  DE ENTREGA DO SERVIÇO</h5>
                                    <div class=" d-flex justify-content-between">
                                        <div class="col-5"> 
                                            <div class="row mb-3 ">
                                                <div class="col d-flex justify-content-between align-items-center">
                                                    <label class="  mx-2">D.R:</label>
                                                    <input type="date" name="data_de_recebimento" class="form-control " id="data_de_recebimento" placeholder="Data de recebimento" value='{{($ordemServico->data_de_recebimento)}}'>
                                                    @error('data_de_recebimento')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col d-flex justify-content-between align-items-center">
                                                    <label class="  mx-2">D.E:</label>
                                                    <input type="date" name="data_de_entrega" class="form-control " id="data_de_entrega" placeholder="Data de entrega" value="{{($ordemServico->data_de_entrega)}}" required>
                                                    @error('data_de_entrega')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 col-6 d-flex align-items-center">
                                            <div>
                                                <label class="mx-2 mb-2">HORA ENTREGA:</label>
                                                <input type="time" name="hora_de_entrega" class=" form-control " id="hora_de_entrega" placeholder="Hora de entrega" value="{{($ordemServico->hora_de_entrega)}}" required>
                                                @error('hora_de_entrega:')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                            <div class="mt-4 p-0 flex-wrap col-6 form-floating d-flex d-flex justify-content-evenly flex-wrap">
                                <div class="col-12 row d-flex justify-content-evenly border border-success border-bottom-0 ">
                                    <h5 class="col-12 d-flex justify-content-center text-bg-success align-items-center">PRAZO DA IMPRESSÃO</h5>
                                    <div class="row mb-3 col-6 align-items-center">
                                        <div class="col  d-flex justify-content-between align-items-center">
                                            <label class="  mx-2">D.E:</label>
                                            <input type="date" name="prazo_da_impressao_data" class="form-control" id="prazo_da_impressao_data" placeholder="Data de entrega da impressão" value='{{($ordemServico->prazo_da_impressao_data)}}'>
                                            @error('prazo_da_impressao_data')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 col-6 align-items-center">
                                        <div class="col">
                                            <label class="  ms-3">HORA ENTREGA:</label>
                                            <input type="time" name="prazo_da_impressao_hora" class="form-control" id="prazo_da_impressao_hora" placeholder="Hora de entrega da impressão" value="{{($ordemServico->prazo_da_impressao_hora)}}">
                                            @error('prazo_da_impressao_hora')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div style="border: 2px solid #FF8A00;" class="col-12 row d-flex justify-content-evenly border-bottom-0 ">
                                    <h5 style="background-color: #FF8A00;" class="col-12 d-flex justify-content-center text-white align-items-center">ESTA ABA É RESTRITAMENTE DO IMPRESSOR</h5>
                                    <div class="col-6 row mb-3 align-items-center">
                                        <div class="">
                                            <label class="  ms-3">DIA REC. DO CONTROLE </label>
                                            <input type="date" name="dia_do_recebimento_do_controle" class="form-control " id="dia_do_recebimento_do_controle" placeholder="Rec. do controle" value='{{($ordemServico->dia_do_recebimento_do_controle)}}'>
                                            @error('dia_do_recebimento_do_controle')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 col-6 align-items-center ">
                                        <div class="">
                                            <label class="ms-3" for="">HORA REC. </label>
                                            <input type="time" name="hora_do_recebimento_do_controle" class="form-control " id="hora_do_recebimento_do_controle" placeholder="Hora do recebimento" value="{{( $ordemServico->hora_do_recebimento_do_controle)}}">
                                            @error('hora_do_recebimento_do_controle')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div style="border: 2px solid #8F00FF;" class="col-12 row d-flex justify-content-evenly  border-bottom-0 ">
                                    <h5 style="background-color: #8F00FF;" class="col-12 d-flex justify-content-center text-white align-items-center">SERVIÇO EXTERNO</h5>
                                    <div class="col-6 form-floating d-flex justify-content-between d-flex align-items-center">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input border border-black  rounded-0" type="radio" name="servico_externo" id="servico_externo" value="1"
                                            {{ $ordemServico->servico_externo == '1' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  border border-black  rounded-0" type="radio" name="servico_externo" id="servico_externo" value="0"{{ $ordemServico->servico_externo == '0' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="inlineRadio2">Não</label>
                                        </div>
                                    </div>
                                </div> 
                                <div style="border: 2px solid #D80707;"  class="col-12 row d-flex justify-content-evenly  ">
                                    <h5 style="background-color: #D80707;" class="col-12 d-flex justify-content-center text-white align-items-center">FORMAS DE PAGAMENTO SERVIÇO EXTERNO</h5>
                                    <div class=" d-flex justify-content-evenly">
                                        <div class="d-flex flex-column">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  border border-black rounded-0" type="radio" name="formas_de_pagamento" id="formas_de_pagamento" value="pix"{{ $ordemServico->formas_de_pagamento == 'pix' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="inlineRadio1">PIX</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  border border-black  rounded-0" type="radio" name="formas_de_pagamento" id="formas_de_pagamento" value="transfbanc./deposito"{{ $ordemServico->formas_de_pagamento == 'transfbanc./deposito' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="inlineRadio1">CARTÃO</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  border border-black  rounded-0" type="radio" name="formas_de_pagamento" id="formas_de_pagamento" value="pag.naloja"{{ $ordemServico->formas_de_pagamento == 'pag.naloja' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="inlineRadio1">TRANSF.BANC./DEPÓSITO</label>
                                            </div>
                                        </div>
                                        <div class=" d-flex flex-column">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  border border-black  rounded-0" type="radio" name="formas_de_pagamento" id="formas_de_pagamento" value="dinheiro"{{ $ordemServico->formas_de_pagamento == 'dinheiro' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="inlineRadio1">DINHEIRO</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  border border-black  rounded-0" type="radio" name="formas_de_pagamento" id="formas_de_pagamento" value="cartao"{{ $ordemServico->formas_de_pagamento == 'cartao' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="inlineRadio1">PAG. NA LOJA</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="p-0 mt-4">
                                <div class="border border-black">
                                    <h4  style="background-color: #9B9A9C;" class="d-flex justify-content-center col-12 ">OBSERVAÇÃO:</h4>
                                    <div class="row mb-3">
                                        <div class="col form-floating">
                                            <textarea type="text" name="observacoes_pedido" class="form-control floatingInput" style="height: 100px" id="observacoes_pedido" placeholder="Observacoes da ordem" >{{ ($ordemServico->observacoes_pedido) }}</textarea>
                                            <label class="  ms-3"for="floatingInput">OBSERVAÇÕES</label>
                                            @error('observacoes_pedido')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-dark  ">             
                                @if (session('success'))
                                    <p>{{ session('success') }}</p>
                                    <div id="image-preview">
                                        <img src="{{ asset('storage/' . session('path')) }}" alt="Imagem carregada">
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="col-12 d-flex">
                                <div class="col-6 d-flex flex-row align-items-center mt-3">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="m-0">LAYOUT:</h4>
                                        <div class="row">
                                            <div class="col ms-3">
                                                <!-- Input de arquivo -->
                                                <input type="file" name="layout" class="form-control" id="layout">
                                                @error('layout')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end col-6 mt-3">
                                    <button type="button" id="removeImageButton" class="btn btn-danger ml-3" style="visibility: hidden;" onclick="removeImage()">Remover</button>
                                    @if($ordemServico->layout)
                                        <label for="remover_imagem" class="btn btn-danger ms-3">
                                            <input type="checkbox" name="remover_imagem" id="remover_imagem" value="1">
                                            Remover Imagem
                                        </label>
                                    @endif
                                </div>

                            </div>

                            <div class="border border-dark-subtle mt-3">
                                <!-- Área de preview -->
                                <div class="d-flex justify-content-center" style="height: 300px; cursor: pointer;" onclick="triggerFileInput()">
                                    <!-- Imagem de preview -->
                                    <img 
                                        class="m-3" 
                                        id="preview" 
                                        src="{{ $ordemServico->layout ? asset('uploads/ordemdeservico/' . $ordemServico->layout) : '' }}" 
                                        alt="Nenhuma imagem selecionada" 
                                        style="max-width: 100%; max-height: 100%; object-fit: contain; {{ $ordemServico->layout ? '' : 'display:none;' }}">

                                    <!-- Mensagem padrão caso não tenha imagem -->
                                    <span id="no-image-message" style="{{ $ordemServico->layout ? 'display:none;' : '' }}">
                                        Nenhuma imagem selecionada
                                    </span>
                                </div>
                            </div>

                                <div class="col-6 form-floating d-flex justify-content-between d-flex align-items-center mt-3">
                                    <h4 class="m-0">EMBALAGEM:</h4>
                                    <div class="form-check form-check-inline ms-2">
                                        <input class="form-check-input rounded-0  border border-black " type="radio" name="embalagem" id="embalagem" value="sim"{{$ordemServico->embalagem === 'sim' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                                    </div>
                                    <div class="form-check form-check-inline m-2">
                                        <input class="form-check-input rounded-0 border border-black" type="radio" name="embalagem" id="embalagem" value="nao"{{ $ordemServico->embalagem === 'nao' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">NÃO</label>
                                    </div>
                                    <div class="col d-flex flex-row ">
                                        <h4 class="d-flex align-items-center m-0 p-2">OBS:</h4>
                                        <input type="text" name="observacoes_layout" class="form-control " id="observacoes_layout" placeholder="Observacoes" value="{{($ordemServico->observacoes_layout )}}"{{ ($ordemServico->observacoes_layout) }}>
                                        @error('observacoes_layout')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-floating d-flex justify-content-end mt-5 me-4">
                                <div class="row mb-3">
                                    <div class="col me-5 ">
                                        <input type="text" name="nome_funcionario" class="form-control floatingInput" id="nome_funcionario" placeholder="Nome do funcionario" value="{{$ordemServico->nome_funcionario}}" required>
                                        <h2 class="d-flex justify-content-center">Funcionario</h2>
                                        @error('nome_funcionario')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
</x-app-layout>
        