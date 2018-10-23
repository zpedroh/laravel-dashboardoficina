@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Cadastrar Forma de Pagamento</h1>
@stop

@section('content')

    <div class="box-body">

        <form method="POST" action="{{ route('paymentmethods.create') }}"> 

            {!! csrf_field() !!}            

            <div class="form-group">
                <label for="name">Tipo:</label>
                <input type="text" name="type" placeholder="Tipo" class="form-control">
            </div>   

            <div class="form-group">
                <label for="name">Parcelas:</label>
                <input type="text" name="parcel" placeholder="Parcelas" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Periodo:</label>
                <input type="text" name="period" placeholder="Periodo" class="form-control">
            </div> 

            <div class="form-group">
                <label for="name">Vencimento:</label>
                <input type="text" name="duedate" placeholder="Vencimento" class="form-control">
            </div>               

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>

@stop