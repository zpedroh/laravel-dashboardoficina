@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Cadastrar Notas</h1>
@stop

@section('content')

    <div class="box-body">
        <form method="POST" action="{{ route('records.create') }}">    

            {!! csrf_field() !!}                 
            <div class="row" >
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  
                        <div class="col-md-4 form-group">
                                <select class="form-control" name="client_id" required>
                                @foreach($client as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach                   
                                </select>
                            </div>                 
                
                            <div class="col-md-2 form-group">
                                <button type="submit" class="btn btn-success">Criar</button>
                            </div>

                </div>
                 <div class="col-md-3"></div>
            </div>
          
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

@stop