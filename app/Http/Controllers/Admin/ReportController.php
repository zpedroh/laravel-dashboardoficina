<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Client;
use App\Models\ClientRecord;
use App\Models\ClientRecordItem;
use App\Models\ClientRecordService;
use App\Models\PaymentMethod;
use App\Models\Parcel;
use App\Models\Item;
use App\Models\Brand;
use App\Models\ItemStock;
use App\Models\Service;
use App\Models\Moviment;
use Carbon\carbon;
use App\Models\ProviderItem;
use App\Models\Provider;

class ReportController extends Controller
{
    protected $item;
    protected $item_stock;
    protected $brand;
    protected $category;
    protected $moviment;
    protected $clientrecord;
    protected $parcel;
    protected $client;
    protected $result;
    protected $provideritem;
    protected $provider;
    protected $service;
    protected $clientrecordservice;

    public function __construct(Item $item, ItemStock $item_stock, Brand $brand, Moviment $moviment, ClientRecord $clientrecord, Parcel $parcel, Client $client, Provider $provider, ProviderItem $provideritem, Service $service, Clientrecordservice $clientrecordservice)
    {
        $this->item          = $item;
        $this->item_stock    = $item_stock; 
        $this->brand         = $brand;
        $this->moviment      = $moviment;
        $this->clientrecord  = $clientrecord;
        $this->parcel        = $parcel;
        $this->client        = $client;
        $this->provider      = $provider;
        $this->provideritem  = $provideritem;
        $this->service       = $service;
        $this->clientrecordservice       = $clientrecordservice;
    } 

    public function bsellerReport()
    {        
        return view('admin.report.bestseller.bs');
    }

    public function bsellerGet(Request $request)
    {
        $item =  $this->item->all();

        $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
        $end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');
        
        foreach($item as $item)
        {
            $quantity = 0;

            $moviment = $this->moviment->all()->where('item_id', '=', $item->id)->where('mov_type', '=', 2);

            $brand = $this->brand->findOrFail($item->brand_id);

            foreach($moviment as $moviment)
            {
                if($moviment->created_at->format('Y-m-d') >= $request->date_start and $moviment->created_at->format('Y-m-d') <= $request->date_end)
                {
                    $quantity = $quantity + $moviment->quantity;
                }
            }

            $result[] = [
                'id'       => $item->id,
                'item'     => $item->name,
                'brand'    => $brand->name,
                'quantity' => $quantity
            ];
        }

        return view('admin.report.bestseller.bsresult', compact('result', 'start', 'end'));
    }

    public function bclientReport()
    {
        
        return view('admin.report.bestclient.bc');
    }

    public function bclientGet(Request $request)
    {
        $client =  $this->client->all();

       $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
       $end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');
        
        foreach($client as $client)
        {
            $quantity = 0;
            $value = 0;

            $clientrecord = $this->clientrecord->all()->where('client_id', '=', $client->id);

            foreach($clientrecord as $clientrecord)
            {
                if($clientrecord->created_at->format('Y-m-d') >= $request->date_start and $clientrecord->created_at->format('Y-m-d') <= $request->date_end)
                {
                    $value = $value + $clientrecord->record_total;
                    $quantity = $quantity + 1;
                }
            }

            $result[] = [
                'id'       => $client->id,
                'name'     => $client->name,
                'records'  => $quantity,
                'value'    => number_format($value, 2, '.', '')
            ];
        }

        return view('admin.report.bestclient.bcresult', compact('result', 'start', 'end'));
    }

    public function pitemReport()
    {   
        $provider = $this->provider->all();

        return view('admin.report.provideritem.pi', compact('provider'));
    }

    public function pitemGet(Request $request)
    {
        dd($request->all());

        $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
        $end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');


        return view('admin.report.bestclient.piresult', compact('provider'));      
    }   
    public function precordReport()
    {        
        $client =  $this->client->all();

        return view('admin.report.pendingrecord.pr', compact('client'));
    }

    public function precordGet(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
        $end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');

        $filter_status = $request->status;
        $filter_client = $request->clients;

        #dd($request->all(),$filter_client, $filter_status);

        $clientrecord = $this->clientrecord->all();

        foreach($clientrecord as $clientrecord)
        {
            if($clientrecord->created_at->format('Y-m-d') >= $request->date_start and $clientrecord->created_at->format('Y-m-d') <= $request->date_end)
            { 
                if(isset($request->clients))
                {
                    foreach($request->clients as $client)
                    {
                        if($clientrecord->client_id == $client)
                        {
                            if(isset($request->status))
                            {
                                foreach($request->status as $status)
                                {
                                    if($clientrecord->status == $status)
                                    {
                                        $client = $this->client->findOrFail($clientrecord->client_id);

                                        $result[] = [
                                            'id'           => $client->id,
                                            'name'         => $client->name,
                                            'record'       => $clientrecord->id,
                                            'status'       => $clientrecord->status,
                                            'record_total' => $clientrecord->record_total
                                        ]; 
                                    }                                
                                }
                            } 
                            else #status
                            {
                                #dd('oio');
                                $client = $this->client->findOrFail($clientrecord->client_id);
                                
                                $result[] = [
                                    'id'           => $client->id,
                                    'name'         => $client->name,
                                    'record'       => $clientrecord->id,
                                    'status'       => $clientrecord->status,
                                    'record_total' => $clientrecord->record_total
                                ]; 
                            }  
                        }                                         
                    }  
                }
                else #client
                {
                    if(isset($request->status))
                    {
                        #dd('status');
                        foreach($request->status as $status)
                        {
                            if($clientrecord->status == $status)
                            {
                                $client = $this->client->findOrFail($clientrecord->client_id);

                                $result[] = [
                                    'id'           => $client->id,
                                    'name'         => $client->name,
                                    'record'       => $clientrecord->id,
                                    'status'       => $clientrecord->status,
                                    'record_total' => $clientrecord->record_total
                                ]; 
                            }                                
                        }
                    } 
                    else #status
                    {
                        #dd('nada');
                        $client = $this->client->findOrFail($clientrecord->client_id);

                        $result[] = [
                            'id'           => $clientrecord->id,
                            'name'         => $client->name,
                            'record'       => $clientrecord->id,
                            'status'       => $clientrecord->status,
                            'record_total' => $clientrecord->record_total
                        ]; 
                    }  
                }
            }
        }
        #dd($filter_client);

        foreach($filter_client as $filter_client)
        {
            $client = $this->client->findOrFail($filter_client);

            $filtered_client[] = 
            [
                'client_id' => $client->id,
                'client_name' =>$client->name,
            ];
        }

        return view('admin.report.pendingrecord.prresult', compact('result', 'start', 'end', 'filter_status', 'filtered_client'));
        
    }

    public function cserviceReport()
    {        
        return view('admin.report.clientservices.cs');
    }

    public function cserviceGet(Request $request)
    {
        #dd($request->all());
        #$clientrecordservice = $this->clientrecordservice->all();
        $client =  $this->client->all();

        $service = $this->service->all();

        $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
        $end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');
        
        foreach($client as $client)
        {
            $clientrecord = $this->clientrecord->all()->where('client_id', '=', $client->id);
            
            if(isset($clientrecord))
            {
                foreach($service as $serv)
                {
                    $quantity = 0;     
                    $count = 0;          
    
                    foreach($clientrecord as $record)
                    {
                        #dd($record->created_at);
                        if($record->created_at->format('Y-m-d') >= $request->date_start and $record->created_at->format('Y-m-d') <= $request->date_end)
                        {
                            #dd($clientrecord);
                            $count = $this->clientrecordservice->get()->where('client_record_id', '=', $record->id)->where('service_id', '=', $serv->id)->sum('quantity');
    
                            $quantity = $quantity + $count;
                        }  
                        
                    }
                    #dd($quantity);
                    $result[] = [
    
                        'client_id'    => $client->id,
                        'client_name'  => $client->name,
                        'service_id'   => $serv->id,
                        'service_name' => $serv->name,
                        'quantity'     => $quantity
                    ];
                } 
            }
        }
        
        return view('admin.report.clientservices.csresult', compact('result', 'start', 'end'));
    }

    public function pserviceReport()
    {        
        return view('admin.report.pendingservices.ps');
    }

    public function pserviceGet(Request $request)
    {

        #dd('hi');

        $start = Carbon::createFromFormat('Y-m-d', $request->date_start)->format('d/m/Y');
        #$end = Carbon::createFromFormat('Y-m-d', $request->date_end)->format('d/m/Y');
        
        $clientrecord = $this->clientrecord->all()->where('prevision', '<=', $start)->where('conclusion', '=', null);

        foreach($clientrecord as $clientrecord)
        {
            $client = $this->client->findOrFail($clientrecord->client_id);

            $clientrecordservice = $this->all()->where('client_record_id', '=', $clientrecord->id);

            foreach($clientrecordservice as $clientrecordservice)
            {
                $service = $this->service->findOrFail($clientrecordservice->service_id);
                #Exibi: numero do pedido, nome do serviço, nome do cliente, e data de previsão
                $result[] = [

                    'client_record_id'  => $clientrecord->id,
                    'client_name'       => $client->name,
                    'service_name'      => $service->name,
                    'prevision'         => $clientrecord->prevision
                ];
            } 
        }

        return view('admin.report.pendingservices.psresult', compact('result', 'start'));
    }
}
