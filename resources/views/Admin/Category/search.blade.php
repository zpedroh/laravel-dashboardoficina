@extends('adminlte::page')

@section('title', 'Caegoria')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Categoria
</button>


<div class="table-responsive">
<div class="col-lg-6">
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
          {{--<form action="{{ route('categories.edit', $category['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">     
--}}
            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit" value="{{ route('categories.edit', $category['id'])}}">Editar</button>        
   
           {{-- <button class="btn btn-edit" type="submit">Editar</button>     
          </form> --}}  
        </td>

        <td>
          <button class="btn btn-danger delete-confirm" value="{{ route('categories.destroy', $category['id']) }}" type="button">Deletar</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

{{--Modais--}}

  <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Adicionar Categoria</h4>
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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar</h4>
                </div>
      
                <div class="modal-body">
                  <form method="get" action="{{route('categories.update', $category->id)}}">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="form-group col-md-4">
                        <label for="name">Nome da Categoria:</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}">
                        </div>
                    </div>        
                    
                    <div class="row">
                        <div class="modal-footer">
                          <div class="form-group">
                          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
                          </div>
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

@stop


