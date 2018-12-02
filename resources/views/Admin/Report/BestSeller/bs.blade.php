@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Produtos Vendidos Periodo</h1>
@stop 
@section('content')

<div class="box">
    <div class="box-header">
        <form method="POST"  action="{{ route('bseller.result') }}" >
            @csrf

                <div class="input-group input-group-sm">
                        

                            <div class="col-sm-4">
                                <label for="date-start"> Data inicio:</label>
                                <input type="date" id="start" name="date_start" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="date-end"> Data fim:</label>
                                <input type="date" id="end" name="date_end" class="form-control">
                            </div>
                            <div class="col-xs-4" style="margin-top: 4%;">
                                <button type="submit" class="btn btn-info btn-flat"><span class="fa fa-search"></span></button>
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
    });

</script>





@stop