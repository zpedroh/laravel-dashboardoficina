@extends('adminlte::page') 
@section('title', 'Serviços') 
@section('content_header')
<h1>Serviços</h1>
@stop 
@section('content')

<div class="col-md-8">
  <div class="box">
    <div class="box-header">
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
            Adicionar Serviço
          </button>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="service_table" class="table table-striped table-responsive">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Preço</th>
              <th></th>             
            </tr>
          </thead>
          <tbody>

            @foreach($service as $service)

            <tr>
              <td>{{$service->id}}</td>
              <td>{{$service->name}}</td>
              <td>R$ {{$service->price}}</td>
              <td>

                <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$service->id}}" data-info="{{$service->id}}, {{$service->name}}"><span class="fa fa-edit"></span></a>
                <a class="btn-xs btn-danger delete-confirm" href="{{ route('services.destroy', $service->id) }}" type="button"><span class="fa fa-trash"></span></a>
                {{--
                <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$service->id}}" data-info="{{$service->id}}, {{$service->name}}">Editar</button>
                <button class="btn btn-danger delete-confirm" value="{{ route('services.destroy', $service->id) }}" type="button">Deletar</button>
                --}}
              </td>
            </tr>

            {{--modal edit --}}

            <div class="modal fade" id="modal-edit{{$service->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Serviço</h4>
                  </div>

                  <div class="modal-body">
                    <form method="get" action="{{route('services.update',$service->id)}}">
                      @csrf {{--
                      <input name="_method" type="hidden" value="PATCH">--}}
                      <div class="row">
                        <div class="col-md-6">

                          <div class="form-group">
                            <label for="name">Descrição:</label>
                            <input type="text" name="name" placeholder="Descrição" value="{{$service->name}}" class="form-control" required>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="price">Preço:</label>
                            <input type="text" name="price" id="price" placeholder="Preço" value="{{$service->price}}" class="form-control" required>
                          </div>
                        </div>

                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
</div>

{{--Modais--}}

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Adicionar Serviço</h4>
      </div>

      <div class="modal-body">

        <form method="POST" action="{{ route('services.create') }}">

          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Descrição:</label>
                <input type="text" name="name" placeholder="Descrição" class="form-control" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="price">Preço:</label> 
                <input type="text" id="price_create" name="price" placeholder="Preço" class="form-control" required>
              </div>
            </div>

          </div>
          <div class="modal-footer">

            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>

          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{{ asset('js/mask/jquery.maskMoney.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
  jQuery(document).ready(function () {
        $("#service_table").dataTable({
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
          });
  });

</script>

<script type="text/javascript">
  $('#price').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});
  $('#price_create').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});

</script>

<script>
  $('#edit').on('show.bs.modal', function(event)
{
  alert('teste');
  var valor = button.data('.modal-body #price').tostring();
  var price_edit = valor.replace('.', ',');

  modal.find('.modal-body #price').val('R$ ' + price_edit);
});

</script>



@stop {{--

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Bordered Table</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th style="width: 10px">#</th>
          <th>Task</th>
          <th>Progress</th>
          <th style="width: 40px">Label</th>
        </tr>
        <tr>
          <td>1.</td>
          <td>Update software</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
            </div>
          </td>
          <td><span class="badge bg-red">55%</span></td>
        </tr>
        <tr>
          <td>2.</td>
          <td>Clean database</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
            </div>
          </td>
          <td><span class="badge bg-yellow">70%</span></td>
        </tr>
        <tr>
          <td>3.</td>
          <td>Cron job running</td>
          <td>
            <div class="progress progress-xs progress-striped active">
              <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
            </div>
          </td>
          <td><span class="badge bg-light-blue">30%</span></td>
        </tr>
        <tr>
          <td>4.</td>
          <td>Fix and squish bugs</td>
          <td>
            <div class="progress progress-xs progress-striped active">
              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
            </div>
          </td>
          <td><span class="badge bg-green">90%</span></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <li><a href="#">«</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">»</a></li>
    </ul>
  </div>
</div>

--}}