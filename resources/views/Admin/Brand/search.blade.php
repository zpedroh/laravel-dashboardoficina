@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
  Adicionar Marca
</button>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Default Modal</h4>
          </div>

          <div class="modal-body">

            <form method="POST" action="{{ route('brands.create') }}">      

                {!! csrf_field() !!} 
    
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nome da Marca" class="form-control">
                </div>                 
    
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
            </div>
      </div>
      <!-- /.modal-content -->
  </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



   <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>        
      </tr>
    </thead>
    <tbody>
      
      @foreach($brand as $brand)
      
      <tr>
        <td>{{$brand['id']}}</td>
        <td>{{$brand['name']}}</td> 


        <td>
          <form action="{{ route('brands.edit', $brand['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('brands.destroy', $brand['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@stop


