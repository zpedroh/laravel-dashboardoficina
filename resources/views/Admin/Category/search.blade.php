@extends('adminlte::page') 
@section('title', 'Categorias') 
@section('content_header')
<h1>Categorias</h1>

@stop 
@section('content')



  <div class="box">
    <div class="box-header">
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
          Adicionar Categoria
        </button>
    </div>
    <div class="box-body">
      <div class="table-responsive">
          <table id="category_table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
      
              @foreach($category as $category)
      
              <tr>
                <td>{{$category['id']}}</td>
                <td>{{$category['name']}}</td>
      
                <td>
                  <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$category->id}}" data-info="{{$category->id}}, {{$category->name}}"><span class="fa fa-edit"></span></a>
                  {{--<button class="btn-xs btn-primary" type="button" data-toggle="modal" data-target="#modal-edit{{$category->id}}" data-info="{{$category->id}}, {{$category->name}}">Editar</button>--}}

                  <a class="btn-xs btn-danger delete-confirm" href="{{ route('categories.destroy', $category['id']) }}" type="button"><span class="fa fa-trash"></span></a>

                  {{--<button class="btn btn-danger delete-confirm" value="{{ route('categories.destroy', $category['id']) }}" type="button">Deletar</button>--}}
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
                        <input type="text" name="name" placeholder="Nome da Categoria" class="form-control" value="{{$category->name}}" required>
                        </div>
      
                        <div class="modal-footer">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
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
            <input type="text" name="name" placeholder="Nome da Categoria" class="form-control" required>
          </div>

          <div class="modal-footer">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
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

<script type="text/javascript" language="javascript">
  jQuery(document).ready(function () {
        $("#category_table").dataTable(
          {
            language:{
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    }
          }
        );
  });
</script>

@stop