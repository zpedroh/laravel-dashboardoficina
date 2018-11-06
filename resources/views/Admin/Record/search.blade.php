@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Notas</h1>
@stop

@section('content')

{{--<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Nota
  </button>--}}
  <div class="table-responsive">
  <div class="col-lg-6">
  <table id="record_table" class="table table-bordered table-dark">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ciente</th>
        <th>Data</th>
        <th>Total</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
    {{--
    @if(Auth::user()->autorith == 1)
      Menu
    @endif
    --}}
    
      @foreach($clientrecord as $clientrecord)
      
      <tr>
        <td>{{$clientrecord->id}}</td>
        <td>{{$clientrecord->getClient->name}}</td>
        <td>{{$clientrecord->created_at}}</td>
        <td>{{$clientrecord->record_total}}</td>

        <td>
            <a class="btn-warning btn-xs" data-toggle="modal" data-target="#modal-content">
              <span class="glyphicon glyphicon-folder-open"></span>
            </a> 
          </td>
        <td>
          <form action="{{ route('records.edit', $clientrecord['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-edit" type="submit">Editar</button>        
          </form>
        </td>
        <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('records.destroy', $clientrecord['id']) }}" type="button">Deletar</button>
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
                  <h4 class="modal-title">Default Modal</h4>
              </div>
    
              <div class="modal-body">
    
                  <form method="POST" action="{{ route('records.create') }}">    
  
                      {!! csrf_field() !!}                 
          
                      <div class="form-group">
                          <select class="form-control" name="client_id" required>
                          <option value="">Selecione um Cliente</option>
                          @foreach($client as $client)
                              <option value="{{ $client->id }}">{{ $client->name }}</option>
                          @endforeach                   
                          </select>
                      </div>                 
          
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Criar</button>
                      </div>
                  </form>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  <div class="modal fade" id="modal-content">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Conteudo</h4>
        </div>

        <div class="modal-body">

            <table class="table table-bordered table-dark">
                <thead>
                  <tr>
                    <th>Sequencia</th>
                    <th>Item</th>
                    <th>Quantidade</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($clientrecorditem as $clientrecorditem)      
                    <tr>
                      <td>{{$clientrecorditem->id}}</td>
                      <td>{{$clientrecorditem->getItem->name}}</td>
                      <td>{{$clientrecorditem->quantity}}</td>
                      <td>{{$clientrecorditem->item_total}}

                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <table class="table table-bordered table-dark">

                    <tbody>
                        @foreach($clientrecordservice as $clientrecordservice)      
                        <tr>
                          <td>{{$clientrecordservice->id}}</td>
                          <td>{{$clientrecordservice->getService->name}}</td>
                          <td>{{$clientrecordservice->quantity}}</td>
                          <td>{{$clientrecordservice->service_total}}
    
                        </tr>
                        @endforeach
                      </tbody>
                    </table>


        </div>
      </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<script type="text/javascript" language="javascript">
  jQuery(document).ready(function () {
        $("#record_table").dataTable();
  });
</script>
@stop
