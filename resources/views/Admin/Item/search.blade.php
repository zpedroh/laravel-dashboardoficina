@extends('adminlte::page')

@section('title', 'Item')

@section('content_header')
    <h1>Item</h1>
@stop

@section('content')


<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
  Adicionar Produto
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

              <form method="POST" action="{{ route('items.create') }}"> 
                      {!! csrf_field() !!}
          
                      <div class="form-group">
                          <input type="text" name="name" placeholder="Nome do Item" class="form-control" required>
                      </div>
          
                      <div class="form-group">
                          <select class="form-control" name="category" required>
                          <option value="">Selecione uma Categoria</option>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach                   
                          </select>
                      </div>
          
                      <!--
                          <span class="select2-selection__rendered" id="select2-m7mq-container" title="Alabama">Alabama</span>
          
                          col-md-6
                      -->            
          
                      <div class="form-group">
                          <select class="form-control" name="brand" required>
                          <option value="">Selecione uma Marca</option>
                          @foreach($brands as $brand)
                              <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                          @endforeach                   
                          </select>
                      </div>
          
                      <div class="form-group">
                          <input type="text" name="quantity" placeholder="Quantidade Atual" class="form-control" required>
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


   <table class="table table-striped">
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
          <form action="{{ route('items.edit', $item['id'])}}" method="get">
            @csrf
            <input name="_method" type="hidden" value="EDIT">        
            <button class="btn btn-success" type="submit">Edit</button>        
          </form>
        </td>

        <td>
          <form action="{{ route('items.destroy', $item['id'])}}" method="get">
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

<!--



  <div class="box-body">
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label></label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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
        @foreach($item as $item)                  
          <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['price']}}</td> 
            <td>{{$item['category_id']}}</td>                     
            <td>{{$item['brand_id']}}</td> 
            <td>{{$item['item_stock_id']}}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Preço</th>        
          <th>Categoria</th>
          <th>Marca</th>
          <th>Estoque</th>
        </tr>          
      </tfoot>
    
  </div>



$item->getItem()->name;


<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Browser</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Engine version</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">CSS grade</th></tr>
<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
</table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>



                    <tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.7</td>
                    <td>A</td>
                    </tr><tr role="row" class="even">
                    <td class="sorting_1">Gecko</td>
                    <td>Firefox 1.5</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                    </tr><tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Firefox 2.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                    </tr><tr role="row" class="even">
                    <td class="sorting_1">Gecko</td>
                    <td>Firefox 3.0</td>
                    <td>Win 2k+ / OSX.3+</td>
                    <td>1.9</td>
                    <td>A</td>
                    </tr><tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Camino 1.0</td>
                    <td>OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                    </tr><tr role="row" class="even">
                    <td class="sorting_1">Gecko</td>
                    <td>Camino 1.5</td>
                    <td>OSX.3+</td>
                    <td>1.8</td>
                    <td>A</td>
                    </tr><tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Netscape 7.2</td>
                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                    <td>1.7</td>
                    <td>A</td>
                    </tr><tr role="row" class="even">
                    <td class="sorting_1">Gecko</td>
                    <td>Netscape Browser 8</td>
                    <td>Win 98SE+</td>
                    <td>1.7</td>
                    <td>A</td>
                    </tr><tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Netscape Navigator 9</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                    </tr><tr role="row" class="even">
                    <td class="sorting_1">Gecko</td>
                    <td>Mozilla 1.0</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1</td>
                    <td>A</td>
-->
