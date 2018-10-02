@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Cadastrar Conteudo Notas</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('recorditems.create') }}">    

            {!! csrf_field() !!}   
            
            <input type="hidden" name="clientrecord_id" value="{{$clientrecord->id}}">

            <div class="form-group">
                <select class="form-control" name="item_id" required>
                <option value="">Selecione um Produto</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach                   
                </select>
            </div>
            <div class="form-group">
                <label for="name">Quantidade Item:</label>
                <input type="text" class="form-control" name="quantity_item" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Adicionar Item</button>
            </div>
        </form>

        <form method="POST" action="{{ route('recordservices.create') }}">
            {!! csrf_field() !!}   

            <input type="hidden" name="clientrecord_id" value="{{$clientrecord->id}}">

            <div class="form-group">
                <select class="form-control" name="service_id" required>
                <option value="">Selecione um Serviço</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach                   
                </select>
            </div>
            
            <div class="form-group">
                <label for="name">Quantidade Serviço:</label>
                <input type="text" class="form-control" name="quantity_service">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Adicionar Serviço</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

@stop