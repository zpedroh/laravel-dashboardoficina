@extends('adminlte::page')

@section('title', 'Fornecedor')

@section('content_header')
    <h1>Editar Fornecedor</h1>
@stop

@section('content')

<div class="container">
    <h2>Edit A Form</h2><br/>
    <form method="get" action="{{route('clients.update', $id)}}">
        @csrf
        {{--<input name="_method" type="hidden" value="PATCH">--}}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{$client->name}}">
            </div>
        </div>  
              
        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
            </div>
        </div>
    </form>
</div> 

@stop


