@extends('adminlte::page') 
@section('title', 'Caegoria') 
@section('content_header')
<h1>Formas de Pagamento</h1>



@stop 
@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Forma de Pagamento
</button>



<div class="container">

    <div class="col-md-10">
        <table class="table table-striped table-responsive">
      <thead>
        <tr>
          <th>Código</th>
          <th>Tipo</th>
          <th>Parcelas</th>
          <th>Período</th>
          <th>Dia do Vencimento</th>
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
              <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit{{$paymentmethod->id}}" data-info="{{$paymentmethod->type}}, {{$paymentmethod->parcel}}, {{$paymentmethod->period}}, {{$paymentmethod->duedate}}">Editar</button>
          </td>

          <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('paymentmethods.destroy', $paymentmethod['id']) }}" type="button">Deletar</button>
          </td>
        </tr>

        {{--modal edit --}}

        <div class="modal fade" id="modal-edit{{$paymentmethod->id}}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Editar Forma de Pagamento</h4>
                  </div>

                  <div class="modal-body">
                    <form method="get" action="{{route('paymentmethods.update', $paymentmethod->id)}}">
                      @csrf

                      <input type="hidden" value="{{$paymentmethod->id}}">

                      <div class="form-group">
                        <label for="name">Tipo:</label>
                        <input type="text" name="type" placeholder="Tipo" value="{{$paymentmethod->type}}" class="form-control">
                      </div>
                      
                      <div class="form-group">
                        <label for="name">Parcelas:</label>
                        <input type="text" name="parcel" placeholder="Parcelas" value="{{$paymentmethod->parcel}}" class="form-control">
                      </div>
            
                      <div class="form-group">
                        <label for="name">Periodo:</label>
                        <input type="text" name="period" placeholder="Periodo" value="{{$paymentmethod->period}}" class="form-control">
                      </div>
            
                      <div class="form-group">
                        <label for="name">Vencimento:</label>
                        <input type="text" name="duedate" placeholder="Vencimento" value="{{$paymentmethod->duedate}}" class="form-control">
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

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="type" placeholder="Título" class="form-control">
                </div>
      
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="parcel" placeholder="Parcelas" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <input type="text" name="period" placeholder="Período" class="form-control">
                    </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <input type="numer" name="duedate" placeholder="Dia do Vencimento" class="form-control">
                    </div>
              </div>
            </div>

          <div class="modal-footer">
              <button type="submit" class="btn btn-success">Cadastrar</button>
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





@stop