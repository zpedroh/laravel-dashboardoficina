@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Notas</h1>
@stop

@section('content')

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Adicionar Nota
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

   <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ciente</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
    
    {{--
    @if(Auth::user()->type_id == 1)
      Menu
    @endif
    --}}
    
      @foreach($clientrecord as $clientrecord)
      
      <tr>
        <td>{{$clientrecord->id}}</td>
        <td>{{$clientrecord->getClient->name}}</td>
        <td>{{$clientrecord->created_at}}</td>

        {{--
        <td>{{$item->price}}</td> 
        <td>{{$item->getCategory->name}}</td> 
        <td>{{$item->getBrand->name}}</td> 
        <td>{{$item->getItemStock->quantity}}</td>        
        --}}

        <td>
          <form action="{{ route('records.edit', $clientrecord['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('records.destroy', $clientrecord['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>

        {{--@foreach($clientrecordservice as $clientrecordservice) 
          <tr>
            <td>{{$clientrecorditem->getItem->name}}</td> 
          </tr>
        @endforeach--}}
      @endforeach
    </tbody>
  </table>
@stop
