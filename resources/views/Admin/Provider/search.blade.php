@extends('adminlte::page') 
@section('title', 'Fornecedor') 
@section('content_header')
<h1>Fornecedor</h1>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>

<!-- Adicionando Javascript -->
<script type="text/javascript">
    $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

</script>

@stop 
@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Fornecedor
</button>

<div class="container">

    <div class="col-md-10">
        <table id="provider_table" class="table table-striped table-responsive" id="service-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>cnpj</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Nº</th>
                    <th></th>
                    <th></th>
                    <th class="col-md-2"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($provider as $provider)
                <tr>
                    <td>{{$provider['id']}}</td>
                    <td>{{$provider['name']}}</td>
                    <td>{{$provider['cnpj']}}</td>
                    <td>{{$provider->getAdress->complement}}</td>
                    <td>{{$provider->getAdress->state}}</td>
                    <td>{{$provider->getAdress->zipcode}}</td>
                    <td>{{$provider->getAdress->city}}</td>
                    <td>{{$provider->getAdress->district}}</td>
                    <td>{{$provider->getAdress->street}}</td>
                    <td>{{$provider->getAdress->number}}</td>
                    <td>
                        <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$provider->id}}" data-info="{{$provider->id}}, {{$provider->name}}, {{$provider->cnpj}}, {{$provider->getAdress->id}}, {{$provider->getAdress->zipcode}}, {{$provider->getAdress->street}}, {{$provider->getAdress->number}}, {{$provider->getAdress->complement}}, {{$provider->getAdress->district}}, {{$provider->getAdress->city}}, {{$provider->getAdress->state}}">Editar</button>
                    </td>

                    <td>
                        <button class="btn btn-danger delete-confirm" value="{{ route('providers.destroy', $provider['id']) }}" type="button">Deletar</button>
                    </td>
                </tr>

                {{--Modal Edit--}}

                <div class="modal fade" id="modal-edit{{$provider->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Editar Fornecedor</h4>
                            </div>

                            <div class="modal-body">
                                <form method="get" action="{{route('providers.update', $provider->id)}}">
                                    @csrf

                                    <input type="hidden" value="{{$provider->id}}">
                                    <input type="hidden" value="{{$provider->getAdress->id}}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Nome" value="{{$provider->name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="cnpj" placeholder="cnpj" value="{{$provider->cnpj}}" class="form-control">
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

{{--Modais--}}

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Fornecedor</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('providers.create') }}">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="cnpj" placeholder="CNPJ" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">CEP:</label>
                                <input type="text" name="zipcode" id="cep" placeholder="CEP" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="street" id="rua" placeholder="Rua" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="number" placeholder="Número" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="country" placeholder="País" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" name="district" placeholder="Bairro" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" name="city" placeholder="Cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="state" placeholder="Estado" class="form-control">
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Produtos do Fornecedor</h4>
            </div>

            <div class="modal-body">
                <form method="get" action="{{route('providers.update', $provider->id)}}">
                    @csrf {{--
                    <input name="_method" type="hidden" value="PATCH"> class="col-md-6"--}}

                    <table class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Marca</th>
                                <th>Preço</th>
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

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#provider_table").dataTable();
    });
  </script>

@stop