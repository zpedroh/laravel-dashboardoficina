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
            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$category->id}}" data-info="{{$category->id}}, {{$category->name}}">Editar</button>
          </td>
          <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('categories.destroy', $category['id']) }}" type="button">Deletar</button>
          </td>
        </tr>

        {{--Modal Edit--}}

        <div class="modal fade" id="modal-edit{{$category->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Categoria</h4>
              </div>

              <div class="modal-body">
                <form method="get" action="{{route('categories.update', $category->id)}}">
                  @csrf

                  <input type="hidden" value="{{$category->id}}">

                  <div class="form-group">
                    <label for="name">Nome:</label>
                  <input type="text" name="name" placeholder="Nome da Categoria" class="form-control" value="{{$category->name}}">
                  </div>

                  <div class="modal-footer">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Salvar</button>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
            <label for="name">Nome:</label>
            <input type="text" name="name" placeholder="Nome da Categoria" class="form-control">
          </div>

          <div class="modal-footer">
            <div class="form-group">
              <button type="submit" class="btn btn-success">Cadastrar</button>
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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