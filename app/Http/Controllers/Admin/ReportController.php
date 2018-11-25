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

    public function __construct(Item $item, ItemStock $item_stock, Brand $brand, Moviment $moviment, ClientRecord $clientrecord, Parcel $parcel, Client $client, Provider $provider, ProviderItem $provideritem)
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
    } 

    public function bsellerReport()
    {        
        return view('admin.report.bestseller.bs');
    }

    public function bsellerGet(Request $request)
    {
        $item =  $this->item->all();
        
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

        return view('admin.report.bestseller.bsresult', compact('result'));
    }

    public function bclientReport()
    {
        
        return view('admin.report.bestclient.bc');
    }

    public function bclientGet(Request $request)
    {
        $client =  $this->client->all();
        
        foreach($client as $client)
        {
            $quantity = 0;
            $value = 0;

            $clientrecord = $this->clientrecord->all()->where('client_id', '=', $client->id);

            ///$brand = $this->brand->findOrFail($item->brand_id);

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
                'value'    => $value
            ];
        }

        return view('admin.report.bestclient.bcresult', compact('result'));
    }

    public function pitemReport()
    {   
        $provider = $this->provider->all();

        return view('admin.report.provideritem.pi', compact('provider'));
    }

    public function pitemGet(Request $request)
    {
        dd($request->all());


        return view('admin.report.bestclient.piresult', compact('provider'));      
    }   
    public function precordReport()
    {        
        return view('admin.report.pendingrecord.pr');
    }

    public function precordGet(Request $request)
    {
        $client =  $this->client->all();
        
        foreach($client as $client)
        {
            $clientrecord = $this->clientrecord->all()->where('client_id', '=', $client->id)->where('status', '<', 3);

            foreach($clientrecord as $clientrecord)
            {
                if($clientrecord->created_at->format('Y-m-d') >= $request->date_start and $clientrecord->created_at->format('Y-m-d') <= $request->date_end)
                {                        
                    $result[] = [
                        'id'           => $client->id,
                        'name'         => $client->name,
                        'record'       => $clientrecord->id,
                        'record_total' => $clientrecord->record_total
                    ];   
                }
            }   
        }
        return view('admin.report.pendingrecord.prresult', compact('result'));
    }
}
