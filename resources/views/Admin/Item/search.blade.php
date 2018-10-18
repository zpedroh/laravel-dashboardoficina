@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Item</h1>
@stop

@section('content')


<button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">
  Adicionar Produto
</button>
<div class="table-responsive">
        <div class="col-lg-6">
   <table id="tabela" class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Preço</th>        
        <th>Categoria</th>
        <th>Marca</th>
        <th>Estoque</th>
      </tr>
    </thead>
    <tbody>
    
    {{--
    @if(Auth::user()->type_id == 1)
      Menu
    @endif
    --}}
    
      @foreach($item as $item)
      
      <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->price}}</td> 
        <td>{{$item->getCategory->name}}</td> 
        <td>{{$item->getBrand->name}}</td> 
        <td>{{$item->getItemStock->quantity}}</td>        

        <td>
            <button class="btn btn-edit" type="button" data-toggle="modal" data-target="#modal-edit" value="{{ route('items.edit', $item['id'])}}">Editar</button>        
            {{--
          <form action="{{ route('items.edit', $item['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-edit" type="submit">Editar</button>        
          </form>
          --}}
        </td>

        <td>  
          <button class="btn btn-danger delete-confirm" value="{{ route('items.destroy', $item['id']) }}" type="button">Delete</button>
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
                  <h4 class="modal-title">Adicionar Produto</h4>
              </div>

                                        <!--
                              <span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>
              
                              col-md-6
                          -->  
    
              <div class="modal-body">
    
                  <form method="POST" action="{{ route('items.create') }}"> 
                        @csrf
                        {{--<input name="_method" type="hidden" value="PATCH">--}}
                
                        <label for="name">Name:</label>
                        <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>        
                        <label for="category">Categoria:</label>
                        <select class="form-control" name="category" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach                   
                        </select>
                        <label for="brand">Marca:</label>        
                        <select class="form-control" name="brand" required>
                            <option value="">Selecione uma Marca</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach                   
                        </select>
                                     
                        <label for="quantity">Quantidade:</label>
                        <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
                                       
                        <label for="price">Preço:</label>
                        <input type="text" name="price" placeholder="Preço" class="form-control" required>

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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar</h4>
                </div>
      
                <div class="modal-body">
                    <form method="get" action="{{route('items.update', $item->id)}}">
                        @csrf
                        {{--<input name="_method" type="hidden" value="PATCH">--}}
                
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{$item->name}}">         
                        <label for="category">Categoria:</label>
                        <select class="form-control" name="category" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach                   
                        </select>
                        <label for="brand">Marca:</label>        
                        <select class="form-control" name="brand" required>
                            <option value="">Selecione uma Marca</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach                   
                        </select>
                                     
                        <label for="quantity">Quantidade:</label>
                        <input type="text" class="form-control" name="quantity" value="{{$item->getItemStock->quantity}}">
                                       
                        <label for="price">Preço:</label>
                        <input type="text" class="form-control" name="price" value="{{$item->price}}">

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

        
{{--
<script>
        $(document).ready(function () {
          //$('#databela').DataTable()
          $('#tabela').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
</script>

--}}

@stop
