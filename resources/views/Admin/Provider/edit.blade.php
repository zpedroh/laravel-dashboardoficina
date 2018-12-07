@extends('adminlte::page') 
@section('title', 'Fornecedor') 
@section('content_header') 

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
                        //$("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                //$("#ibge").val(dados.ibge);
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

<div class="col-md-8">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Fornecedor</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Produtos do Fornecedor</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                
                    <form method="get" action="{{route('providers.update', $provider->id)}}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" placeholder="Nome" value="{{$provider->name}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cnpj">CNPJ:</label>
                                    <input type="text" id="cnpj" name="cnpj" placeholder="cnpj" value="{{$provider->cnpj}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telephone">Telefone:</label>
                                    <input type="text" id="telephone" name="telephone" placeholder="Telefone" value="{{$provider->telephone}}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cep">CEP:</label>
                                    <input type="text" id="cep" name="zipcode" placeholder="CEP" value="{{$provider->getAdress->zipcode}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" id="cidade" name="city" placeholder="Cidade" value="{{$provider->getAdress->city}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="uf">UF:</label>
                                    <input type="text" id="uf" name="state" placeholder="UF" value="{{$provider->getAdress->state}}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" id="bairro" name="district" placeholder="Bairro" value="{{$provider->getAdress->district}}" class="form-control" required>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rua">Rua:</label>
                                    <input type="text" id="rua" name="street" placeholder="Rua" value="{{$provider->getAdress->street}}" class="form-control" required>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="numero">Nº:</label>
                                    <input type="text" id="numero" name="number" placeholder="Número" value="{{$provider->getAdress->number}}" class="form-control" required>
                                </div>
                            </div>             
                        </div>
            
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="complement">Complemento:</label>
                                    <input type="text" name="complement" placeholder="Complemento" value="{{$provider->getAdress->complement}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top: 3.3%;">
                                <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                            </div>
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
                            </thead>
                            <tbody>
                                @foreach($provider->getPItems as $pitem)
                                <tr>
                                    <td>{{$pitem->getItem->name}}</td>
                                    <td>{{$pitem->getItem->getBrand->name}}</td>
                                    <td>R$ {{$pitem->value}}</td>

                                    <td>
                                        
                                        <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$pitem->id}}" data-info="{{$pitem->id}}, {{$pitem->getItem->name}}, {{$pitem->getItem->getBrand->name}}, {{$pitem->value}}"><span class="fa fa-edit"></span></a>
                                        <a class="btn-xs btn-danger delete-confirm" href="{{ route('pitems.destroy', $pitem['id']) }}" type="button"><span class="fa fa-trash"></span></a>
                                        {{--
                                        <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$pitem->id}}" data-info="{{$pitem->id}}, {{$pitem->getItem->name}}, {{$pitem->getItem->getBrand->name}}, {{$pitem->value}}">Editar</button>
                                        <button class="btn btn-danger delete-confirm" value="{{ route('pitems.destroy', $pitem['id']) }}" type="button">Deletar</button>
                                        --}}
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
                                                                <label for="name">Produto:</label>
                                                                <input type="text" name="name" placeholder="Nome" value="{{$pitem->getItem->name}} {{$pitem->getItem->getBrand->name}}" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="provider_price">Preço:</label>
                                                                <input type="text" name="provider_price" id="edit_provider_price" value="R$ {{$pitem->value}}" required>
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
                <h4 class="modal-title">Adicionar Produto do Fornecedor</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('pitems.create') }}">

                    <input type="hidden" name="provider_id" id="provider_id" value="{{ $provider->id }}"> @csrf
                    
                    <div class="form-group">
                        <label for="item_id">Produto</label>
                        <select class="form-control" id="item_id" name="item_id" required>
                            <option value="">Selecione um Produto</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->getBrand->name }}</option>
                            @endforeach                   
                            </select>
                        
                        <label for="provider_price">Preço:</label>
                        <input type="text" name="provider_price" id="provider_price" class="form-control" required>
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