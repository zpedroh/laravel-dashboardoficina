@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Pedidos Periodo</h1>
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
                            
                            <input type="date" id="start" name="date_start" class="form-control">
                        </div>
                        <label for="date-end"> Data fim:</label>
                        <div class="col-sm-4">
                            
                            <input type="date" id="end" name="date_end" placeholder="Data Fim" class="form-control">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-info btn-flat">Go!</button>
                        </div>
                </span>
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
    });

</script>





@stop