@extends('adminlte::page') 
@section('title', 'Caegoria') 
@section('content_header')
<h1>Formas de Pagamento</h1>


@stop 
@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Forma de Pagamento
</button>


<div class="table-responsive">
  <div class="col-lg-6">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Parcelas</th>
          <th>Periodo</th>
          <th>Vencimento</th>
        </tr>
      </thead>
      <tbody>

        @foreach($paymentmethod as $paymentmethod)

        <tr>
          <td>{{$paymentmethod['id']}}</td>
          <td>{{$paymentmethod['type']}}</td>
          <td>{{$paymentmethod['parcel']}}</td>
          <td>{{$paymentmethod['period']}}</td>
          <td>{{$paymentmethod['duedate']}}</td>

          <td>

            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit" value="{{ route('paymentmethods.edit', $paymentmethod['id'])}}">Editar</button>

          </td>

          <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('paymentmethods.destroy', $paymentmethod['id']) }}" type="button">Deletar</button>
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
        <h4 class="modal-title">Adicionar Forma de Pagamento</h4>
      </div>

      <div class="modal-body">

        <form method="POST" action="{{ route('paymentmethods.create') }}">

          @csrf

          <div class="form-group">
            <label for="name">Tipo:</label>
            <input type="text" name="type" placeholder="Tipo" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Parcelas:</label>
            <input type="text" name="parcel" placeholder="Parcelas" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Periodo:</label>
            <input type="text" name="period" placeholder="Periodo" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Vencimento:</label>
            <input type="text" name="duedate" placeholder="Vencimento" class="form-control">
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
        <form method="get" action="{{route('paymentmethods.update', $paymentmethod->id)}}">
          @csrf
          <div class="form-group">
            <label for="name">Tipo:</label>
            <input type="text" name="type" placeholder="Tipo" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Parcelas:</label>
            <input type="text" name="parcel" placeholder="Parcelas" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Periodo:</label>
            <input type="text" name="period" placeholder="Periodo" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">Vencimento:</label>
            <input type="text" name="duedate" placeholder="Vencimento" class="form-control">
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