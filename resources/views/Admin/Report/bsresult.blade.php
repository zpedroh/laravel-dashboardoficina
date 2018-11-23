@extends('adminlte::page') 
@section('title', 'BS') 
@section('content_header')
<h1>Mais Vendidos</h1>





@stop 
@section('content')

<div class="box">
    <div class="box-header">
    <form method="POST"  action="{{ route('bs.result') }}" >
            <div class="col-sm-4">
                <label for="date-start"> Data inicio:</label>
                <input type="date" id="start" name="date_start" class="form-control">
            </div>
            <div class="col-sm-4">
                <label for="date-end"> Data fim:</label>
                <input type="date" id="end" name="date_end" class="form-control">
            </div>
            <div class="col-xs-4">
                <button type="button" class="btn btn-block btn-info">Filtrar</button>
            </div>
        </div>
    </div>

    <div class="box-body">

        <div class="table-responsive">
            <table class="table-stripped" id="report_table">

                <thead>
                    <th>Produto</th>
                    <th>Marca</th>
                    <th>Quantidade vendida</th>
                </thead>
                <tbody>
                    @foreach($moviments as $moviment)
                    <tr>
                        <td>{{$moviment->getItem->name}}</td>
                        <td>{{$moviment->getItem->getBrand->name}}</td>
                        <td>1</td>
                    </tr>
 
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>




<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#report_table").dataTable();
    });

</script>





@stop