@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Itens por Fornecedor</h1>

   {{--select2--}}
   <link rel="stylesheet" type="text/css" href="{{ asset('css/select2/select2.min.css')}}"/>
@stop 
@section('content')

<div class="box">
    <div class="box-header">

        <form method="POST" action="{{ route('bseller.result') }}">
            @csrf
            <div class="input-group input-group-sm">
                <span class="input-group-btn">

                <label for="provider">Fornedores:</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" name="report_select" id="report_select">
                        <option value="">Selecione os Fornecedores</option>
                        @foreach($provider as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach                   
                    </select>
                </div>
                    <button type="submit" class="btn btn-info btn-flat">Go!</button>
                </span>
            </div>
        </form>
    </div>
    <div class="box-body">

    </div>
</div>

{{--select2--}}
<script type="text/javascript" src="{{ asset('js/select2/select2.min.js')}}"></script>


<script>
    $(document).ready(function() {
        $('.report_select').select2({
            language: "pt-BR"
        });
    });
</script>


<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#report_table").dataTable();
    });

</script>





@stop