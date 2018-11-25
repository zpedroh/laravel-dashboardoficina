@extends('adminlte::page') 
@section('title', 'Fornecedor') 
@section('content_header')
<h1>Cadastrar Fornecedor</h1>

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

<div class="box-body">

    <form method="POST" action="{{ route('providers.create') }}">

        {!! csrf_field() !!}
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="name" placeholder="Nome" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" id="telephone" name="telephone" placeholder="Telefone" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="country" placeholder="País" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="state" placeholder="Estado" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="zipcode" placeholder="CEP" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="city" placeholder="Cidade" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="district" placeholder="Bairro" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="street" placeholder="Rua" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="number" placeholder="Nº" class="form-control">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>

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