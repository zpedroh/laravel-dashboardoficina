@extends('adminlte::page') 
@section('title', 'Notas') 
@section('content_header')
<h1>Editar Nota Nº {{ $clientrecord->id }}</h1>

@stop 
@section('content')

<div class="col-md-18">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Nota</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Parcelas</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                <div class="row" style="margin-bottom: 1%;">
                    <div  class="col-md-1">
                            <a href="{{route('record.print', $clientrecord->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print">Imprimir</i></a>
                    </div>

                    <div class="col-md-8"><p></p></div>                   

                    <div class="col-md-3">

                            <div class="pull-right">
                                <button type="button" class="btn btn-default">Status</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding-top: 14%; padding-bottom: 14%;">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">                                    
                                    @if($clientrecord->status == 1) <li><a href="{{ route('status.update', [$clientrecord['id'], 2])}}">Fechada</a></li> @endif
                                    <li><a href="{{ route('status.update', [$clientrecord['id'], 3])}}">Paga</a></li>
                                    <li><a href="{{ route('status.update', [$clientrecord['id'], 4])}}">Cancelada</a></li>
                                </ul>
                            </div>

                        
                    </div>
                </div>         

                <div class="row">

                    <div class="col-md-5" style="margin-bottom: 1%;">
                        <input class="form-control" type="text" id="client_name" value="{{ $clientrecord->getClient->name }}" disabled>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" id="client_cpf" value="{{ $clientrecord->getClient->cpf }}" disabled>
                    </div>
                    <div class="col-md-2"><p></p></div>
   
                </div>

                <form method="GET" action="{{ route('records.update', $clientrecord->id) }}">
                        @csrf
        
                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>

                        <input type="hidden" id="amount" value="{{ $clientrecord->record_total }}">
                        <input type="hidden" id="soma" value="{{ $clientrecord->record_total }}">
        
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">                  
                
                                        <div class="form-group">
                                            <select class="form-control select-item" id="item_id" name="item_id">
                                                <option value="">Selecione um Produto</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->getBrand->name }}</option>
                                                @endforeach                   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <div class="form-group">
                                            {{-- <label for="name">Quantidade</label>--}}
                                            <input type="number" class="form-control" id="item_amount" name="quantity_item" placeholder="Qtd">
                                        </div>
                                    </div>
                
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning add-item"><i class="glyphicon glyphicon-plus-sign"></i></button>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control select-service" id="service_id" name="service_id">
                                            <option value="">Selecione um Serviço</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach                   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <div class="form-group">
                                            {{--style="overflow-y:auto;" <label for="name">Quantidade </label>--}}
                                            <input type="number" class="form-control" id="service_amount" name="quantity_service" placeholder="Qtd">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning add-service"><i class="glyphicon glyphicon-plus-sign"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered" id="content_item">
                                            <thead style="font-size: 13px;">
                                                <th>Descrição</th>
                                                <th>Marca</th>
                                                <th>Quantidade</th>
                                                <th>Preço(un)</th>
                                                <th>Valor Total</th>
                                            </thead>
                                            <tbody style="font-size: 13px;">
                                                    @foreach($clientrecord->getItems as $recorditem)
                                                    <tr>
                                                        <td>{{$recorditem->getItem->name}}</td>
                                                        <td>{{$recorditem->getItem->getBrand->name}}</td>
                                                        <td>{{$recorditem->quantity}}</td>
                                                        <td>R$ {{$recorditem->getItem->price}}</td>
                                                        <td>R$ {{$recorditem->item_total}}</td>
                        
                                                        <td>
                                                            <a class="btn btn-danger btn-xs remove" id="{{$recorditem->getItem->id}} {{$recorditem->item_total}}"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                                        </td>
                        
                                                        <td>
                                                            <input type="hidden" name="item_id[]" value="{{$recorditem->getItem->id}}">
                                                            <input type="hidden" name="item_quantity[]" value="{{$recorditem->quantity}}">
                                                            <input type="hidden" class="item" name="subtotal" value="{{$recorditem->item_total}}">
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                            </tbody>
                                        </table>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <label for="total_item">Total Produtos:</label>
                                            <input type="text" name="total_item" id="total_item" class="form-control pull-right" value="R$ 0.00" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered" id="content_service">
                                            <thead style="font-size: 13px;">
                                                <th>Descrição</th>
                                                <th>Quantidade</th>
                                                <th>Preço(un)</th>
                                                <th>Valor Total</th>
                                            </thead>
                                            <tbody style="font-size: 13px;">
                                                    
                                                    @if(isset($clientrecord->getServices)) 
                                                    @foreach($clientrecord->getServices as $recordservice)
                                                    <tr>
                                                        <td>{{$recordservice->getService->name}}</td>
                                                        <td>{{$recordservice->quantity}}</td>
                                                        <td>R$ {{$recordservice->getService->price}}</td>
                                                        <td>R$ {{$recordservice->service_total}}</td>
                        
                                                        <input type="hidden" name="service_id[]" value="{{$recordservice->getservice->id}}">
                                                        <input type="hidden" name="service_quantity[]" value="{{$recordservice->quantity}}">
                                                        <input type="hidden" class="service" name="subtotal" value="{{$recordservice->service_total}}">
                                                        <td>
                                                            <a class="btn btn-danger btn-xs remove" id="{{$recordservice->getservice->id}} {{$recordservice->service_total}}">
                                                                            <span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach @endif

                                            </tbody>
                                        </table>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <label for="total_service">Total Serviço:</label>
                                            <input type="text" name="total_service" id="total_service" class="form-control pull-right" value="R$ 0.00" disabled>
                                        </div>
                                    </div>
                                </div>
                
                                <input type="hidden" id="amount">
                                <input type="hidden" id="soma">
                                <div class="row"><p></p></div>
                                <div class="row"><p></p></div>
                                <div class="row"> 
                
                                    <div class="col-md-2">
                                        <label for="prevision">Previsão:</label>
                                    <input type="date" name="prevision" id="prevision" value="{{$clientrecord->prevision}}" class="form-control">                        
                                    </div>
                                    <div class="col-md-2">
                                            <label for="conclusion">Conclusão:</label>
                                            <input type="date" name="conclusion" id="conclusion" value="{{$clientrecord->prevision}}" class="form-control">
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                            <label for="discount">Desconto:</label>
                                            <input class="form-control pull-right" type="text" name="discount" id="discount" placeholder="Desconto" value="R$ {{ $clientrecord->discount }}">
                                        </div>
                                        <div class="col-xs-3">         
                                            <label for="record_total">Total:</label>                        
                                            <input  class="form-control pull-right" type="text" name="total" id="record_total" placeholder="Total" value="R$ {{ $clientrecord->record_total }}" disabled>
                                        </div>    
                                </div>
                
                                <div class="row" style="margin-top:1%;" >
                
                                    <div class="col-md-4">
                                        <label for="paymentmethod_id">Forma de Pagamento:</label>
                                        <select class="form-control" id="paymentmethod_id" name="paymentmethod_id" required>
                                            <option value="">(Metodo/Parcelas/Periodo)</option>
                                            @foreach($paymentmethod as $method)
                                                <option value="{{ $method->id }}">{{ $method->type}} | {{ $method->parcel}} | {{ $method->period}}</option>
                                            @endforeach                   
                                        </select>
                                    </div>
                <div class="col-md-4"></div>
     {{--                               <div class="col-md-4">
                                        <label for="status_id">Status:</label>
                                        <select class="form-control" id="status_id" name="status_id">
                                            <option value="">Selecione o Status</option>
                                            <option value="1">Aberto</option> 
                                            <option value="2">Fechado</option> 
                                            <option value="3">Paga</option>                 
                                        </select>
                                    </div>--}}
                            
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control pull-right" style="margin-top: 7%;">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                
                </div>
            </div>
            <!-- /.tab-pane -->





            <div class="tab-pane" id="tab_2">
                
                <div class="table-responsive">
                    <div class="form-group pull-left">
                        @if($clientrecord->status < 3)
                            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">Adicionar Nova Parcela</button>
                        @endif
                    </div>
                    <table class="table table-stripped">
                        <thead>
                            <th>Numero</th>
                            <th>Status</th>                            
                            <th>Forma de Pagamento</th>
                            <th>Periodo</th>
                            <th>Data de Vencimento</th>
                            <th>Valor</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($clientrecord->getParcels as $parcel)
                            <tr>
                                <td>{{$parcel->number}}/{{$parcel->parcel_number}}</td>
                                <td>
                                    @if($parcel->status == 1)
                                        <span class="label label-warning">Aberta</span>
                                    @elseif($parcel->status == 2)
                                        <span class="label label-primary">Pendente</span>
                                    @elseif($parcel->status == 3)
                                        <span class="label label-success">Paga</span>
                                    @else
                                        <span class="label label-danger">Cancelada</span>
                                    @endif                                 
                                </td>
                                <td>{{$parcel->getMethod->type}}</td>
                                <td>{{$parcel->getMethod->period}}</td>
                                <td>{{$parcel->date_formatted}}</td>
                                <td>R$ {{$parcel->value}}</td>
                                <td>
                                    @if($parcel->status < 3)
                                        <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$parcel->id}}"><span class="fa fa-edit"></span></a>
                                        {{--<button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$parcel->id}}">Editar</button>--}}
                                    @endif
                                </td>
                                <td>
                                    @if($parcel->status < 3)         
                                        <a class="btn-xs btn-danger delete-confirm" href="{{ route('parcels.destroy', $parcel['id']) }}" type="button"><span class="fa fa-trash"></span></a>
                                        {{--<button class="btn-xs btn-danger delete-confirm" value="{{ route('parcels.destroy', $parcel['id']) }}" type="button">Delete</button>--}}
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-edit{{$parcel->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Editar Parcela</h4>
                                        </div>

                                        <div class="modal-body">
                                            <form method="get" action="{{route('parcels.update', $parcel->id)}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="number">Nº:</label>
                                                    <input type="text" class="form-control" name="number" value="{{$parcel->number}}" disabled>
                                                    <label for="date">Data Vencimento:</label>
                                                    <input type="date" class="form-control" name="date" value="{{$parcel->date}}">
                                                    <label for="status">Status:</label>
                                                    <select name="status" id="status" class="form-control">
                                                            <option value="2">Pendente</option>
                                                            <option value="3">Paga</option>
                                                        </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>

                
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Parcela</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('parcels.create') }}">
                    @csrf

                    <div class="form-group">

                        <input type="hidden" name="record_id" id="record_id" value="{{$clientrecord->id}}">

                        <label for="date">Data de Vencimento:</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Data">

                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                                        <option value="2">Pendente</option>
                                        <option value="3">Paga</option>
                                    </select>

                        <label for="paymentmethod_id">Forma de Pagamento:</label>
                        <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                                            <option value="">(Metodo/Parcelas/Periodo)</option>
                                            @foreach($paymentmethod as $method)
                                                <option value="{{ $method->id }}">{{ $method->type}} | {{ $method->parcel}} | {{ $method->period}}</option>
                                            @endforeach                   
                                    </select>
                        <label for="value">Valor:</label>
                        <input type="text" class="form-control" name="value" id="value">
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        </div>
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
    
            $('.select-item').select2({
                language: "pt-BR",
            });
    
            $('.select-service').select2({
                language: "pt-BR",
            });        
        });
    </script>

<script type="text/javascript" src="{{ asset('js/record/record.js')}}"></script>
<script src="{{ asset('js/mask/jquery.maskMoney.min.js') }}" type="text/javascript"></script>

<script>
    $("#record_total").maskMoney({prefix: 'R$ ', thousands:' ', decimal: '.'});
    $("#discount").maskMoney({prefix: 'R$ ', thousands:' ', decimal: '.'});
    $("#value").maskMoney({prefix: 'R$ ', thousands:' ', decimal: '.'});
</script>

@stop
<!--
{{--
bckup 2

<form method="GET" action="{{ route('records.update', $clientrecord->id) }}">
                        @csrf
        
                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>

                        <input type="hidden" id="amount" value="{{ $clientrecord->record_total }}">
                        <input type="hidden" id="soma" value="{{ $clientrecord->record_total }}">
        
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
                                <tbody>
                                        @foreach($clientrecord->getItems as $recorditem)
                                        <tr>
                                            <td>{{$recorditem->getItem->name}}</td>
                                            <td>{{$recorditem->quantity}}</td>
                                            <td>R$ {{$recorditem->getItem->price}}</td>
                                            <td>R$ {{$recorditem->item_total}}</td>
            
                                            <td>
                                                <a class="btn btn-danger btn-xs remove" id="{{$recorditem->getItem->id}} {{$recorditem->item_total}}"><span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                            </td>
            
                                            <td>
                                                <input type="hidden" name="item_id[]" value="{{$recorditem->getItem->id}}">
                                                <input type="hidden" name="item_quantity[]" value="{{$recorditem->quantity}}">
                                                <input type="hidden" name="subtotal" value="{{$recorditem->item_total}}">
                                            </td>
                                        </tr>
                                        @endforeach 
                                        @if(isset($clientrecord->getServices)) 
                                        @foreach($clientrecord->getServices as $recordservice)
                                        <tr>
                                            <td>{{$recordservice->getService->name}}</td>
                                            <td>{{$recordservice->quantity}}</td>
                                            <td>R$ {{$recordservice->getService->price}}</td>
                                            <td>R$ {{$recordservice->service_total}}</td>
            
                                            <input type="hidden" name="service_id[]" value="{{$recordservice->getservice->id}}">
                                            <input type="hidden" name="service_quantity[]" value="{{$recordservice->quantity}}">
                                            <input type="hidden" name="subtotal" value="{{$recordservice->service_total}}">
                                            <td>
                                                <a class="btn btn-danger btn-xs remove" id="{{$recordservice->getservice->id}} {{$recordservice->service_total}}">
                                                                <span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                            </td>
                                        </tr>
                                        @endforeach @endif
                                </tbody>
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
                                <input style="align-self: auto" class="form-control pull-right" type="text" name="total" id="record_total" placeholder="Total" value="R$ {{ $clientrecord->record_total }}" disabled>
                                <input style="align-self: auto" class="form-control pull-right" type="text" name="discount" id="discount" placeholder="Desconto">
                            </div>     
                        </div>
        
                        <div class="row" style="margin-top:1%;" >
        
                            <div class="col-md-4">
                                <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                                    <option value="">Selecione a Forma de Pagamento</option>
                                    @foreach($paymentmethod as $method)
                                        <option value="{{ $method->id }}">{{ $method->type}} {{$method->period }} Dias</option>
                                    @endforeach                   
                                </select>
                            </div>
        
                            <div class="col-md-4">
                                <select class="form-control" id="status_id" name="status_id">
                                    <option value="">Selecione o Status</option>
                                    <option value="1">Aberto</option> 
                                    <option value="2">Fechado</option> 
                                    <option value="3">Paga</option>                 
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control pull-right">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>

    
    --}}




{{--
bckp 1
    <form method="GET" action="{{ route('records.update', $clientrecord->id) }}">
                @csrf

                <input type="hidden" id="amount" value="{{ $clientrecord->record_total }}">
                <input type="hidden" id="soma" value="{{ $clientrecord->record_total }}">
                <div class="table-responsive">
                    <table id="content" class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Valor(un)</th>
                                <th>Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="total" id="record_total" value="{{ $clientrecord->record_total }}" disabled>
                                </td>
                            </tr>
                            <tr></tr>
                        </tfoot>
                    </table>
           

                        <div class="col-md-4 form-group">
                            <select class="form-control" id="paymentmethod_id" name="paymentmethod_id" required>
                                    <option value="">Selecione a Forma de Pagamento</option>
                                    @foreach($paymentmethod as $method)
                                        <option value="{{ $method->id }}">{{ $method->type}} {{$method->period }} Dias</option>
                                    @endforeach                   
                                    </select>
                        </div>
    
                        <div class="col-md-4 form-group">
                            <select class="form-control" id="status_id" name="status_id" required>
                                    <option value="">Selecione o Status</option>
                                    <option value="1">Aberto</option> 
                                    <option value="2">Fechado</option> 
                                    <option value="3">Paga</option>                 
                                    </select>
                        </div>
      

                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Salvar</button>
                    </div>
            </form>
    
    --}}