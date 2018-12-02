@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Pedidos por Periodo</h1>
@stop 
@section('content')

<div class="box">
    <div class="box-header">
        <form method="POST"  action="{{ route('precord.result') }}" >
            @csrf
            <div class="input-group input-group-sm">
            
                <span class="input-group-btn">
                    <label for="date-start"> Data inicio:</label>
                    <div class="col-sm-4">                            
                        <input type="date" id="date_start" name="date_start" class="form-control" required>
                    </div>
                    <label for="date-end"> Data fim:</label>
                    <div class="col-sm-4">                            
                        <input type="date" id="date_end" name="date_end" placeholder="Data Fim" class="form-control" required>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-info btn-flat"><span class="fa fa-search"></span></button>
                    </div>
                </span>                              
            </div>
            <div class="row" style="margin: 0.1%;">

                <div class="col-md-5">
                    <label for="status">Clientes:</label>
                    <select id="status" class="form-control js-example-basic-multiple1" name="clients[]" multiple="multiple">
                        @foreach($client as $client)
                            <option value="{{ $client->id }}">{{ $client->id }} | {{ $client->name }}</option>                         
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="status">Status:</label>
                    <select id="status" class="form-control js-example-basic-multiple2" name="status[]" multiple="multiple">
                        <option value="1">Aberto</option>                            
                        <option value="2">Pendente</option>
                        <option value="3">Pago</option>
                        <option value="4">Cancelado</option>
                    </select>
                </div>
            </div>
            </form>
        </div>
    </div>



    <div class="box-body">

    </div>
</div>


<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#report_table").dataTable();
          $('.js-example-basic-multiple1').select2();
          $('.js-example-basic-multiple2').select2();
    });

</script>





@stop