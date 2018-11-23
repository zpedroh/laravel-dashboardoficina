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
            <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" id="telephone" name="telephone" placeholder="Telefone" class="form-control">
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

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#provider_table").dataTable();
    });
</script>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $("#cnpj").mask("999.999.999-99");
        $(".cnpj").mask("999.999.999-99");
        $("#telephone").mask("(99) 9999999-99");
        $(".telephone").mask("(99)9999999-99");
    });
</script>

@stop