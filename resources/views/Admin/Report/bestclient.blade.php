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
<div class="row">
    <div class="col-sm-12">
            <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">Salary ($)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($data as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->country}}</td>
                                <td>{{$item->salary}}</td>
                                <td><button class="edit-modal btn btn-info"
                                        data-info="{{$item->id}},{{$item->first_name}},{{$item->last_name}},{{$item->email}},{{$item->gender}},{{$item->country}},{{$item->salary}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    <button class="delete-modal btn btn-danger"
                                        data-info="{{$item->id}},{{$item->first_name}},{{$item->last_name}},{{$item->email}},{{$item->gender}},{{$item->country}},{{$item->salary}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button></td>
                            </tr>
                            @endforeach
                            </tbody>
                </table> 
    </div>

</div>
<!-- /.box-body -->
</div>

@stop

<script>
        $(document).ready(function() {
          $('#table').DataTable();
      } );
       </script>