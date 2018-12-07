@extends('adminlte::page') 
@section('title', 'Clientes') 
@section('content_header')
<h1>Clientes</h1>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>

<!-- Adicionando Javascript -->
<script type="text/javascript">
    $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $(".rua").val("");
                $(".bairro").val("");
                $(".cidade").val("");
                $(".uf").val("");
                //$("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $(".cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $(".rua").val("...");
                        $(".bairro").val("...");
                        $(".cidade").val("...");
                        $(".uf").val("...");
                        //$("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $(".rua").val(dados.logradouro);
                                $(".bairro").val(dados.bairro);
                                $(".cidade").val(dados.localidade);
                                $(".uf").val(dados.uf);
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


<div class="box">
    <div class="box-header">
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
                    Adicionar Cliente
                  </button>
    </div>
    <div class="box-body">
        <table id="client_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($client as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->cpf}}</td>
                    <td>{{$client->telephone}}</td>
                    <td>
                        <a class="btn-primary btn-xs" data-toggle="modal" data-target="#client-info{{$client['id']}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                
                        <a class="btn-xs btn-warning" type="button" data-toggle="modal" data-target="#modal-edit{{$client->id}}" data-info="{{$client->id}}, {{$client->name}}, {{$client->cpf}}, {{$client->telephone}}, {{$client->getAdress->id}}, {{$client->getAdress->zipcode}}, {{$client->getAdress->street}}, {{$client->getAdress->number}}, {{$client->getAdress->complement}}, {{$client->getAdress->district}}, {{$client->getAdress->city}}, {{$client->getAdress->state}}"><span class="fa fa-edit"></span></a>
                        {{--<button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$client->id}}" data-info="{{$client->id}}, {{$client->name}}, {{$client->cpf}}, {{$client->telephone}}, {{$client->getAdress->id}}, {{$client->getAdress->zipcode}}, {{$client->getAdress->street}}, {{$client->getAdress->number}}, {{$client->getAdress->complement}}, {{$client->getAdress->district}}, {{$client->getAdress->city}}, {{$client->getAdress->state}}">Editar</button>--}}
                        <a class="btn-xs btn-danger delete-confirm" href="{{ route('clients.destroy', $client['id']) }}" type="button"><i class="fa fa-trash"></i></a>
                        {{--<button class="btn btn-danger delete-confirm" value="{{ route('clients.destroy', $client['id']) }}" type="button"><i class="fa fa-trash"></i></button>--}}
                    </td>
                </tr>
                {{--Modal Edit--}}
                <div class="modal fade" id="modal-edit{{$client->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Editar Cliente</h4>
                            </div>
                            <div class="modal-body">
                                <form method="get" action="{{route('clients.update', $client->id)}}">
                                    @csrf
                                    <input type="hidden" value="{{$client->id}}">
                                    <input type="hidden" value="{{$client->getAdress->id}}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nome:</label>
                                                <input type="text" name="name" placeholder="Nome" value="{{$client->name}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cpf">CPF:</label>                                                    
                                                <input type="text" name="cpf" placeholder="CPF" value="{{$client->cpf}}" class="form-control cpf" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telephone">Telefone:</label>                                                    
                                                <input type="text" name="telephone" placeholder="Telefone" value="{{$client->telephone}}" class="form-control telephone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cep">CEP:</label>                                                    
                                                <input type="text" name="zipcode" placeholder="CEP" value="{{$client->getAdress->zipcode}}" class="form-control cep" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rua">Rua:</label>                                                   
                                                <input type="text" name="street" placeholder="Rua" value="{{$client->getAdress->street}}" class="form-control rua" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="numero">Nº:</label>                                                    
                                                <input type="text" name="number" placeholder="Número" value="{{$client->getAdress->number}}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="bairro">Bairro:</label>                                                    
                                                <input type="text" name="district" placeholder="Bairro" value="{{$client->getAdress->district}}" class="form-control bairro" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="cidade">Cidade:</label>                                                    
                                                <input type="text" name="city" placeholder="Cidade" value="{{$client->getAdress->city}}" class="form-control cidade" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="uf">UF:</label>
                                                <input type="text" name="state" placeholder="Estado" value="{{$client->getAdress->state}}" class="form-control uf" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="complemento">Complemento:</label>                                                    
                                                <input type="text" name="complement" placeholder="Complemento" value="{{$client->getAdress->complement}}" class="form-control">
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

                {{--Modal Info--}}

                <div class="modal fade" id="client-info{{$client['id']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4>Informações Complementares</h4>
                            </div>

                            <div class="modal-body">                            

                                <h4>Endereço</h4>
                                <li>Cep: {{$client->getAdress->zipcode}}</li>
                                <li>Cidade: {{$client->getAdress->city}}</li>
                                <li>Estado(UF): {{$client->getAdress->state}}</li>
                                <li>Bairro: {{$client->getAdress->district}}</li>
                                <li>Rua: {{$client->getAdress->street}}</li>
                                <li>Nº: {{$client->getAdress->number}}</li>
                                <li>Complemento: {{$client->getAdress->complement}}</li>
                                @if($client->getRecords <> '')
                                <h4>Notas em Aberto</h4>
                                @foreach($client->getRecords as $recordopen) 
                                    @if($recordopen->status < '3') 
                                        <li> <strong>Nº:</strong>  {{$recordopen->id}} <strong> | Total:</strong> R$ {{$recordopen->record_total}}</li>
                                    @endif 
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
                    <input type="hidden" name="client_register_record" value="1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" placeholder="Nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="text" name="cpf" placeholder="CPF" class="form-control cpf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telephone">Telefone:</label>
                                <input type="text" name="telephone" placeholder="Telefone" class="form-control telephone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cep">CEP:</label>
                                <input type="text" name="zipcode" placeholder="CEP" class="form-control cep" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rua">Rua:</label>
                                <input type="text" name="street" placeholder="Rua" class="form-control rua" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero">Nº:</label>
                                <input type="text" name="number" placeholder="Número" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="bairro">Bairro:</label>
                                <input type="text" name="district" placeholder="Bairro" class="form-control bairro" required>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="cidade">Cidade:</label>
                                <input type="text" name="city" placeholder="Cidade" class="form-control cidade" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="uf">UF:</label>
                                <input type="text" name="state" placeholder="Estado" class="form-control uf" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="complemento">Complemento:</label>
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
          $("#client_table").dataTable(
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
        //$("#cpf2").mask("999.999.999-99");
        $(".cpf").mask("999.999.999-99");
        //$("#telephone").mask("(99) 9999999-99");
        $(".telephone").mask("(99)9999999-99");
    });
</script>


@stop