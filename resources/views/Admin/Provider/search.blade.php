@extends('adminlte::page') 
@section('title', 'Fornecedores') 
@section('content_header')
<h1>Fornecedores</h1>

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

<div class="box">
    <div class="box-header">
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
            Adicionar Fornecedor
        </button>
    </div>
    <div class="box-body">
        <div class="table-responsive">
                <table id="provider_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Name</th>
                                <th>CNPJ</th>
                                <th>Telefone</th>
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
                                    <a class="btn-primary btn-xs" data-toggle="modal" data-target="#provider-items{{$provider['id']}}"><span class="glyphicon glyphicon-eye-open"></span></a>
  
                                    <a class="btn-xs btn-warning"  type="button" href="{{ route('providers.edit', $provider['id']) }}"><span class="fa fa-edit"></span></a>
                                    
                                    <a class="btn-xs btn-danger delete-confirm" href="{{ route('providers.destroy', $provider['id']) }}" type="button"><span class="fa fa-trash"></span></a>
                                    {{--
                                    <button class="btn btn-edit"  type="button">Editar</button>
                                    <button class="btn btn-danger delete-confirm" value="{{ route('providers.destroy', $provider['id']) }}" type="button">Deletar</button>
                                    --}}
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
                                            
                                            <h4><strong>Endereço</strong></h4>

                                            <p>Rua:{{$provider->getAdress->street}}, Nº:{{$provider->getAdress->number}} <br>
                                            Bairro:{{$provider->getAdress->district}} - Cidade: {{$provider->getAdress->city}} - Cep: {{$provider->getAdress->zipcode}}<br>
                                            Estado:{{$provider->getAdress->state}}<br>
                                            Complemento:{{$provider->getAdress->complement}}
                                            </p>

                                            @if(isset($provider->getPItems->id))
                                            <h4><strong>Produtos do Fornecedor</strong></h4>
                                           
                                            @foreach($provider->getPItems as $pitem)
                                            <p>Descrição: {{$pitem->getItem->name}} <br>
                                                Valor: R$ {{$pitem->value}}
                                                </p>
                                            @endforeach  
                                            @endif                                  
                                            
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
                                <label for="name">Nome:</label>
                                <input type="text" name="name" placeholder="Nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cnpj">CNPJ:</label>
                                <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telephone">Telefone:</label>
                                <input type="text" id="telephone" name="telephone" placeholder="Telefone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">CEP:</label>
                                <input type="text" name="zipcode" id="cep" placeholder="CEP" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rua">Rua:</label>
                                <input type="text" name="street" id="rua" placeholder="Rua" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                    <label for="number">Nº:</label>
                                <input type="text" name="number" placeholder="Número" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="bairro">Bairro:</label>
                                <input type="text" id="bairro" name="district" placeholder="Bairro" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="city" placeholder="Cidade" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="uf">UF:</label>
                                <input type="text" id="uf" name="state" placeholder="Estado" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="complement">Complemento:</label>
                                <input type="text" name="complement" placeholder="Complemento" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
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



<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#provider_table").dataTable(
            {
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
          }
          );
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


{{--

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
                    @csrf 
                    <input name="_method" type="hidden" value="PATCH"> class="col-md-6"

                    <table class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Marca</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>@foreach($provideritem as $provideritem)
                                <tr>
                                    <td>{{$provideritem->id}}</td>
                                    <td>{{$provideritem->getItem->name}}</td>
                                    <td>{{$provideritem->price}}</td>
    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

--}}