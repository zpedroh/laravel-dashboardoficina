@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Editar Nota Nº {{ $clientrecord->id }}</h1>





@stop 
@section('content')

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Nota</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Parcelas</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">


            <div class="row">

                <div class="col-md-4">
                    <input class="form-control" type="text" id="client_name" value="{{ $clientrecord->getClient->name }}" style="margin-left: 10px"
                        disabled>
                </div>
                <div class="col-md-2">
                    <input class="form-control" type="text" id="client_cpf" value="{{ $clientrecord->getClient->cpf }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Produto </label>

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
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">

            <div class="table-responsive">
                <div class="form-group pull-left">
                    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">Adicionar Nova Parcela</button>
                </div>
                <table class="table table-stripped">
                    <thead>
                        <th>Numero</th>
                        <th>Status</th>
                        <th>Data de Vencimento</th>
                        <th>Forma de Pagamento</th>
                        <th>Periodo</th>
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($clientrecord->getParcels as $parcel)
                        <tr>
                            <td>{{$parcel->number}}/{{$parcel->getMethod->parcel}}</td>
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
                            <td>{{$parcel->date}}</td>
                            <td>{{$parcel->getMethod->type}}</td>
                            <td>{{$parcel->getMethod->period}}</td>
                            <td>{{$parcel->getMethod->duedate}}</td>
                            <td>R$ {{$parcel->value}}</td>
                            <td>
                                <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$parcel->id}}">Editar</button>
                            </td>
                            @if($parcel->status < 3) <td>
                                <button class="btn btn-danger delete-confirm" value="{{ route('parcels.destroy', $parcel['id']) }}" type="button">Delete</button>
                                </td>
                            @endif
                        </tr>
                        <div class="modal fade" id="modal-edit{{$parcel->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Entrada de Estoque</h4>
                                    </div>

                                    <div class="modal-body">
                                        <form method="get" action="{{route('parcels.update', $parcel->id)}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" value="{{$parcel->number}}" disabled>

                                                <input type="date" class="form-control" name="date" value="{{$parcel->date}}">

                                                <select name="status" id="status" class="form-control">
                                                        <option value="2">Pendente</option>
                                                        <option value="3">Paga</option>
                                                    </select>

                                                <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                                                            <option value="">Selecione a Forma de Pagamento</option>
                                                            @foreach($paymentmethod as $method)
                                                                <option value="{{ $method->id }}">{{ $method->type}}</option>
                                                            @endforeach                   
                                                    </select>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
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

                        <input type="date" class="form-control" name="date" placeholder="Data">

                        <select name="status" id="status" class="form-control">
                                        <option value="2">Pendente</option>
                                        <option value="3">Paga</option>
                                    </select>

                        <select class="form-control" id="paymentmethod_id" name="paymentmethod_id">
                                            <option value="">Selecione a Forma de Pagamento</option>
                                            @foreach($paymentmethod as $method)
                                                <option value="{{ $method->id }}">{{ $method->type}}</option>
                                            @endforeach                   
                                    </select>

                        <input type="text" class="form-control" name="value" id="value">
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Salvar</button>
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



@stop