@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Cadastrar Item</h1>
@stop

@section('content')

    <div class="box-body">


        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
        </button>

{{--
        <form method="POST" action="{{ route('items.create') }}">    

            {!! csrf_field() !!}

            <div class="form-group">
                <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>
            </div>

            <div class="form-group">
                <select class="form-control" name="category" required>
                <option value="">Selecione uma Categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach                   
                </select>
            </div>

            <!--
                <span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>

                col-md-6
            -->            

            <div class="form-group">
                <select class="form-control" name="brand" required>
                <option value="">Selecione uma Marca</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach                   
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="text" name="price" placeholder="Preço" class="form-control" required>
            </div>            

            <div class="form-group">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
--}}

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
        Launch Default Modal
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

                    <form method="POST" action="{{ route('items.create') }}"> 
                            {!! csrf_field() !!}
                
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>
                            </div>
                
                            <div class="form-group">
                                <select class="form-control" name="category" required>
                                <option value="">Selecione uma Categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach                   
                                </select>
                            </div>
                
                            <!--
                                <span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>
                
                                col-md-6
                            -->            
                
                            <div class="form-group">
                                <select class="form-control" name="brand" required>
                                <option value="">Selecione uma Marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach                   
                                </select>
                            </div>
                
                            <div class="form-group">
                                <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
                            </div>
                
                            <div class="form-group">
                                <input type="text" name="price" placeholder="Preço" class="form-control" required>
                            </div>            
                
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop