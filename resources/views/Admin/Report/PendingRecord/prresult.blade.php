@extends('adminlte::page') 
@section('title', 'Relatorio') 
@section('content_header')
<h1>Pedidos Periodo</h1>
@stop 
@section('content')

<div class="box">
    <div class="box-header">
        
    </div>  
    
        <div class="box-body">

            <div class="box-header">

            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="report_table">

                    <thead>
                        <th>Cliente</th>
                        <th>Pedido</th>
                        <th>Status</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        @isset($result)
                        @foreach($result as $result)

                            <tr>
                                <td>{{$result['name']}}</td>
                                <td>{{$result['record']}}</td>
                                <td>                  
                                    @if($result['status'] == 1)
                                        <span class="label label-warning">Aberto</span> 
                                        @elseif($result['status'] == 2)
                                        <span class="label label-primary">Pendente</span> 
                                        @elseif($result['status'] == 3)
                                        <span class="label label-success">Paga</span>
                                        @else
                                        <span class="label label-danger">Cancelada</span> 
                                    @endif
                                </td>
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