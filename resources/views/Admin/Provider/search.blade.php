@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Fornecedores</h1>
@stop

@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
    Adicionar Fornecedor
  </button>
  <div class="table-responsive">
  <div class="col-lg-6">
  <table class="table table-bordered table-dark">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
          <td>1</td>
          <td>Pedro</td>
          <td>Hoje</td>  
    {{--
    @if(Auth::user()->type_id == 1)
      Menu
    @endif
    --}}
    {{--
      @foreach($provider as $provider)
      
        <td>{{$provider->id}}</td>
        <td>{{$provider->name}}</td>
        <td>{{$provider->created_at}}</td>
    --}}
        <td>
            <a class="btn-warning btn-xs" data-toggle="modal" data-target="#modal-content">
              <span class="glyphicon glyphicon-folder-open"></span>
            </a> 
          </td>
        <td>
          <form action="{{ route('providers.edit')}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">      
            <button class="btn btn-edit" type="submit">Editar</button>        
          </form>
        </td>

        <td>
            <button class="btn btn-danger delete-confirm" {{--value="{{ route('records.destroy'}}"--}} type="button">Deletar</button>
        </td>
      </tr>
      {{--@endforeach--}}
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
                  <h4 class="modal-title">Adicionar Fornecedor</h4>
              </div>
    
              <div class="modal-body">
    
                  <form>      
                      {!! csrf_field() !!} 
                      <div class="form-group">
                          <input type="text" name="name" placeholder="Nome" class="form-control">
                      </div>                
                      <div class="form-group">
                          <input type="text" name="cpf" placeholder="CPF" class="form-control">
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
          </div>
          <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  <div class="modal fade" id="modal-content">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Itens do Fornecedor</h4>
        </div>

        <div class="modal-body">

            <table class="table table-bordered table-dark">
                <thead>
                  <tr>
                    <th>Produto</th>
                    <th>Marca</th>
                    <th>Preço Fornecedor</th>
                  </tr>
                </thead>
                <tbody>{{--
                    @foreach($provideritem as $provideritem)      
                    <tr>
                      <td>{{$provideritem->id}}</td>
                      <td>{{$provideritem->getItem->name}}</td>
                      <td>{{$provideritem->price}}</td>

                    </tr>
                    @endforeach--}}
                  </tbody>
                </table>
        </div>
      </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@stop
