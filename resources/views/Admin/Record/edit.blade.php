@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Notas</h1>
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <div class="box-body">
            <form method="POST" {{--action="{{ route('records.create') }}--}}">
                @csrf

                <div class="row">
                       
                    <div class="col-md-6">
                        <input class="form-control" type="text" id="client_name" value="{{ $clientrecord->getClient->name }}" style="margin-left: 10px" disabled>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" id="client_cpf" value="{{ $clientrecord->getClient->cpf }}" disabled>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" id="client_tel" value="{{ $clientrecord->getClient->name }}" disabled>
                    </div>
                </div>


                        <div class="col-md-6">
                        <table id="content" class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if(isset($clientrecord->getItems))
                                @foreach($clientrecord->getItems as $recorditem)
                                    <tr>
                                        <td>{{$recorditem->getItem->name}}</td>
                                        <td>{{$recorditem->quantity}}</td>
                                        <td>{{$recorditem->item_total}}</td>
                                        
                                        <input type="hidden" name="item_id[]" value="{{$recorditem->getItem->id}}">
                                        <input type="hidden" name="item_quantity[]" value="{{$recorditem->quantity}}">
                                        <input type="hidden" name="subtotal" value="{{$recorditem->item_total}}">
                                        <td>
                                            <a class="btn btn-danger btn-xs remove" id="{{$recorditem->getItem->id}} {{$recorditem->item_total}}">
                                                <span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                        </td>

                                    </tr>
                                    
                                            
                                                      
                                @endforeach
                            @endif
                            @if(isset($clientrecord->getServices))
                                @foreach($clientrecord->getServices as $recordservice)
                                <tr>
                                    <td>{{$recordservice->getService->name}}</td>
                                    <td>{{$recordservice->quantity}}</td>
                                    <td>{{$recordservice->service_total}}</td>

                                    <input type="hidden" name="service_id[]" value="{{$recordservice->getservice->id}}">
                                    <input type="hidden" name="service_quantity[]" value="{{$recordservice->quantity}}">
                                    <input type="hidden" name="subtotal" value="{{$recordservice->service_total}}">
                                    <td>
                                        <a class="btn btn-danger btn-xs remove" id="{{$recordservice->getservice->id}} {{$recordservice->service_total}}">
                                            <span class="fa fa-trash"></span>&nbsp&nbsp;Excluir</a>
                                    </td>
                                </tr>               
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <td>
                                        <input class="form-control" type="text" name="total" id="record_total" value="{{ $clientrecord->record_total }}" disabled>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
{{--
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

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Conteudo da Nota</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
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
                                        <td>
                                            <input class="form-control" type="text" name="total" id="record_total" disabled>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <input type="hidden" id="amount">
                <input type="hidden" id="soma">


                <div class="container">

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
                </div>
--}}
                <div class="form-group">
                    {{--<button type="submit" class="btn btn-success">Criar</button>--}}
                </div>
            </form>
        </div>
    </div>
</div>

@stop


