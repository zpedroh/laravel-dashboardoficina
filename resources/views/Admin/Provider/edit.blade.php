@extends('adminlte::page') 
@section('title', 'Fornecedor') 
@section('content_header') 
@stop 
@section('content')

<div class="container-responsive">



    
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Fornecedor</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Itens do Fornecedor</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form method="get" action="{{route('providers.update', $provider->id)}}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Nome" value="{{$provider->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="cnpj" name="cnpj" placeholder="cnpj" value="{{$provider->cnpj}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="telephone" name="telephone" placeholder="Telefone" value="{{$provider->telephone}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="zipcode" placeholder="CEP" value="{{$provider->getAdress->zipcode}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="street" placeholder="Rua" value="{{$provider->getAdress->street}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="number" placeholder="Número" value="{{$provider->getAdress->number}}" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="complement" placeholder="Complemento" value="{{$provider->getAdress->complement}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" name="district" placeholder="Bairro" value="{{$provider->getAdress->district}}" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" name="city" placeholder="Cidade" value="{{$provider->getAdress->city}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="state" placeholder="Estado" value="{{$provider->getAdress->state}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="table-responsive">
                            <div class="form-group pull-left">
                                    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">Adicionar Item do Fornecedor</button>
                                </div>

                        <table class="table table-striped">
                            <thead>
                                <th>Descrição</th>
                                <th>Marca</th>
                                <th>Preço</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($provider->getPItems as $pitem)
                                <tr>
                                    <td>{{$pitem->getItem->name}}</td>
                                    <td>{{$pitem->getItem->getBrand->name}}</td>
                                    <td>{{$pitem->value}}</td>

                                    <td>
                                        <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$pitem->id}}" data-info="{{$pitem->id}}, {{$pitem->getItem->name}}, {{$pitem->getItem->getBrand->name}}, {{$pitem->value}}">Editar</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-confirm" value="{{ route('pitems.destroy', $pitem['id']) }}" type="button">Deletar</button>
                                    </td>
                                </tr>

                                {{--Modal Edit--}}

                                <div class="modal fade" id="modal-edit{{$pitem->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Editar Cliente</h4>
                                            </div>

                                            <div class="modal-body">
                                                <form method="get" action="{{route('pitems.update', $pitem->id)}}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" name="name" placeholder="Nome" value="{{$pitem->getItem->name}} {{$pitem->getItem->getBrand->name}}" class="form-control"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" name="provider_price" id="edit_provider_price" value="{{$pitem->value}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>



<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Cliente</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('pitems.create') }}">

                    <input type="hidden" name="provider_id" id="provider_id" value="{{ $provider->id }}"> @csrf

                    <div class="form-group">
                        <select class="form-control" id="item_id" name="item_id">
                            <option value="">Selecione um Produto</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->getBrand->name }}</option>
                            @endforeach                   
                            </select>

                        <input type="text" name="provider_price" id="provider_price">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
          $("#item-table").dataTable();
    });

</script>

<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $("#cnpj").mask("999.999.999-99");
        
        $("#telephone").mask("(99) 9999999-99");

    });

</script>

<script type="text/javascript">
    $('#provider_price').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});
    $('#edit_provider_price').maskMoney({prefix:'R$ ',thousands:'',decimal:'.'});

</script>



@stop