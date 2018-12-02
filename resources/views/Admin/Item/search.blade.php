@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Produtos</h1>

@stop 
@section('content')
<div class="box">
    <div class="box-header">

        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
        Adicionar Produto
        </button>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="item-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Localização</th>
                        <th>Estoque</th>
                        <th>Minimo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @if(Auth::user()->type_id == 1) Menu @endif --}} @foreach($item as $item)

                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>R$ {{$item->price}}</td>
                        <td>{{$item->getCategory->name}}</td>
                        <td>{{$item->getBrand->name}}</td>
                        <td>{{$item->model}}</td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->getItemStock->quantity}}</td>
                        <td>{{$item->getItemStock->quantity_min}}</td>

                        <td>
                            <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$item->id}}" data-info="{{$item->id}}, {{$item->name}}, {{$item->getBrand->id}}, {{$item->getCategory->id}}, {{$item->getItemStock->id}}, {{$item->getItemStock->quantity}}"><span class="fa fa-edit"></span></a>

                            <a class="btn-xs btn-danger delete-confirm" href="{{ route('items.destroy', $item['id']) }}" id="delete-Button" type="button"> <span class="fa fa-trash"></span></a>
                            {{--
                            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$item->id}}" data-info="{{$item->id}}, {{$item->name}}, {{$item->getBrand->id}}, {{$item->getCategory->id}}, {{$item->getItemStock->id}}, {{$item->getItemStock->quantity}}">Editar</button>
                            <button class="btn btn-danger delete-confirm" value="{{ route('items.destroy', $item['id']) }}" type="button">Delete</button>
                            --}}
                        </td>
                    </tr>


                {{--Modal Edit--}}

                <div class="modal fade" id="modal-edit{{$item->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Editar Item</h4>
                                </div>
                    
                                <div class="modal-body">
                                    <form method="get" action="{{route('items.update', $item->id)}}">
                                        @csrf
                    
                                        <input type="hidden" value="{{$item->id}}">
                    
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name" value="{{$item->name}}" required>
                                        <label for="category">Categoria:</label>
                                        <select class="form-control" name="category" value="{{$item->getCategory->id}}" required>
                                                                <option value="">Selecione uma Categoria</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach                   
                                                            </select>
                                        <label for="brand">Marca:</label>
                                        <select class="form-control" name="brand" value="{{$item->getBrand->id}}" required>
                                                                <option value="">Selecione uma Marca</option>
                                                                @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                                @endforeach                   
                                                            </select>

                                        <label for="Modelo">Modelo:</label>
                                        <input type="text" class="form-control" name="model" placeholder="Modelo" value="{{$item->model}}" required>
                                        
                                        <label for="location">Localização:</label>
                                        <input type="text" class="form-control" name="location" placeholder="Localização" value="{{$item->location}}" required>
                    
                                        <label for="quantity">Quantidade:</label>
                                        <input type="text" class="form-control" name="quantity" value="{{$item->getItemStock->quantity}}" required>
                    
                                        <label for="quantity">Quantidade Minima:</label>
                                        <input type="text" class="form-control" name="quantity_min" value="{{$item->getItemStock->quantity_min}}" required>
                    
                                        <label for="price">Preço:</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{$item->price}}" required>
                    
                                        <div class="modal-footer">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </form>
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

{{--Modais--}}

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Produto</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('items.create') }}">
                    @csrf

                    <label for="name">Name:</label>
                    <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>
                    <label for="category">Categoria:</label>
                    <select class="form-control" name="category" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach                   
                        </select>
                    <label for="brand">Marca:</label>
                    <select class="form-control" name="brand" required>
                            <option value="">Selecione uma Marca</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach                   
                        </select>

                    <label for="Modelo">Modelo:</label>
                    <input type="text" class="form-control" name="model" placeholder="Modelo" required>

                    <label for="location">Localização:</label>
                    <input type="text" name="location" placeholder="Localização" class="form-control" required>

                    <label for="quantity">Quantidade:</label>
                    <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>

                    <label for="quantity">Quantidade Minima:</label>
                    <input type="text" name="quantity_min" placeholder="Quantidade Minima" class="form-control" required>

                    <label for="price">Preço:</label>
                    <input type="text" id="price_create" name="price" placeholder="Preço" class="form-control" required>

                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{{ asset('js/mask/jquery.maskMoney.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#item-table").dataTable({
            language:{
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    }
          });
    });
 </script>

<script type="text/javascript">
    $('#price').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});
    $('#price_create').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});
</script>
 
@stop