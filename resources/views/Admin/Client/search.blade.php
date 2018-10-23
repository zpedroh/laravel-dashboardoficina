@extends('adminlte::page') 
@section('title', 'Cliente') 
@section('content_header')
<h1>Cliente</h1>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

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
    Adicionar Cliente
  </button>

<div class="table-responsive">
    <div class="col-lg-6">
        <table class="table table-striped">
            <thead>
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
                </tr>
            </thead>
            <tbody>

                @foreach($client as $client)

                <tr>
                    <td>{{$client['id']}}</td>
                    <td>{{$client['name']}}</td>
                    <td>{{$client['cpf']}}</td>
                    <td>{{$client->getAdress->complement}}</td>
                    <td>{{$client->getAdress->state}}</td>
                    <td>{{$client->getAdress->zipcode}}</td>
                    <td>{{$client->getAdress->city}}</td>
                    <td>{{$client->getAdress->district}}</td>
                    <td>{{$client->getAdress->street}}</td>
                    <td>{{$client->getAdress->number}}</td>
                    <td>
                        <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit" value="{{ route('clients.edit', $client['id'])}}">Editar</button>                        {{--
                        <form action="{{ route('clients.edit', $client['id'])}}" method="get">
                            @csrf
                            <input name="_method" type="hidden" value="EDIT">
                            <button class="btn btn-edit" type="submit">Editar</button>
                        </form>
                        --}}
                    </td>

                    <td>
                        <button class="btn btn-danger delete-confirm" value="{{ route('clients.destroy', $client['id']) }}" type="button">Deletar</button>
                    </td>
                </tr>
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
                <h4 class="modal-title">Adicionar Cliente</h4>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('clients.create') }}">

                    @csrf
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">CEP:</label>
                                <input type="text" name="zipcode" id="cep" placeholder="CEP" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street">Rua:</label>
                                <input type="text" name="street" id="rua" placeholder="Rua" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="number">Nº:</label>
                                <input type="text" name="number" placeholder="Nº" class="form-control">
                            </div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">Complemento:</label>
                                <input type="text" name="country" placeholder="País" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="district">Bairro:</label>
                                <input type="text" name="district" id="bairro" placeholder="Bairro" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <input type="text" name="city" id="cidade" placeholder="Cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <input type="text" name="state" id="uf" placeholder="Estado" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar</h4>
            </div>

            <div class="modal-body">
                <form method="get" action="{{route('clients.update', $client->id)}}">
                    @csrf {{--
                    <input name="_method" type="hidden" value="PATCH"> class="col-md-6"--}}

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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zipcode">CEP:</label>
                                <input type="text" name="zipcode" placeholder="CEP" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street">Rua:</label>
                                <input type="text" name="street" placeholder="Rua" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="number">Nº:</label>
                                <input type="text" name="number" placeholder="Nº" class="form-control">
                            </div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">Complemento:</label>
                                <input type="text" name="country" placeholder="País" class="form-control">
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


@stop