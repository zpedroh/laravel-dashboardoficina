@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')

   <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>CPF</th>
        <th>País</th>
        <th>Estado</th>
        <th>CEP</th>
        <th>Cidade</th>
        <th>Bairro</th>
        <th>Rua</th>
        <th>Nº</th>             
      </tr>
    </thead>
    <tbody>
      
      @foreach($client as $client)
      
      <tr>
        <td>{{$client['id']}}</td>
        <td>{{$client['name']}}</td> 
        <td>{{$client['cpf']}}</td> 
        <td>{{$client['country']}}</td> 
        <td>{{$client['state']}}</td> 
        <td>{{$client['zipcode']}}</td> 
        <td>{{$client['city']}}</td> 
        <td>{{$client['district']}}</td> 
        <td>{{$client['street']}}</td> 
        <td>{{$client['number']}}</td>        

        <td>
          <form action="{{ route('clients.edit', $client['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('clients.destroy', $client['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@stop


