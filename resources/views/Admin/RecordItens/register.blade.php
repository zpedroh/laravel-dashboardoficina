@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Adicionar itens na Nota</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('recorditems.create') }}">    

            {!! csrf_field() !!}   
            <div class="row">
                <div class="col-md-6">                    
                    <label>Produto</label>
                    <input type="hidden" name="clientrecord_id" value="{{$clientrecord->id}}">
                    <div class="form-group">
                            <select class="form-control" name="item_id" required>
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
                            <input type="text" class="form-control" name="quantity_item" required>
                        </div>            
                            
                </div>
                
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 25px;">
                            <button type="submit" class="btn btn-success">Adicionar Item</button>
                    </div>
                </div>

            </div>  

        </form>

        <form method="POST" action="{{ route('recordservices.create') }}">
            {!! csrf_field() !!}   

            <div class="row">
                <div class="col-md-6">      
                        <label>Serviço</label>
                    <input type="hidden" name="clientrecord_id" value="{{$clientrecord->id}}">

                    <div class="form-group">
                        <select class="form-control" name="service_id" required>
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
                            <input type="text" class="form-control" name="quantity_service">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top: 25px;">
                            <button type="submit" class="btn btn-success">Adicionar Serviço</button>
                        </div>
                    </div>
            </div>
          
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

@stop