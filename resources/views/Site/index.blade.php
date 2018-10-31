@extends('adminlte::page') 
@section('title', 'Marca') 
@section('content_header')
<meta charset="UTF-8">
<title>Simple Invoice</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>

<link rel="stylesheet" href="public/css/invoice/style.css"> 

@stop 
@section('content')



<body>

  <div class="invoice">
    <table>
      <tr>
        <td>
          <h1>Invoice</h1><br><b>David Hanaford Web Development</b><br>Invoice # 1<br>Date: 9/17/2018<br></td>
        {{--
        <td><img src="http://davidhanaford.com/images/logo-01.svg" alt="David Hanaford's Logo" /></td>--}}
      </tr>
    </table>
    <br>
    <div class="table-responsive">
      <table id="invoiceDetails" class="table">
        <thead class="thead-dark">
          <tr>
            <th>Description</th>
            <th>Hours</th>
            <th>Rate</th>
            <th>Cost</th>
            <th></th>
          </tr>
        </thead>
        <tr v-for="(item, index) in items">
          <td><input class="form-control" type="text" v-model="item.description" /></td>
          <td><input class="form-control" type="number" v-model="item.hours" /></span>
          </td>
          <td>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">$</div>
              </div><input class="form-control" type="number" v-model="item.rate" /><span class="inline"> / hr</span>
            </div>
          </td>
          <td><b>${{formatCost(item)}}</b></td>
          <td><button @click="removeItem(index)" class="btn btn-danger"> - </button></td>
        </tr>
        <tr>
          <td colspan="5" align="right"><button @click="addItem" class="btn btn-primary">Add Item</button></td>
        </tr>
        <tr>
          <td class="total" colspan="5" align="right"><b>Total: ${{formatPrice(total)}}</b></td>
        </tr>
      </table>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js'></script>


  
@stop