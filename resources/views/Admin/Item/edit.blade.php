@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Item</h1>
@stop

@section('content')

<div class="container">
    <h2>Edit A Form</h2><br/>
    <form method="get" action="{{route('items.update', $item->id)}}">
        @csrf
        {{--<input name="_method" type="hidden" value="PATCH">--}}
        <div class="row">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{$item->name}}">
            </div>
        </div>   
        <div class="row">
            <div class="form-group">
                <select class="form-control" name="category" required>
                    <option value="">Selecione uma Categoria</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach                   
                </select>
            </div>     
        </div>
        <div class="row">
            <div class="form-group">
                <select class="form-control" name="brand" required>
                    <option value="">Selecione uma Marca</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach                   
                </select>
            </div>     
        </div>
        <div class="row">
            <div class="form-group">
                <label for="name">Quantidade:</label>
                <input type="text" class="form-control" name="quantity" value="{{$item->getItemStock->quantity}}">
            </div>
        </div>  
        <div class="row">
            <div class="form-group">
                <label for="name">Preço:</label>
                <input type="text" class="form-control" name="price" value="{{$item->price}}">
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
            </div>
        </div>
    </form>
</div> 

@stop


