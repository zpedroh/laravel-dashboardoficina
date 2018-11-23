@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Cadastrar Notas</h1>

@stop 
@section('content')
<div class="box">
    <div class="box-header">
        <div class="box-body">
            <form method="POST" action="{{ route('records.create') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-left: 10px">
                            <select class="form-control select-client" id="client_id" name="client_id" required>
                                <option value="Selecione um Cliente"></option>
                                @foreach($client as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach                   
                                </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" id="client_name" style="margin-left: 10px" disabled>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" id="client_cpf" disabled>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" id="client_tel" disabled>
                    </div>
                </div>

            
                <div class="row">
                    <div class="col-md-6">
                        <label>Produto </label>

                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>

                        <div class="form-group">
                            <select class="form-control" id="item_id" name="item_id">
                                <option value="">Selecione um Produto</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach                   
                                </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="name">Quantidade</label>
                            <input type="text" class="form-control" id="item_amount" name="quantity_item">
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group" style="margin-top: 25px;">
                            <button type="button" class="btn btn-success add-item">+</button>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Serviço</label>

                        <div class="form-group">
                            <select class="form-control" id="service_id" name="service_id">
                            <option value="">Selecione um Serviço</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach                   
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="name">Quantidade </label>
                            <input type="text" class="form-control" id="service_amount" name="quantity_service">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top: 25px;">
                            <button type="button" class="btn btn-success add-service">+</button>
                        </div>
                    </div>
                </div>
            

                <table class="table table-hover" id="content">
                    <thead>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço(un)</th>
                        <th>Valor Total</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            
                                
                            
                        </tr>
                    </tfoot>
                </table>
            
                <input type="hidden" id="amount">
                <input type="hidden" id="soma">

                <div class="row" style="margin:auto; padding:5%;" >

                    <div class="col-md-4 form-group">
                        <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                            <option value="">Selecione a Forma de Pagamento</option>
                            @foreach($paymentmethod as $method)
                                <option value="{{ $method->id }}">{{ $method->type}} {{$method->period }} Dias</option>
                            @endforeach                   
                            </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <select class="form-control" id="status_id" name="status_id">
                            <option value="">Selecione o Status</option>
                            <option value="1">Aberto</option> 
                            <option value="2">Fechado</option> 
                            <option value="3">Paga</option>                 
                            </select>
                    </div>
                    <input style="align-self: auto" class="pull-right" type="text" name="total" id="record_total" disabled>
                </div>
                <div class="row" style="margin:auto; padding:5%;" >
                    <input style="align-self: auto" class="pull-right" type="text" name="discount" id="discount" value="0">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>






<script>
$(document).ready(function() {
    $('.select-client').select2({
        language: "pt-BR"
    });

    $("#record_total").maskMoney({prefix: 'R$ ', thousands:'.', decimal: ','});
    
});
</script>
<script>
    $(document).ready(function() {
        $("#discount").maskMoney({prefix: 'R$ ', thousands:'.', decimal: ','});
    });
</script>
@stop