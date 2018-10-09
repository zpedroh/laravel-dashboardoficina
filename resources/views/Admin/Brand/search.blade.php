@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')
<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Marca
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
      
      @foreach($brand as $brand)
      
      <tr>
        <td>{{$brand['id']}}</td>
        <td>{{$brand['name']}}</td> 
        <td>
                   {{--action="{{ route('brands.edit', $brand['id'])}}" method="get"--}}
            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit" value="{{ route('brands.edit', $brand['id'])}}">Editar</button>        
        </td>
        <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('brands.destroy', $brand['id']) }}" type="button">Deletar</button>
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
                  <h4 class="modal-title">Adicionar Marca</h4>
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
    
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar</h4>
                </div>
      
                <div class="modal-body">
                  <form method="get" action="{{route('brands.update', $brand->id)}}">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="form-group col-md-4">
                        <label for="name">Nome da Marca:</label>
                        <input type="text" class="form-control" name="name" value="{{$brand->name}}">
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


