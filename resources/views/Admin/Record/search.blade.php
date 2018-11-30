@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')

<h1>Pedidos</h1>

@stop 
@section('content')

<div class="box">
  <div class="box-header">

  </div>
  <div class="box-body">
      <div class="table-responsive">
          <table id="record_table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Status</th>
                <th>Total</th>
                <th></th>
  
              </tr>
            </thead>
            <tbody>
      
              @foreach($clientrecord as $clientrecord)
      
              <tr>
                <td>{{$clientrecord->id}}</td>
                <td>{{$clientrecord->getClient->name}}</td>
                <td>{{$clientrecord->created_at->format('d-m-Y')}}</td>
                <td>
                  @if($clientrecord->status == 1)
                  <span class="label label-warning">Aberta</span> @elseif($clientrecord->status == 2)
                  <span class="label label-primary">Pendente</span> @elseif($clientrecord->status == 3)
                  <span class="label label-success">Paga</span> @else
                  <span class="label label-danger">Cancelada</span> @endif
                </td>
                <td>R$ {{$clientrecord->record_total}}</td>
      
                <td>
                  <a class="btn-primary btn-xs" data-toggle="modal" data-target="#record-content{{$clientrecord['id']}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                  <a class="btn-xs btn-warning" type="submit" href="{{ route('records.edit', $clientrecord['id'])}}"><span class="fa fa-edit"></span></a>
                  <a class="btn-xs btn-danger delete-confirm" value="{{ route('records.destroy', $clientrecord['id']) }}" type="button"><span class="fa fa-trash"></span></a>
                  <a href="{{route('record.print', $clientrecord->id)}}" target="_blank" class="btn-xs btn-default"><i class="fa fa-file-pdf-o"></i></a>
                </td>
              </tr>
    
              {{--Modal Edit--}}
      
              <div class="modal fade" id="record-content{{$clientrecord['id']}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Editar Item</h4>
                    </div>
                    <div class="modal-body">    
                      @foreach($clientrecord->getItems as $clientrecorditem)
                      <li>
                        {{$clientrecorditem->getItem->name}} {{$clientrecorditem->quantity}} {{$clientrecorditem->item_total}}
      
                      </li>
                      @endforeach @foreach($clientrecord->getServices as $clientrecordservice)
                      <li>
                        {{$clientrecordservice->getservice->name}} {{$clientrecordservice->quantity}} {{$clientrecordservice->service_total}}
                      </li>      
                      @endforeach
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


<script type="text/javascript" language="javascript">
  jQuery(document).ready(function () {
        $("#record_table").dataTable(
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