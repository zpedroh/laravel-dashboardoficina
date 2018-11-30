@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Cadastrar Pedido</h1>

@stop 
@section('content')

<div class="col-md-8">

    <div class="box">
        <div class="box-header">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <select class="form-control select-client" id="client_select" name="client_select" required>
                            <option value="">Selecione um Cliente</option>
                            @foreach($client as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach                   
                            </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                        Adicionar Cliente
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input class="form-control" type="text" id="client_name" disabled>
                </div>
            </div>
            <div class="row" style="margin-top: 1%;">
                <div class="col-md-4">
                    <input class="form-control" type="text" id="client_cpf" disabled>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" id="client_tel" disabled>
                </div>
            </div>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('records.create') }}">
                @csrf

                <input type="hidden" name="client_id" id="client_id">
                <input type="hidden" name="user_id" value={{Auth::user()->id}}>

                <div class="form-group">
                <div class="row">
                    <div class="col-md-6">                  

                        <div class="form-group">
                            <select class="form-control select-item" id="item_id" name="item_id">
                                <option value="">Selecione um Produto</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->getBrand->name }}</option>
                                @endforeach                   
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            {{-- <label for="name">Quantidade</label>--}}
                            <input type="number" class="form-control" id="item_amount" name="quantity_item" placeholder="Qtd">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-warning add-item"><i class="glyphicon glyphicon-plus-sign"></i></button>
                        </div>
                    </div>
                </div>                

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <select class="form-control select-service" id="service_id" name="service_id">
                            <option value="">Selecione um Serviço</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach                   
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            {{--style="overflow-y:auto;" <label for="name">Quantidade </label>--}}
                            <input type="number" class="form-control" id="service_amount" name="quantity_service" placeholder="Qtd">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-warning add-service"><i class="glyphicon glyphicon-plus-sign"></i></button>
                        </div>
                    </div>
                </div>
               {{-- 
                <div class="table-responsive"></div>--}}
                    <table class="table table-striped table-bordered" id="content">
                        <thead>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Preço(un)</th>
                            <th>Valor Total</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                

                <input type="hidden" id="amount">
                <input type="hidden" id="soma">

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-1"></div>
                    <div class="col-xs-3">         
                        {{--style="align-self: auto"--}}
                                       
                        <input  class="form-control pull-right" type="text" name="total" id="record_total" placeholder="Total" disabled>
                        <input class="form-control pull-right" type="text" name="discount" id="discount" placeholder="Desconto">
                    </div>     
                </div>

                <div class="row" style="margin-top:1%;" >

                    <div class="col-md-4">
                        <label for="paymentmethod_id">Forma de Pagamento:</label>
                        <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                            <option value="">Selecione a Forma de Pagamento</option>
                            @foreach($paymentmethod as $method)
                                <option value="{{ $method->id }}">{{ $method->type}}</option>
                            @endforeach                   
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status_id">Status:</label>
                        <select class="form-control" id="status_id" name="status_id">
                            <option value="">Selecione o Status</option>
                            <option value="1">Aberto</option> 
                            <option value="2">Fechado</option> 
                            <option value="3">Paga</option>                 
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control pull-right" style="margin-top: 11%;">Criar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

{{--Modais--}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Cliente</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('clients.create') }}">
                    @csrf
                    <input type="hidden" name="client_register_record" value="2">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" placeholder="Nome" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" id="cpf" name="cpf" placeholder="CPF" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone">Telefone:</label>
                                    <input type="text" id="telephone" name="telephone" placeholder="Telefone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cep">CEP:</label>
                                    <input type="text" id="cep" name="zipcode" placeholder="CEP" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rua">Rua:</label>
                                    <input type="text" id="rua" name="street" placeholder="Rua" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="numero">Nº:</label>
                                    <input type="text" id="numero" name="number" placeholder="Número" class="form-control" required>
                                </div>
                            </div>
    
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" id="bairro" name="district" placeholder="Bairro" class="form-control" required>
                                </div>
    
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" id="cidade" name="city" placeholder="Cidade" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="uf">UF:</label>
                                    <input type="text" id="uf" name="state" placeholder="Estado" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="complemento">Complemento:</label>
                                    <input type="text" id="complemento" name="complement" placeholder="Complemento" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        </div>
    
                    </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function() {
        $('.select-client').select2({
            language: "pt-BR",
        });

        $('.select-item').select2({
            language: "pt-BR",
        });

        $('.select-service').select2({
            language: "pt-BR",
        });        
    });
</script>

<script src="{{ asset('js/mask/jquery.maskMoney.min.js') }}" type="text/javascript"></script>

<script>
    $("#record_total").maskMoney({prefix: 'R$ ', thousands:' ', decimal: '.'});
    $("#discount").maskMoney({prefix: 'R$ ', thousands:' ', decimal: '.'});
</script>

@stop