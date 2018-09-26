@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Cadastrar Item</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('items.create') }}">    

            {!! csrf_field() !!}                 

            <div class="form-group">
                <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>
            </div>

            <div class="form-group">
                <select class="form-control" name="category" required>
                <option value="">Selecione uma Categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach                   
                </select>
            </div>

            <!--
                <span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>

                col-md-6
            -->            

            <div class="form-group">
                <select class="form-control" name="brand" required>
                <option value="">Selecione uma Marca</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach                   
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="text" name="price" placeholder="Preço" class="form-control" required>
            </div>            

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

@stop