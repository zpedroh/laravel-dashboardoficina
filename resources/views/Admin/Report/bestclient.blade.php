@extends('adminlte::page')

@section('title', 'BS')

@section('content_header')
    <h1>Mais Vendidos</h1>
@stop

@section('content')

<div class="form-control">

    Data inicio: <input type="date" name="date-start"> 

    Data fim:    <input type="date" name="date-end">
</div>

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Maiores Clientes</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length">
              <label>Mostrar 
                    <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> Registros
            </label>
        </div>
    </div>
    <div class="col-sm-6">
        <div id="example1_filter" class="dataTables_filter">
            <label>Search:
                <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
            </label>
        </div>
    </div>
</div>
<div class="row"><div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">Cliente</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Notas</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">Valor Medio</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Valor Total</th>
            </tr>
        </thead>
        <tbody>        
  
        </tr><tr role="row" class="even">
          <td class="sorting_1">Cliente X</td>
          <td>15</td>
          <td>$69,73</td>
          <td>$1290,00</td>
        </tr><tr role="row" class="odd">
            <td class="sorting_1">Cliente X</td>
            <td>15</td>
            <td>$69,73</td>
            <td>$1290,00</td>
        </tr><tr role="row" class="even">
            <td class="sorting_1">Cliente X</td>
            <td>15</td>
            <td>$69,73</td>
            <td>$1290,00</td>

        </tr></tbody>
      </table>
    </div>

    </div>
    <!-- /.box-body -->
  </div>

@stop
