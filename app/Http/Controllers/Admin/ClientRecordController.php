<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Client;
use App\Models\ClientRecord;
use App\Models\ClientRecordItem;
use App\Models\ClientRecordService;
use App\Models\Item;
use App\Models\Service;

class ClientRecordController extends Controller
{
    protected $client;
    protected $items;
    protected $services;
    protected $clientrecord;
    protected $clientrecorditem;
    protected $clientrecordservice;

    public function __construct(Client $client, ClientRecord $clientrecord, ClientRecordItem $clientrecorditem, ClientRecordService $clientrecordservice, Item $items, Service $services)
    {
        $this->client = $client;
        $this->clientrecord = $clientrecord;
        $this->clientrecorditem = $clientrecorditem;
        $this->clientrecordservice = $clientrecordservice;
        $this->item = $items;
        $this->service = $services;
    }

    public function recordsRegister()
    {
        $client = $this->client->all();

        return view('admin.record.register', compact('client'));
    }

    public function recordsCreate(Request $request)
    {
        $record = [

            'client_id'     => $request->client_id,
            //'user_id'       => "2",
            'record_total'  => "0",
            'status'        => "1",
            'plaque'        => "",
        ];
       
        $clientrecord = $this->clientrecord->create($record);

        $items = $this->item->orderBy('name', 'asc')->get();
        $services = $this->service->orderBy('name', 'asc')->get();
        
        return view('admin.recorditens.register', compact('clientrecord', 'items', 'services'));

        //return redirect()->route('recorditems.register')->with(compact('clientrecord'));      
    } 

    public function recordsGet()
    {
        $clientrecord        = $this->clientrecord->all();
        $client              = $this->client->all();
        //$clientrecorditem    = $this->clientrecorditem->all()->where('client_record_id','=','id');
        //$clientrecordservice = $this->clientrecordservice->all()->where('client_record_id','=','id');
        
        return view('admin.record.search', compact('clientrecord', 'client', 'clientrecorditem', 'clientrecordservice'));        
    }

    public function recordsEdit($id)
    {        
        $record = $this->record->find($id);
        return view('admin.record.edit',compact('record','id'));        
    }

    public function recordsUpdate(Request $request, $id)
    {
        $record = $this->record->find($id);
        $record->name = $request->get('name');        
        $record->save();
        return redirect('admin/home');
    }

    /*
    public function recordsDestroy($id)
    {
        $record = $this->record->find($id);
        $record->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }
    */






/*
    
    public function recorditemsRegister(Request $request)
    {
        dd($request->id);
        $items = $this->item->orderBy('name', 'asc')->get();
        $services = $this->service->orderBy('name', 'asc')->get();
        
        return view('admin.recorditens.register', compact('clientrecord', 'items', 'services'));
    }
*/


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
        
        //return redirect()->route('items.home')->with('success', 'Information has been added');      
    }
}
