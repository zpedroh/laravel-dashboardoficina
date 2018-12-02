@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Serviços Pendentes</h1>
@stop 
@section('content')

<div class="box">
    <div class="box-header">
        <form method="POST"  action="{{ route('pservice.result') }}" >
            @csrf
            <div class="input-group input-group-sm">
            
                <span class="input-group-btn">
                    <label for="date-start">Até Dia:</label>
                    <div class="col-sm-4">                            
                        <input type="date" id="date_start" name="date_start" class="form-control" required>
                    </div>
                    {{--<label for="date-end"> Data fim:</label>
                    <div class="col-sm-4">                            
                        <input type="date" id="date_end" name="date_end" placeholder="Data Fim" class="form-control" required>
                    </div>--}}
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-info btn-flat"><span class="fa fa-search"></span></button>
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
          $('.js-example-basic-multiple1').select2();
          $('.js-example-basic-multiple2').select2();
    });

</script>





@stop