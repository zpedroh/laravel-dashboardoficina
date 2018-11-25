@extends('adminlte::page') 
@section('title', 'BS') 
@section('content_header')
<h1>Notas Pendentes</h1>
@stop 
@section('content')

<div class="box">
    <div class="box-header">
        Resultado
    </div>  
    
        <div class="box-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="report_table">

                    <thead>
                        <th>Cliente</th>
                        <th>Nota</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        @isset($result)
                        @foreach($result as $result)

                            <tr>
                                <td>{{$result['name']}}</td>
                                <td>{{$result['record']}}</td>
                                <td>R$ {{$result['record_total']}}</td>
                            </tr>
    
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript" language="javascript">
    jQuery(document).ready(function () {
          $("#report_table").dataTable(
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

@stop