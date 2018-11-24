@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Notas</h1>

@stop 
@section('content') {{--

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Nota
  </button>--}}
<div class="table-responsive">
  <div class="col-lg-6">
    <table id="record_table" class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Data</th>
          <th>Status</th>
          <th>Total</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>

        {{-- @if(Auth::user()->autorith == 1) Menu @endif --}} 
        
        @foreach($clientrecord as $clientrecord)

        <tr>
          <td>{{$clientrecord->id}}</td>
          <td>{{$clientrecord->getClient->name}}</td>
          <td>{{$clientrecord->created_at->format('d-m-y')}}</td>
          <td>
            @if($clientrecord->status == 1)
              <span class="label label-warning">Aberta</span>
            @elseif($clientrecord->status == 2)
              <span class="label label-primary">Pendente</span>
            @elseif($clientrecord->status == 3)
              <span class="label label-success">Paga</span>
            @else
              <span class="label label-danger">Cancelada</span>
            @endif          
          </td>
          <td>{{$clientrecord->record_total}}</td>

          <td>
            <a class="btn-warning btn-xs" data-toggle="modal" data-target="#record-content{{$clientrecord['id']}}">
              <span class="glyphicon glyphicon-folder-open"></span>
            </a>
          </td>
          <td>
            <a href="{{ route('records.edit', $clientrecord['id'])}}">
              <button class="btn btn-edit" type="submit">Editar</button>
            </a>
          </td>
          <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('records.destroy', $clientrecord['id']) }}" type="button">Deletar</button>
          </td>
          <td><a href="{{route('record.print', $clientrecord->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a></td>
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
                    {{$clientrecorditem->getItem->name}}
                    {{$clientrecorditem->quantity}}
                    {{$clientrecorditem->item_total}}

                </li>
                @endforeach 
                @foreach($clientrecord->getServices as $clientrecordservice)
                <li>
                    {{$clientrecordservice->getservice->name}}
                    {{$clientrecordservice->quantity}}
                    {{$clientrecordservice->service_total}}
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

<script type="text/javascript" language="javascript">
  jQuery(document).ready(function () {
        $("#record_table").dataTable();
  });

</script>





@stop