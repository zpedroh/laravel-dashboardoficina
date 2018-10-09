@extends('adminlte::page')

@section('title', 'Serviço')

@section('content_header')
    <h1>Serviço</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('services.create') }}">    

            {!! csrf_field() !!}                 

            <div class="form-group">
                <input type="text" name="name" placeholder="Nome" class="form-control" required>
            </div>
  
            <div class="form-group">
                <input type="text" name="price" placeholder="Preço" class="form-control" required>
            </div>     

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
    

<!--
<span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>

col-md-6
--> 

@stop