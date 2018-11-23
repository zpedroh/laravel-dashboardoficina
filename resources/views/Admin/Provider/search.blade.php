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
        <table id="provider_table" class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Name</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($provider as $provider)
                <tr>
                    <td>{{$provider->id}}</td>
                    <td>{{$provider->name}}</td>
                    <td>{{$provider->cnpj}}</td>
                    <td>{{$provider->telephone}}</td>
                    <td>
                        <a class="btn-warning btn-xs" data-toggle="modal" data-target="#provider-items{{$provider['id']}}"><span class="glyphicon glyphicon-folder-open"></span></a>
                    </td>  
                    <td>
                        <a href="{{ route('providers.edit', $provider['id']) }}"><button class="btn btn-edit"  type="button">Editar</button></a>
                    </td>
                    <td>
                        <button class="btn btn-danger delete-confirm" value="{{ route('providers.destroy', $provider['id']) }}" type="button">Deletar</button>
                    </td>
                </tr>



                <div class="modal fade" id="provider-items{{$provider['id']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4>Informações Complementares</h4>
                            </div>

                            <div class="modal-body">
                                
                                <h4>Endereço</h4>
                                <li>Cep: {{$provider->getAdress->zipcode}}</li>
                                <li>Cidade: {{$provider->getAdress->city}}</li>
                                <li>Estado(UF):{{$provider->getAdress->state}}</li>
                                <li>Bairro:{{$provider->getAdress->district}}</li>
                                <li>Rua:{{$provider->getAdress->street}}</li>
                                <li>Nº:{{$provider->getAdress->number}}</li>
                                <li>Complemento:{{$provider->getAdress->complement}}</li>
                                
                                <h4>Itens do Fornecedor</h4>
                                @foreach($provider->getPItems as $pitem)
                                    <li>Item: {{$pitem->getItem->name}} Valor: {{$pitem->value}}</li>
                                @endforeach                                    
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
                                <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="telephone" name="telephone" placeholder="Telefone" class="form-control">
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
                                <input type="text" id="rua" name="district" placeholder="Bairro" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" id="cidade" name="city" placeholder="Cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" id="uf" name="state" placeholder="Estado" class="form-control">
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
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $("#cnpj").mask("999.999.999-99");
        $(".cnpj").mask("999.999.999-99");
        $("#telephone").mask("(99) 9999999-99");
        $(".telephone").mask("(99)9999999-99");
    });
</script>


@stop