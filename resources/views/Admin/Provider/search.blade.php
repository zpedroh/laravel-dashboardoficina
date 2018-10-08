@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Notas</h1>


@stop

@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Nota
  </button>

  <table class="table table-bordered table-dark">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
    
    {{--
    @if(Auth::user()->type_id == 1)
      Menu
    @endif
    --}}
    
      @foreach($provider as $provider)
      
      <tr>
        <td>{{$provider->id}}</td>
        <td>{{$provider->name}}</td>
        <td>{{$provider->created_at}}</td>

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
                    @foreach($provideritem as $provideritem)      
                    <tr>
                      <td>{{$provideritem->id}}</td>
                      <td>{{$provideritem->getItem->name}}</td>
                      <td>{{$provideritem->price}}</td>

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
@stop
