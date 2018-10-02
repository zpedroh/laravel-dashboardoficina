@extends('adminlte::page')

@section('title', 'Caegoria')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
  Adicionar Categoria
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

            <form method="POST" action="{{ route('categories.create') }}"> 

              {!! csrf_field() !!}            
  
              <div class="form-group">
                  <input type="text" name="name" placeholder="Nome da Categoria" class="form-control">
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
      
      @foreach($category as $category)
      
      <tr>
        <td>{{$category['id']}}</td>
        <td>{{$category['name']}}</td> 


        <td>
          <form action="{{ route('categories.edit', $category['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('categories.destroy', $category['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" onclick="Hello" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@stop


