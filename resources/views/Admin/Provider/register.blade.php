@extends('adminlte::page')

@section('title', 'Fornecedor')

@section('content_header')
    <h1>Cadastrar Fornecedor</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('providers.create') }}">      

            {!! csrf_field() !!} 
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nome" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="cnpj" placeholder="CNPJ" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="country" placeholder="País" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="state" placeholder="Estado" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="zipcode" placeholder="CEP" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="city" placeholder="Cidade" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="district" placeholder="Bairro" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="street" placeholder="Rua" class="form-control">
            </div> 
            <div class="form-group">
                <input type="text" name="number" placeholder="Nº" class="form-control">
            </div>            
                

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>

@stop