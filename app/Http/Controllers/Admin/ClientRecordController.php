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
use App\Models\ItemStock;
use App\Models\Service;
use App\Models\Moviment;
use Carbon\carbon;

class ClientRecordController extends Controller
{
    protected $client;
    protected $items;
    protected $itemstock;
    protected $services;
    protected $clientrecord;
    protected $clientrecorditem;
    protected $clientrecordservice;
    protected $paymentmethod;
    protected $parcel;
    protected $moviments;

    public function __construct(Client $client, ClientRecord $clientrecord, ClientRecordItem $clientrecorditem, ClientRecordService $clientrecordservice, Item $items, ItemStock $itemstock, Service $services, PaymentMethod $paymentmethod, Parcel $parcel, Moviment $moviments)
    {
        $this->client               = $client;
        $this->clientrecord         = $clientrecord;
        $this->clientrecorditem     = $clientrecorditem;
        $this->clientrecordservice  = $clientrecordservice;
        $this->item                 = $items;
        $this->itemstock            = $itemstock;
        $this->service              = $services;
        $this->paymentmethod        = $paymentmethod;
        $this->parcel               = $parcel;
        $this->moviment             = $moviments;
    }

    public function recordsRegister()
    {
        $client        = $this->client->all();
        $items         = $this->item->all();
        $services      = $this->service->all();
        $paymentmethod = $this->paymentmethod->all();

        return view('admin.record.register', compact('client', 'items', 'services', 'paymentmethod'));
    }

    public function recordsCreate(Request $request)
    {
        $record = [

            'client_id'     => $request->client_id,
            'user_id'       => $request->user_id,
            'record_total'  => "0",
            'status'        => $request->status_id
        ];

        $clientrecord = $this->clientrecord->create($record);

        $totalRecord = 0;

        //adicionando itens da nota

        if($request->item_id <> '')
        {
            foreach ($request->item_id as $key => $item)
            {
                $items     = $this->item->findOrFail($item);
                $itemstock = $this->itemstock->where('item_id','=', $items->id)->first();

                $dataitem = [
                    'item_id'          => $items->id,
                    'client_record_id' => $clientrecord->id,
                    'quantity'         => $request->item_quantity[$key],
                    'item_total'       => $request->item_quantity[$key] * $items->price
                ];

                $totalRecord = $totalRecord + ($request->item_quantity[$key] * $items->price);

                $clientrecorditem = $this->clientrecorditem->create($dataitem);

                if($request->status_id > 1)
                {

                    $itemstock->quantity = $itemstock->quantity - $request->item_quantity[$key];

                    $itemstock->save();

                    $movimentCreate = [
                        'mov_type' => 2,
                        'client_record_item_id' => $clientrecorditem->id,
                        'item_id'  => $clientrecorditem->item_id,
                        'quantity' => $clientrecorditem->quantity
                    ];
                    
                    //Cria saida de estoque se a nota estiver fechada ou paga
                    $moviments = $this->moviment->create($movimentCreate);
                }
            }
        }
        //Adicionando serviços da nota
        if($request->service_id <> '')
        { 
            foreach ($request->service_id as $key => $service)
            {
                $services = $this->service->findOrFail($service);

                $dataservice = [
                    'service_id'       => $service,
                    'client_record_id' => $clientrecord->id,
                    'quantity'         => $request->service_quantity[$key],
                    'service_total'    => $request->service_quantity[$key] * $services->price
                ];

                $totalRecord = $totalRecord + ($request->service_quantity[$key] * $services->price);

                $clientrecordservice = $this->clientrecordservice->create($dataservice);
            }
        }
        //Atualiza total da nota

        $clientrecord->record_total = $totalRecord;
        $clientrecord->save();

        $paymentmethod = $this->paymentmethod->findOrFail($request->paymentmethod_id);

        $x = 1;

        while( $x <= $paymentmethod->parcel)
        {
            
            $date = date('d-m-y');

            $parceldate = date('dmy', strtotime($date.' + '.($paymentmethod->period * $x).'days'));

            $parcelData = [
                'client_record_id'  => $clientrecord->id,
                'payment_method_id' => $paymentmethod->id,
                'status'            => $request->status_id,
                'value'             => $totalRecord / $paymentmethod->parcel,
                'date'              => $parceldate,
                'number'            => $x                          
            ];

            $parcel = $this->parcel->create($parcelData);

            $x = $x + 1;
        };

        return redirect('admin/home');
    } 

    public function recordsGet()
    {
        $clientrecord        = $this->clientrecord->all();
        $client              = $this->client->all();
        $clientrecorditem    = $this->clientrecorditem->all();//->where('client_record_id','=','id');
        $clientrecordservice = $this->clientrecordservice->all();//->where('client_record_id','=','id');
        
        return view('admin.record.search', compact('clientrecord', 'client', 'clientrecorditem', 'clientrecordservice'));        
    }

    public function recordsEdit($id)
    {        
        $clientrecord = $this->clientrecord->findOrFail($id);

        return view('admin.record.edit',compact('clientrecord'));        
    }

    public function contentsUpdate($id)
    {        
        $clientrecord = $this->clientrecord->findOrFail($id);

        return view('admin.record.edit',compact('clientrecord'));        
    }

    public function recordsUpdate(Request $request, $id)
    {
        $clientrecord = $this->clientrecord->findOrFail($id);

        $clientrecorditem = $this->clientrecorditem->findOrFail()->where('clientrecorditem->client_record_id', '=', $clientrecord->id);
        $clientrecordservice = $this->clientrecordservice->findOrFail()->where('clientrecordservice->client_record_id', '=', $clientrecord->id);

        while($clientrecorditem <> '' or $clientrecordservice <> '')
        {   
            if($clientrecorditem <> '')
            {
                $clientrecorditem->delete();
            }
            if($clientrecordservice <> '')
            {
                $clientrecordservice->delete();
            }
            
            $clientrecorditem = $this->clientrecorditem->findOrFail()->where('clientrecorditem->client_record_id', '=', $clientrecord->id);
            $clientrecordservice = $this->clientrecordservice->findOrFail()->where('clientrecordservice->client_record_id', '=', $clientrecord->id);
        };

           
        $clientrecord->save();
        return redirect('admin/home');
    }

    public function recordsDestroy($id)
    {
        
        $record = $this->clientrecord->findOrFail($id);
        $record->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }

    public function getProduct($product_id, $amount)
    {
        $item = $this->item->findOrFail($product_id);

        $data = [
            'id'          => $item->id,
            'name'        => $item->name,
            'price'       => $item->price,
            'total_price' => $item->price * $amount,
            'quantity'    => $amount
        ];
        
        return response()->json($data, 200);
    }

    public function getService($service_id, $amount)
    {
        $service = $this->service->findOrFail($service_id);

        $data = [
            'id'          => $service->id,
            'name'        => $service->name,
            'price'       => $service->price,
            'total_price' => $service->price * $amount,
            'quantity'    => $amount
        ];
        
        return response()->json($data, 200);
    }

    public function getClient($client_id)
    {
        $client = $this->client->findOrFail($client_id);

        $data = [
            'name' => $client->name,
            'cpf'  => $client->cpf,
            'tel'  => '00'//$client->telephone
        ];
        
        return response()->json($data, 200);
    }
}


/*
    public function recorditemsCreate(Request $request)
    {
    
        $item = $this->item->find($request->item_id);

        $recorditem = [
            'item_id'              => $request->item_id,
            'client_record_id'     => $request->clientrecord_id,
            'quantity'             => $request->quantity_item,
            'item_total'           => $request->quantity_item*$item->price
        ];
        
        $clientrecorditem = $this->clientrecorditem->create($recorditem);


        $clientrecord = $this->clientrecord->find($request->clientrecord_id);

        $items = $this->item->orderBy('name', 'asc')->get();
        $services = $this->service->orderBy('name', 'asc')->get();
        
        return view('admin.recorditens.register', compact('clientrecord', 'items', 'services'));
        
        //return redirect()->route('items.home')->with('success', 'Information has been added');      
    }

    public function recordservicesCreate(Request $request)
    {

        $service = $this->service->find($request->service_id);

        $recordservice = [
            'service_id'           => $request->service_id,
            'client_record_id'     => $request->clientrecord_id,
            'quantity'             => $request->quantity_service,
            'service_total'        => $request->quantity_service*$service->price
        ];

        $clientrecordservice = $this->clientrecordservice->create($recordservice);

        $clientrecord = $this->clientrecord->find($request->clientrecord_id);

        $items = $this->item->orderBy('name', 'asc')->get();
        $services = $this->service->orderBy('name', 'asc')->get();
        
        return view('admin.recorditens.register', compact('clientrecord', 'items', 'services'));
        
        //return redirect()->route('admin.recorditens.register')->with('success', 'Information has been added');      
    }
*/