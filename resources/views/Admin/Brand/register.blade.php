@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
    <h1>Cadastrar Marca</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('brands.create') }}">      

            {!! csrf_field() !!} 

            <div class="form-group">
                <input type="text" name="name" placeholder="Nome da Marca" class="form-control">
            </div>                 

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>

@stop