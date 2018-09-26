@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')

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
          <form action="{{ route('brands.edit', $brand['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('brands.destroy', $brand['id'])}}" method="get">
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


