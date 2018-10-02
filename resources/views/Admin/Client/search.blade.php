@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Adicionar Cliente
  </button>
  
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
  
            <div class="modal-body">
  
                <form method="POST" action="{{ route('clients.create') }}">      

                    {!! csrf_field() !!} 
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Nome" class="form-control">
                        </div>
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
                        
                    <div class="modal-footer">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Cadastrar</button>
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
        <td>{{$client['country']}}</td> 
        <td>{{$client['state']}}</td> 
        <td>{{$client['zipcode']}}</td> 
        <td>{{$client['city']}}</td> 
        <td>{{$client['district']}}</td> 
        <td>{{$client['street']}}</td> 
        <td>{{$client['number']}}</td>        

        <td>
          <form action="{{ route('clients.edit', $client['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('clients.destroy', $client['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@stop


