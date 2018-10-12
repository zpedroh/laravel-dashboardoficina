@extends('adminlte::page') 
@section('title', 'Item') 
@section('content_header')
<h1>Fornecedores</h1>


@stop 
@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Fornecedor
</button>
<div class="container">
    <div class="table-responsive ">
        <table class="table table-bordered ">
            <thead class="col-md-10">

                <div class="col-md-7">
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
                        <th class="col-md-2"></th>
                    </tr>
                </div>
            </thead>
            <tbody class="col-md-9">
                <div class="row">
                    <div class="col-md-7">
                        <tr>
                            <td>1</td>
                            <td>Pedro</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <div class="col-md-2">
                                    <td style="margin-left:10px;">
                                        <a class="btn-warning btn-xs" data-toggle="modal" data-target="#modal-content">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                </a>
                                    </td>
                                    <td style="margin-left:10px;">
                                        <form action="{{ route('providers.edit')}}" method="get">
                                            @csrf
                                            <input name="_method" type="hidden" value="EDIT">
                                            <button class="btn btn-edit" type="submit">Editar</button>
                                        </form>
                                    </td>
            
                                    <td style="margin-left:10px;">
                                        <button class="btn btn-danger delete-confirm" {{--value="{{ route('records.destroy'}}" --}} type="button">Deletar</button>
                                    </td>
                                </div>
                        </tr>
                    </div>

               
                </div>

                {{--@endforeach--}}
            </tbody>
        </table>

    </div>

</div>


{{--Modais--}}

<div class="modal fade" id="modal-default">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Fornecedor</h4>
            </div>

            <div class="modal-body">

                <form>
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" placeholder="Nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="text" name="cpf" placeholder="CPF" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="zipcode">CEP:</label>
                                <input type="text" name="zipcode" placeholder="CEP" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="street">Rua:</label>
                                <input type="text" name="street" placeholder="Rua" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="number">Nº:</label>
                                <input type="text" name="number" placeholder="Nº" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">Complemento:</label>
                                <input type="text" name="country" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="district">Bairro:</label>
                                <input type="text" name="district" placeholder="Bairro" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <input type="text" name="city" placeholder="Cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <input type="text" name="state" placeholder="Estado" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Salvar</button>
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

<div class="modal fade" id="modal-content">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Itens do Fornecedor</h4>
            </div>

            <div class="modal-body">

                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Marca</th>
                            <th>Preço Fornecedor</th>
                        </tr>
                    </thead>
                    <tbody>{{-- @foreach($provideritem as $provideritem)
                        <tr>
                            <td>{{$provideritem->id}}</td>
                            <td>{{$provideritem->getItem->name}}</td>
                            <td>{{$provideritem->price}}</td>

                        </tr>
                        @endforeach--}}
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