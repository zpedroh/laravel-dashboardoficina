    @extends('adminlte::page')

    @section('title', 'Home')

    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable ui-sortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="300" version="1.1" width="508" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="49.515625" y="261" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M62.015625,261H483" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.515625" y="202" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">7,500</tspan></text><path fill="none" stroke="#aaaaaa" d="M62.015625,202H483" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.515625" y="143" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M62.015625,143H483" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.515625" y="84.00000000000003" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4.000000000000028" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">22,500</tspan></text><path fill="none" stroke="#aaaaaa" d="M62.015625,84.00000000000003H483" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.515625" y="25.00000000000003" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4.000000000000028" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M62.015625,25.00000000000003H483" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="405.73853992633656" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="218.52070122645807" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><path fill="#74a5c2" stroke="none" d="M62.015625,219.05493333333334C73.78068043742405,219.56626666666668,97.31079131227219,222.62345,109.07584674969624,221.10026666666667C120.84090218712029,219.57708333333335,144.37101306196843,209.13609859561225,156.13606849939248,206.86946666666668C167.76791452289643,204.62849859561226,191.0316065699043,204.88132019993895,202.66345259340827,203.06986666666666C214.30595537002583,201.25675353327227,237.59096092326092,194.9135027923211,249.23346369987848,192.3712C260.99851913730254,189.80213612565444,284.52863001215064,182.51721666666668,296.2936854495747,182.6244C308.05874088699875,182.73158333333333,331.5888517618469,204.18306539133076,343.35390719927096,193.22866666666667C354.9857532227749,182.3982987246641,378.24944526978277,101.94099634745244,389.8812912932867,95.48533333333336C401.395913032541,89.09472968078578,424.42515651104947,135.13645416189823,435.93977825030373,141.8436C447.7048336877278,148.6966208285649,471.23494456257595,147.7554,483,149.726L483,261L62.015625,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#3c8dbc" d="M62.015625,219.05493333333334C73.78068043742405,219.56626666666668,97.31079131227219,222.62345,109.07584674969624,221.10026666666667C120.84090218712029,219.57708333333335,144.37101306196843,209.13609859561225,156.13606849939248,206.86946666666668C167.76791452289643,204.62849859561226,191.0316065699043,204.88132019993895,202.66345259340827,203.06986666666666C214.30595537002583,201.25675353327227,237.59096092326092,194.9135027923211,249.23346369987848,192.3712C260.99851913730254,189.80213612565444,284.52863001215064,182.51721666666668,296.2936854495747,182.6244C308.05874088699875,182.73158333333333,331.5888517618469,204.18306539133076,343.35390719927096,193.22866666666667C354.9857532227749,182.3982987246641,378.24944526978277,101.94099634745244,389.8812912932867,95.48533333333336C401.395913032541,89.09472968078578,424.42515651104947,135.13645416189823,435.93977825030373,141.8436C447.7048336877278,148.6966208285649,471.23494456257595,147.7554,483,149.726" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="62.015625" cy="219.05493333333334" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="109.07584674969624" cy="221.10026666666667" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="156.13606849939248" cy="206.86946666666668" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="202.66345259340827" cy="203.06986666666666" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="249.23346369987848" cy="192.3712" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="296.2936854495747" cy="182.6244" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="343.35390719927096" cy="193.22866666666667" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="389.8812912932867" cy="95.48533333333336" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="435.93977825030373" cy="141.8436" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="483" cy="149.726" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#eaf3f6" stroke="none" d="M62.015625,240.02746666666667C73.78068043742405,239.8072,97.31079131227219,241.35496666666666,109.07584674969624,239.1464C120.84090218712029,236.93783333333334,144.37101306196843,223.33698698853718,156.13606849939248,222.35893333333334C167.76791452289643,221.39195365520382,191.0316065699043,233.23177876984127,202.66345259340827,231.36626666666666C214.30595537002583,229.49904543650794,237.59096092326092,209.28948603839441,249.23346369987848,207.428C260.99851913730254,205.54691937172774,284.52863001215064,214.4391666666667,296.2936854495747,216.39600000000002C308.05874088699875,218.35283333333336,331.5888517618469,232.38159338039932,343.35390719927096,223.08266666666668C354.9857532227749,213.88902671373265,378.24944526978277,148.2241679481277,389.8812912932867,142.42573333333334C401.395913032541,136.68573461479437,424.42515651104947,170.46886726939806,435.93977825030373,176.92893333333336C447.7048336877278,183.5295006027314,471.23494456257595,190.23343333333335,483,194.66826666666668L483,261L62.015625,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#a0d0e0" d="M62.015625,240.02746666666667C73.78068043742405,239.8072,97.31079131227219,241.35496666666666,109.07584674969624,239.1464C120.84090218712029,236.93783333333334,144.37101306196843,223.33698698853718,156.13606849939248,222.35893333333334C167.76791452289643,221.39195365520382,191.0316065699043,233.23177876984127,202.66345259340827,231.36626666666666C214.30595537002583,229.49904543650794,237.59096092326092,209.28948603839441,249.23346369987848,207.428C260.99851913730254,205.54691937172774,284.52863001215064,214.4391666666667,296.2936854495747,216.39600000000002C308.05874088699875,218.35283333333336,331.5888517618469,232.38159338039932,343.35390719927096,223.08266666666668C354.9857532227749,213.88902671373265,378.24944526978277,148.2241679481277,389.8812912932867,142.42573333333334C401.395913032541,136.68573461479437,424.42515651104947,170.46886726939806,435.93977825030373,176.92893333333336C447.7048336877278,183.5295006027314,471.23494456257595,190.23343333333335,483,194.66826666666668" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="62.015625" cy="240.02746666666667" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="109.07584674969624" cy="239.1464" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="156.13606849939248" cy="222.35893333333334" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="202.66345259340827" cy="231.36626666666666" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="249.23346369987848" cy="207.428" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="296.2936854495747" cy="216.39600000000002" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="343.35390719927096" cy="223.08266666666668" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="389.8812912932867" cy="142.42573333333334" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="435.93977825030373" cy="176.92893333333336" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="483" cy="194.66826666666668" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 377.016px; top: 137px; display: none;"><div class="morris-hover-row-label">2012 Q3</div><div class="morris-hover-point" style="color: #a0d0e0">
    Item 1:
    4,820
    </div><div class="morris-hover-point" style="color: #3c8dbc">
    Item 2:
    3,795
    </div></div></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"><svg height="300" version="1.1" width="538" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#3c8dbc" d="M269,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,357.2277551949771,180.44625304313007" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#3c8dbc" stroke="#ffffff" d="M269,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,360.06364732624417,181.4248826052307L396.6151459070204,194.03833029452744A135,135,0,0,1,269,285Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#f56954" d="M357.2277551949771,180.44625304313007A93.33333333333333,93.33333333333333,0,0,0,185.28484627831412,108.73398312817662" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#f56954" stroke="#ffffff" d="M360.06364732624417,181.4248826052307A96.33333333333333,96.33333333333333,0,0,0,182.59400205154566,107.40757544301087L143.42726941747117,88.10097469226493A140,140,0,0,1,401.3416327924656,195.6693795646951Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#00a65a" d="M185.28484627831412,108.73398312817662A93.33333333333333,93.33333333333333,0,0,0,268.97067846904883,243.333328727518" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#00a65a" stroke="#ffffff" d="M182.59400205154566,107.40757544301087A96.33333333333333,96.33333333333333,0,0,0,268.96973599126824,246.3333285794739L268.9575884998742,284.9999933380171A135,135,0,0,1,147.9120097954186,90.31165416754118Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="269" y="140" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1,0,0,1,0,0)"><tspan dy="140" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">In-Store Sales</tspan></text><text x="269" y="160" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1,0,0,1,0,0)"><tspan dy="160" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan></text></svg></div>
            </div>
            </div>
            <!-- /.nav-tabs-custom -->

            
    </div></section>
    @stop