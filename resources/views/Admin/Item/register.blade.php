@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1> Produtos </h1>
@stop

@section('content')

    <div class="box-body">      

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
        Novo Produto
    </button>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Novo Produto</h4>
                </div>

                <div class="modal-body">

                    <form method="POST" action="{{ route('items.create') }}"> 
                            {!! csrf_field() !!}
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="text" name="name" placeholder="Nome do Produto" class="form-control" required>
                                        </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="category" required>
                                        <option value="">Selecione uma Categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach                   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="brand" required>
                                        <option value="">Selecione uma Marca</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach                   
                                        </select>
                                    </div>
                        
                                </div>
                            </div>
                                         
                            <div class="row" style="text-align:center;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="price" placeholder="Preço" class="form-control" required>
                                    </div>   
                                </div>
                            </div>                
                
                          
                        </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success  pull-right">Cadastrar</button>
                       
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop