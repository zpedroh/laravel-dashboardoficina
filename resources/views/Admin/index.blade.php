@extends('adminlte::page') 
@section('title', 'Home') 
@section('content_header')
<h1>Dashboard</h1>



@stop 
@section('content')
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$record_quantity}}</h3>

                    <p>Novas Notas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$payedpercent}}<sup style="font-size: 20px">%</sup></h3>

                    <p>Media de Pagamento</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$client_quantity}}</h3>

                    <p>Novos Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">

                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->


    <table class="table table-hover">
        <thead>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Localizaçao</th>
            <th>Estoque</th>
            <th>Minimo</th>
        </thead>
        <tbody>
            @foreach ($item as $item) 
            
            @if($item->getItemStock->quantity <= $item->getItemStock->quantity_min)

                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->getCategory->name}}</td>
                    <td>{{$item->getBrand->name}}</td>
                    <td>{{$item->location}}</td>
                    <td>{{$item->getItemStock->quantity}}</td>
                    <td>{{$item->getItemStock->quantity_min}}</td>

                    <td>
                        <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$item->id}}" data-info="{{$item->id}}, {{$item->name}}, {{$item->getBrand->id}}, {{$item->getCategory->id}}, {{$item->getItemStock->id}}, {{$item->getItemStock->quantity}}">Adicionar</button>
                    </td>
                </tr>
                <div class="modal fade" id="modal-edit{{$item->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Entrada de Estoque</h4>
                            </div>

                            <div class="modal-body">
                                <form method="get" action="{{route('stock.update', $item->id)}}">
                                    @csrf

                                    <input type="hidden" value="{{$item->id}}">

                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{$item->name}}" disabled>

                                    <label for="quantity">Quantidade à Adicionar:</label>
                                    <input type="number" class="form-control" name="quantity" value="0">

                                    <label for="quantity">Quantidade Minima:</label>
                                    <input type="text" class="form-control" name="quantity_min" value="{{$item->getItemStock->quantity_min}}" disabled>

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

                @endif @endforeach
        </tbody>

        <table class="table table-hover">

            <thead>
                <th>Numero da Nota</th>
                <th>Cliente</th>
                <th>Parcela</th>
                <th>Valor da Parcela</th>
                <th>Data de Vencimento</th>
            </thead>
            <tbody>
                @foreach($parcels as $parcel)
                <tr>
                    <td>{{$parcel->client_record_id}}</td>
                    <td>{{$parcel->getRecord->getClient->name}}</td>
                    <td>{{$parcel->number}}/{{$parcel->getMethod->parcel}}</td>
                    <td>{{$parcel->value}}</td>
                    <td>{{$parcel->date}}</td>
                    <td>
                        <a href="{{ route('records.edit', $parcel['client_record_id'])}}">
                            <button class="btn btn-edit" type="submit">Editar</button>
                        </a>
                    </td>

                </tr>
                {{--@if($record->created_at->format('m-y') == $tdate)@endif--}} @endforeach

            </tbody>
        </table>
    </table>



    
@stop