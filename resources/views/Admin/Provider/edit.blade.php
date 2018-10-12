@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Fornecedor</h1>
@stop

@section('content')
<form>

        {!! csrf_field() !!} 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Nome" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" placeholder="CPF" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="zipcode">CEP:</label>
                    <input type="text" name="zipcode" placeholder="CEP" class="form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="street">Rua:</label>
                    <input type="text" name="street" placeholder="Rua" class="form-control">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="number">Nº:</label>
                    <input type="text" name="number" placeholder="Nº" class="form-control">
                </div>
            </div>  
            <div class="col-md-3">
                <div class="form-group">
                    <label for="country">Complemento:</label>
                    <input type="text" name="country" placeholder="" class="form-control">
                </div>
            </div>                    
        </div>
     
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="district">Bairro:</label>
                    <input type="text" name="district" placeholder="Bairro" class="form-control">
                </div>

            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="city">Cidade:</label>
                    <input type="text" name="city" placeholder="Cidade" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="state">Estado:</label>
                    <input type="text" name="state" placeholder="Estado" class="form-control">
                </div>
            </div>
        </div>


    <div class="table-responsive">
        <div class="col-lg-6">
    <table class="table table-striped">
        <thead>
            <h3> Itens do Fornecedor </h1>
            <tr>
            <th></th>    
            <th>ID</th>
            <th>Nome</th>       
            <th>Categoria</th>
            <th>Marca</th>
            <th>Estoque</th>
            <th>Preço Forn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($item as $item)  
            <tr>
                <td><input type="checkbox" name="sell"></td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->getCategory->name}}</td> 
                <td>{{$item->getBrand->name}}</td> 
                <td>{{$item->getItemStock->quantity}}</td> 
                <td><input type="text" name="provider_price"></td>       
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>

@stop


