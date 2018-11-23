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
                        'client_record_id' => $clientrecord->id,
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

        $discount = str_replace('R$ ', '', $request->get('discount'));
        
        $clientrecord->record_total = $totalRecord - $discount;
        $clientrecord->save();

        $paymentmethod = $this->paymentmethod->findOrFail($request->paymentmethod_id);

        $x = 1;

        while( $x <= $paymentmethod->parcel)
        {
            
            $parceldate = Carbon::now()->addDays($paymentmethod->period * $x);

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
        $clientrecord = $this->clientrecord->all()->where('status', '<', 3);
        
        return view('admin.record.search', compact('clientrecord'));        
    }

    public function recordsEdit($id)
    {        
        $clientrecord = $this->clientrecord->findOrFail($id);

        $items         = $this->item->all();
        $services      = $this->service->all();
        $paymentmethod = $this->paymentmethod->all();

        return view('admin.record.edit',compact('clientrecord', 'items', 'services', 'paymentmethod'));        
    }

    public function recordsUpdate(Request $request, $id)
    {        
        $clientrecord = $this->clientrecord->findOrFail($id);

        $totalRecord = 0;

        $clientrecorditem = $this->clientrecorditem->get()->where('client_record_id', '=', $clientrecord->id)->first();
        $clientrecordservice = $this->clientrecordservice->get()->where('client_record_id', '=', $clientrecord->id)->first();

        //Limpa Itens e Serviços da nota
        while($clientrecorditem <> null or $clientrecordservice <> null)
        {  

            if($clientrecorditem <> null)
            {
                $clientrecorditem->delete();
            }
            if($clientrecordservice <> null)
            {
                $clientrecordservice->delete();
            }
            
            $clientrecorditem = $this->clientrecorditem->get()->where('clientrecorditem->client_record_id', '=', $clientrecord->id)->first();
            $clientrecordservice = $this->clientrecordservice->get()->where('clientrecordservice->client_record_id', '=', $clientrecord->id)->first();
        };

        $moviments = $this->moviment->get()->where('client_record_id', '=', $clientrecord->id)->first();
        $parcel = $this->parcel->get()->where('client_record_id', '=', $clientrecord->id)->first();

        //Limpa Parcelas e Movimentos da Nota
        while($moviments <> null or $parcel <> null)
        {
            
            if($moviments <> null)
            {
                $moviments->delete();
            }
            if($parcel <> null)
            {
                $parcel->delete();
            }           
            $moviments = $this->moviment->get()->where('client_record_id', '=', $clientrecord->id)->first();
            $parcel = $this->parcel->get()->where('client_record_id', '=', $clientrecord->id)->first();            
        }

        //Recria o conteudo da nota com todas as suas funçoes

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
                        'client_record_id' => $clientrecord->id,
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
            $parceldate = Carbon::now()->addDays($paymentmethod->period * $x);

            //$parceldate = $parceldate->add($paymentmethod->period,'day');

            
            
            //date('dmy', strtotime($date.' + '.($paymentmethod->period * $x).'days'));$date = date('d-m-y');

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

        return redirect(route('records.edit', $clientrecord->id));        
    }

    public function statusUpdate()
    {
        

    }

    public function parcelsCreate(Request $request)
    {
        $number = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->count();

        $value = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->sum('value');

        $quantity = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->count();

        $parcelData = [
            'client_record_id'  => $request->record_id,
            'number'            => $number + 1,
            'value'             => ($value / $quantity) - ($request->value / $quantity),
            'date'              => $request->date,
            'payment_method_id' => $request->paymentmethod_id,
            'duedate'           => 1,
            'period'            => 1,
            'status'            => $request->status
        ];

        $parcel = $this->parcel->get()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->first();

        while($parcel <> null)
        {
            $parcel->value = ($value / $quantity) - ($request->value / $quantity);
            $parcel->save();

            $parcel = $this->parcel->get()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->first();
        }

        $parcel = $this->parcel->create($parcelData);
    }

    public function parcelsUpdate(Request $request, $id)
    {
        $parcel = $this->parcel->findOrFail($id);

        $parcelupdate = [
            'status'             => $request->status,
            'date'               => $request->date,
            'payment_method_id'  => $request->paymentmethod_id
        ];

        $parcel->update($parcelupdate);
        $parcel->save();

        return redirect('admin/home')->with('Okay');

    }

    public function parcelsDestroy($id)
    {
        $value = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->count('value');
        
        $quantity = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->count();
        
        $parcel = $this->parcel->get()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->first();

        while($parcel <> null)
        {
            $parcel->value = $value / $quantity;
            $parcel->save();
        }

        $parcel = $this->parcel->findOrFail($id);

        $parcel->delete();

        return redirect('record/search');
    }

/*
    public function recordsUpdate(Request $request, $id)
    {

        $clientrecord = $this->clientrecord->findOrFail($id);
           
        $clientrecord->save();
        return redirect('admin/home');
    }
*/
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

    public function getProduct2($record_id,$product_id, $amount)
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

    public function getService2($record_id,$service_id, $amount)
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
            'tel'  => $client->telephone
        ];
        
        return response()->json($data, 200);
    }
}


/*

    public function contentGet($id)
    {
        $clientrecorditem = $this->clientrecorditem->where('clientrecorditem->client_record_id', '=', $id)->all();
        
        dd($clientrecorditem);

        return compact('id', 'clientrecorditem');
    }


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