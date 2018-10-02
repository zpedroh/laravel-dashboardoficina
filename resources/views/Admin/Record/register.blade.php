@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Cadastrar Notas</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('records.create') }}">    

            {!! csrf_field() !!}                 

            <div class="form-group">
                <select class="form-control" name="client_id" required>
                <option value="">Selecione um Cliente</option>
                @foreach($client as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach                   
                </select>
            </div>                 

            <div class="form-group">
                <button type="submit" class="btn btn-success">Criar</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

@stop