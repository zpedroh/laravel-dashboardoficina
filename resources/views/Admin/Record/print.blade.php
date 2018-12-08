
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Baixim Motos</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Sweetalert -->
    <link href="{{ asset('css/sweetalert/sweetalert.css') }}" rel="stylesheet">    

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables with bootstrap 3 style -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    @endif

    {{--datatables--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.min.css')}}"/>
    {{--select2--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2/select2.min.css')}}"/>
    {{--toastr--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr/toastr.css')}}"/>

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

  {{--<script src="{{asset('js/invoice/index.js')}}"></script>--}}
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Baixim Motos | Nota: {{$clientrecord->id}}
        <small class="pull-right">Data: {{$clientrecord->created_at->format('d/m/y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Origem
        <address>
          <strong>Baixim Motos</strong><br>
          Rua José Felix 36<br>
          Joanésia<br>
          CNPJ: 10.458.343/0001-58<br>
          Telefone: (33) 3252-1415<br>
          Email: bxmotos@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Destino
        <address>
        <strong>{{$clientrecord->getClient->name}}</strong><br>
        {{$clientrecord->getClient->getAdress->street}} {{$clientrecord->getClient->getAdress->number}}<br>
        {{$clientrecord->getClient->getAdress->city}}<br>
          CPF: {{$clientrecord->getClient->cpf}}<br>
          Telefone: {{$clientrecord->getClient->telephone}}<br>
          {{--Email: john.doe@example.com--}}
        </address>
      </div>
      <!-- /.col 
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>            
            <th>Descrição</th>
            <th>Marca</th>
            <th>Preço(un)</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
            @isset($clientrecord->getItems)
            @foreach($clientrecord->getItems as $recorditem)
            <tr>              
              <td>{{$recorditem->getItem->name}}</td>
              <td>{{$recorditem->getItem->getBrand->name}}</td>
              <td>R$ {{$recorditem->getItem->price}}</td>
              <td>{{$recorditem->quantity}}</td>
              <td>R$ {{$recorditem->item_total}}</td>
            </tr>
            @endforeach
            @endisset
            @isset($clientrecord->getServices)
            @foreach($clientrecord->getServices as $recordservice)
            <tr>              
                <td>{{$recordservice->getService->name}}</td>
                <td>-</td>
                <td>R$ {{$recordservice->getService->price}}</td>
                <td>{{$recordservice->quantity}}</td>
                <td>R$ {{$recordservice->service_total}}</td>
            </tr>
            @endforeach
            @endisset
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> -->
      <div class="col-xs-6">
        <p class="lead">Parcelas do Nota:</p>
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                  <tr>            
                    <th>Nº Parcela</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Vencimento</th>
                  </tr>
                </thead>
                <tbody>   
                  @foreach($clientrecord->getParcels as $parcel)
                  <tr>
                    <td>{{$parcel->number}}/{{$parcel->parcel_number}}</td>
                    <td>R$ {{$parcel->value}}</td>
                    <td>
                      @if($parcel->status <= 2)
                        Pendente
                      @elseif($parcel->status == 3)
                        Paga
                      @else
                        Cancelada
                      @endif
                    </td>
                    <td>
                      {{$parcel->date_formatted}}
                    </td>
                  </tr>      

                  @endforeach
                </tbody>
                </table>
                </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Total Nota</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>R$ {{$clientrecord->record_total}}</td>
            </tr>
            <tr>
              <th>Desconto</th>
              <td>R$ {{$clientrecord->discount}}</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>R$ {{$clientrecord->record_total - $clientrecord->discount}}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
