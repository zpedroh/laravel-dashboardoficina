@extends('adminlte::page')

@section('title', 'Caegoria')

@section('content_header')
    <h1>Categorias</h1>
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
      
      @foreach($category as $category)
      
      <tr>
        <td>{{$category['id']}}</td>
        <td>{{$category['name']}}</td> 


        <td>
          <form action="{{ route('categories.edit', $category['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('categories.destroy', $category['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" onclick="Hello" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@stop


