@extends('adminlte::page')

@section('title', 'Serviços')

@section('content_header')
    <h1>Serviços</h1>    
@stop

@section('content')

<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Serviço
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

            <form method="POST" action="{{ route('services.create') }}">    

              {!! csrf_field() !!}                 
            
              <div class="form-group">
                  <input type="text" name="name" placeholder="Nome" class="form-control" required>
              </div>
            
              <div class="form-group">
                  <input type="text" name="price" placeholder="Preço" class="form-control" required>
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

<div class="div-box">
    <div class="box-header with-border">
        <h3 class="box-title">Bordered Table</h3>
      </div>
    <div class="box-body">
  <div class="table-responsive">
    <div class="col-lg-4">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Preço</th>        
        </tr>
      </thead>
      <tbody>
        
        @foreach($service as $service)
        
        <tr>
          <td>{{$service->id}}</td>
          <td>{{$service->name}}</td>
          <td>{{$service->price}}</td> 
          <td>
          </td>
          <td>
            <form action="{{ route('services.edit', $service['id'])}}" method="get">
              @csrf
              <input name="_method" type="hidden" value="EDIT">        
              <button class="btn btn-edit" type="submit">Editar</button>        
            </form>
          </td>
          
          <td>
            <button class="btn btn-danger delete-confirm" value="{{ route('services.destroy', $service->id) }}" type="button">Deletar</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</div>
</div>
@stop

{{--

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Bordered Table</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>Task</th>
          <th>Progress</th>
          <th style="width: 40px">Label</th>
        </tr>
        <tr>
          <td>1.</td>
          <td>Update software</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
            </div>
          </td>
          <td><span class="badge bg-red">55%</span></td>
        </tr>
        <tr>
          <td>2.</td>
          <td>Clean database</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
            </div>
          </td>
          <td><span class="badge bg-yellow">70%</span></td>
        </tr>
        <tr>
          <td>3.</td>
          <td>Cron job running</td>
          <td>
            <div class="progress progress-xs progress-striped active">
              <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
            </div>
          </td>
          <td><span class="badge bg-light-blue">30%</span></td>
        </tr>
        <tr>
          <td>4.</td>
          <td>Fix and squish bugs</td>
          <td>
            <div class="progress progress-xs progress-striped active">
              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
            </div>
          </td>
          <td><span class="badge bg-green">90%</span></td>
        </tr>
      </tbody></table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">«</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">»</a></li>
      </ul>
    </div>
  </div> 
  
  --}}