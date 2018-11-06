@extends('adminlte::page') 
@section('title', 'Home') 
@section('content_header')
<h1>Dashboard</h1>









@stop 
@section('content')
<section class="content">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>

                    <p>Novas Notas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Media de Pagamento</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>

                    <p>Novos Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">

                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row" style="margin:0px;padding-top:25px;">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="text-align:center">Produtos em Falta</h5>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <span class="card-text">Produto 2</span>
                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-estoque">Adicionar em Estoque</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <span class="card-text">Produto 2</span>
                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-estoque">Adicionar em Estoque</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <span class="card-text">Produto 2</span>
                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-estoque">Adicionar em Estoque</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <span class="card-text">Produto 2</span>
                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-estoque">Adicionar em Estoque</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="text-align:center">Notas Pendentes</h5>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <div class="col-md-2">
                                    <span class="card-text">145879 </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">Pedro</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">3/5 Parcelas</span>
                                </div>

                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-nota">Ver</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <div class="col-md-2">
                                    <span class="card-text">145879 </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">Pedro</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">3/5 Parcelas</span>
                                </div>

                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-nota">Ver</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <div class="col-md-2">
                                    <span class="card-text">145879 </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">Pedro</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">3/5 Parcelas</span>
                                </div>

                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-nota">Ver</a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row" style="margin:0px;">
                                <div class="col-md-2">
                                    <i class="fas fa-money-check"></i>
                                    <span class="card-text">145879 </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">Pedro</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text">3/5 Parcelas</span>
                                </div>

                                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-nota">Ver</a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Adicionar Estoque-->
    <div class="modal fade" id="modal-estoque">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Mudar Em Estoque</h4>
                </div>

                <div class="modal-body">

                    <form method="POST" style="font-size:12pt;">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <label for="quantity">Produto</label></br>
                                <span> Produto que nao sei dizer o nome</span>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity">Marca</label></br>
                                <span> Furukawa</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quantity">Quantidade Em Estoque</label></br>
                                <span> 10</span>
                            </div>

                            <div class="col-md-4">
                                <label for="quantity">Quantidade Minima:</label></br>
                                <span> 18</span>
                            </div>

                            <div class="col-md-4">
                                <label for="name">Adicionar Quantidade:</label></br>
                                <input type="number" name="name" class="form-control">
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
    <!-- Modal Adicionar Estoque-->
    <div class="modal fade" id="modal-nota">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Nota Pendente</h4>
                </div>

                <div class="modal-body">

                    <form method="POST" style="font-size:12pt;">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <label for="quantity">Cliente</label></br>
                                <span>Pedro Melo</span>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity">Data de Emissao</label></br>
                                <span> 25/11/2018</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quantity">Forma de Pagamento</label></br>
                                <span> Cheque</span>
                            </div>

                            <div class="col-md-4">
                                <label for="quantity">Quantidade de Parcelas</label></br>
                                <span> 3</span>
                            </div>

                            <div class="col-md-4">
                                <label for="name">Status</label></br>
                                <span> Em aberto</span>
                            </div>
                        </div>
                        <div class="row" style="padding-top:20px;">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Parcela</th>
                                        <th scope="col">Data de Vencimento</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Descricao da Nota</td>
                                        <td>25/12/2018</td>
                                        <td>R$125.30</td>
                                        <td>Aberta</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Descricao da Nota</td>
                                        <td>25/12/2018</td>
                                        <td>R$125.30</td>
                                        <td>Aberta</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Descricao da Nota</td>
                                        <td>25/12/2018</td>
                                        <td>R$125.30</td>
                                        <td>Aberta</td>
                                    </tr>
                                </tbody>
                            </table>
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