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


    #Records
    

    public function recordPrint($id)
    {
        $clientrecord = $this->clientrecord->findOrFail($id);

        return view('admin.record.print', compact('clientrecord'));
    }

    public function recordsGet()
    {
        $clientrecord = $this->clientrecord->all()->where('status', '<', 3);
        
        return view('admin.record.search', compact('clientrecord'));        
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
        $discount = str_replace('R$ ', '', $request->get('discount'));

        if($discount == null)
        {
            $discount = 0;
        }
        
        $record = [

            'client_id'     => $request->client_id,
            'user_id'       => $request->user_id,
            'record_total'  => "0",
            'status'        => $request->status_id,
            'discount'      => $discount
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
                        'item_id'          => $clientrecorditem->item_id,
                        'quantity'         => $clientrecorditem->quantity
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
                'number'            => $x,
                'parcel_number'     => $paymentmethod->parcel                          
            ];

            $parcel = $this->parcel->create($parcelData);

            $x = $x + 1;
        };

        $notification = array(
            'message' => 'Pedido Criado!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/home')->with($notification);
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
                        'item_id'          => $clientrecorditem->item_id,
                        'quantity'         => $clientrecorditem->quantity
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

            $parcelData = [
                'client_record_id'  => $clientrecord->id,
                'payment_method_id' => $paymentmethod->id,
                'status'            => $request->status_id,
                'value'             => $totalRecord / $paymentmethod->parcel,
                'date'              => $parceldate,
                'number'            => $x,
                'parcel_number'     => $paymentmethod->parcel                          
            ];

            $parcel = $this->parcel->create($parcelData);

            $x = $x + 1;
        };

        $notification = array(
            'message' => 'Pedido Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect(route('records.search'))->with($notification);

        //return redirect(route('records.edit', $clientrecord->id));        
    }

    public function statusUpdate($id, $status)
    {
        //dd($id, $status);
        $clientrecord = $this->clientrecord->findOrFail($id);
       
        $parcel = $this->parcel->all()->where('client_record_id', '=', $clientrecord->id);

        foreach($parcel as $parcel)
        {
            $parcel->status = $status;

            $parcel->save();
        }

        if($status == 3)
        {
            $clientrecorditem = $this->clientrecorditem->all()->where('client_record_id', '=', $clientrecord->id)->where('status', '<>', $status);

            foreach($clientrecorditem as $ritem)
            {
                $movimentCreate = [
                    'mov_type' => 2,
                    'client_record_id' => $clientrecord->id,
                    'item_id'          => $ritem->item_id,
                    'quantity'         => $ritem->quantity
                ];

                $moviments = $this->moviment->create($movimentCreate);

                $itemstock = $this->itemstock->get()->where('item_id', '=', $ritem->item_id)->first();
                $itemstock->quantity = $itemstock->quantity - $ritem->quantity;
                $itemstock->save();
            }
        }
        else
        {

        }

        $clientrecord->status = $status;
        $clientrecord->save();

        $notification = array(
            'message' => 'Status do Pedido Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect(route('records.search'))->with($notification);
    }

    public function recordsDestroy($id)
    {
        
        $clientrecord = $this->clientrecord->findOrFail($id);

        if($clientrecord->status < 3)
        {
            $record->delete();
            return redirect('admin/home')->with('success','Information has been  deleted');
        }
        else
        {
            return redirect('admin/home')->with('success','Information has been  deleted');
        }
    }


    #Parcels


    public function parcelsCreate(Request $request)
    {
        $number = $this->parcel->orderBy('id', 'desc')->where('client_record_id', '=', $request->record_id)->get()->first();

        $value = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->sum('value');

        $quantity = $this->parcel->all()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->count();

        $paymentmethod = $this->paymentmethod->findOrFail($request->paymentmethod_id);

        $newValue = ($value - $request->value) / $quantity;

        $parcelData = [
            'client_record_id'  => $request->record_id,
            'number'            => $number->parcel_number + 1,
            'value'             => $request->value,
            'date'              => $request->date,
            'payment_method_id' => $request->paymentmethod_id,
            //'duedate'           => $paymentmethod->duedate,
            'period'            => $paymentmethod->period,
            'status'            => $request->status,
            'parcel_number'     => $number->parcel_number + 1
        ];

        $parcel = $this->parcel->get()->where('client_record_id', '=', $request->record_id)->where('status', '<', 3)->first();

        while($parcel <> null)
        {
            $parcel->value = $newValue;
            $parcel->save();

            $parcel = $this->parcel->get()->where('id', '=', $parcel->id + 1)->where('status', '<', 3)->first();
        }

        $parcel = $this->parcel->create($parcelData);

        return redirect(route('records.edit', $parcel->client_record_id));
    }

    public function parcelsUpdate(Request $request, $id)
    {
        $parcel = $this->parcel->findOrFail($id);

        $parcelupdate = [
            'status' => $request->status,
            'date'   => $request->date
        ];

        $parcel->update($parcelupdate);
        $parcel->save();        

        return redirect('admin/home')->with('Okay');
    }

    public function parcelsDestroy($id)
    {
        $record = $this->parcel->findOrFail($id);

        $number = $this->parcel->orderBy('id', 'desc')->where('client_record_id', '=', $record->client_record_id)->get()->first();

        $value = $this->parcel->all()->where('client_record_id', '=', $record->client_record_id)->where('status', '<', 3)->sum('value');

        $quantity = $this->parcel->all()->where('client_record_id', '=', $record->client_record_id)->where('status', '<', 3)->count();

        $newValue = ($value) / ($quantity - 1);

        #dd($newValue,$value);

        $parcel = $this->parcel->get()->where('client_record_id', '=', $record->client_record_id)->where('status', '<', 3)->first();

        while($parcel <> null)
        {
            $parcel->value = $newValue;
            $parcel->save();

            $parcel = $this->parcel->get()->where('id', '=', $parcel->id + 1)->where('status', '<', 3)->first();
        }

        $parcel = $this->parcel->findOrFail($id);

        $parcel->delete();

        return redirect('record/search');
    }


    #Gets


    public function getProduct($product_id, $amount)
    {
        $item = $this->item->findOrFail($product_id);

        $itemstock = $this->itemstock->get()->where('item_id', '=', $item->id)->first();

        $data = [
            'id'          => $item->id,
            'name'        => $item->name,
            'price'       => $item->price,
            'total_price' => $item->price * $amount,
            'quantity'    => $amount,
            'stock'       => $itemstock->quantity
        ];
        
        return response()->json($data, 200);
    }

    public function getProduct2($record_id,$product_id, $amount)
    {
        $item = $this->item->findOrFail($product_id);
        $itemstock = $this->itemstock->get()->where('item_id', '=', $item->id)->first();

        $data = [
            'id'          => $item->id,
            'name'        => $item->name,
            'price'       => $item->price,
            'total_price' => $item->price * $amount,
            'quantity'    => $amount,
            'stock'       => $itemstock->quantity
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
            'id'   => $client->id,
            'name' => $client->name,
            'cpf'  => $client->cpf,
            'tel'  => $client->telephone
        ];
        
        return response()->json($data, 200);
    }
}