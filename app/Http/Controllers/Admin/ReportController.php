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

class ReportController extends Controller
{
    protected $item;
    protected $item_stock;
    protected $brand;
    protected $categories;
    protected $moviments;
    protected $clientrecords;
    protected $parcels;
    protected $clients;
    protected $result;

    public function __construct(Item $item, ItemStock $item_stock, Brand $brand, Moviment $moviments, ClientRecord $clientrecords, Parcel $parcels, Client $clients)
    {
        $this->item          = $item;
        $this->item_stock    = $item_stock; 
        $this->brand         = $brand;
        $this->moviment      = $moviments;
        $this->clientrecord  = $clientrecords;
        $this->parcel        = $parcels;
        $this->client        = $clients;
    } 

    public function bsellerReport()
    {        
        return view('admin.report.bestseller.bestseller');
    }

    public function bsellerGet(Request $request)
    {
        $item =  $this->item->all();
        
        foreach($item as $item)
        {
            $quantity = 0;

            $moviments = $this->moviment->all()->where('item_id', '=', $item->id)->where('mov_type', '=', 2);

            $brand = $this->brand->findOrFail($item->brand_id);

            foreach($moviments as $moviment)
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

        return view('admin.report.bestseller.bestsellerresult', compact('result'));
    }

    public function bclientReport()
    {
        
        return view('admin.report.bestclient.bestclient');
    }

    public function bclientGet(Request $request)
    {
        $clients =  $this->client->all();
        
        foreach($clients as $client)
        {
            $quantity = 0;
            $value = 0;

            $clientrecords = $this->clientrecord->all()->where('client_id', '=', $client->id);

            ///$brand = $this->brand->findOrFail($item->brand_id);

            foreach($clientrecords as $clientrecord)
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

        return view('admin.report.bestclient.bestclientresult', compact('result'));
    }
}
