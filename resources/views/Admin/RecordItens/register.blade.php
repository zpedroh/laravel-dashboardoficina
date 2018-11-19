@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')

<h1>Adicionar itens na Nota</h1>

@stop 
@section('content')
<form method="POST" {{--action="{{ route('add.item') }}--}}">

    <div class="box-body">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label>Produto</label>
                <input type="hidden" name="clientrecord_id" value="{{$clientrecord->id}}">
                <div class="form-group">
                    <select class="form-control" id="item_id" name="item_id" required>
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
                    <button type="button" class="btn btn-success add-item">Adicionar Item</button>
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
                    <button type="button" class="btn btn-success add-service">Adicionar Serviço</button>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Responsive Hover Table</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="content-itens">
                    <thead>
                        <th>item</th>
                        <th>quantidade</th>
                        <th>preço</th>
                        <th>total</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Responsive Hover Table</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="content-services">
                    <thead>
                        <th>Serviço</th>
                        <th>quantidade</th>
                        <th>preço</th>
                        <th>total</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Criar</button>
    </div>
</form>

<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}"> 
@stop {{--

<div class="row">
    <div class="col-md-12">
        <table>
            <thead>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
            </thead>
            <tbody>
                <div id="content-itens"></div>
            </tbody>

        </table>
    </div>
</div>

--}}