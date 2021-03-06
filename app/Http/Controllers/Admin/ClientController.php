<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Client;
use App\Models\Adress;
use App\Models\Item;
use App\Models\Service;
use App\Models\PaymentMethod;  
use App\Models\ClientRecord;

class ClientController extends Controller
{
    protected $client;
    protected $adress;
    protected $items;
    protected $services;
    protected $paymentmethod;
    protected $clientrecord;
    

    public function __construct(Client $client, Adress $adress, Item $items, Service $services, PaymentMethod $paymentmethod, ClientRecord $clientrecord)
    {
        $this->client = $client;
        $this->adress = $adress;
        $this->item = $items;
        $this->service = $services;
        $this->paymentmethod = $paymentmethod;
        $this->clientrecord         = $clientrecord;
    }

    public function clientsRegister()
    {
        return view('admin.client.register');
    }

    public function clientsCreate(Request $request)
    {

        //  dd($request->all());

        if($request->name != null)
        {
            $newclient = [
                'name' => $request->name,
                'cpf'  => $request->cpf,
                'telephone' => $request->telephone
            ];

            $client = $this->client->create($newclient);
            								
            $clientadress = [
                'client_id'   => $client->id,
                'complement'  => $request->complement,
                'state'       => $request->state,
                'zipcode'     => $request->zipcode,
                'city'        => $request->city,
                'district'    => $request->district,
                'street'      => $request->street,
                'number'      => $request->number     
            ];

            $adress = $this->adress->create($clientadress);

            $notification = array(
                'message' => 'Cliente Registrado!' , 
                'alert-type' => 'success'
            );


            if($request->client_register_record == '2')
            {
                $client        = $this->client->all();
                $items         = $this->item->all();
                $services      = $this->service->all();
                $paymentmethod = $this->paymentmethod->all();
        
                return redirect()->route('records.register', compact('client', 'items', 'services', 'paymentmethod'))->with($notification);
            }
            else
            {
                return redirect()->route('clients.search')->with($notification);
            }
              
        }  
    } 

    public function clientsGet()
    {
        $client = $this->client->all();
        
        return view('admin.client.search', compact('client'));        
    }    

    public function clientsEdit($id)
    {        
        $client = $this->client->find($id);

        return view('admin.client.edit',compact('client','id'));        
    }

    public function clientsUpdate(Request $request, $id)
    {
        $client = $this->client->find($id);

        $adress = $this->adress->all()->where('client_id','=', $client->id)->first();

        $clientupdate = [
            'name' => $request->name,
            'cpf'  => $request->cpf,
            'telephone'  => $request->telephone
        ];

        $adressupdate = [
            'complement'  => $request->complement,
            'state'       => $request->state,
            'zipcode'     => $request->zipcode,
            'city'        => $request->city,
            'district'    => $request->district,
            'street'      => $request->street,
            'number'      => $request->number            
        ];

        $client->update($clientupdate);        
        $client->save();

        $adress->update($adressupdate);  
        $adress->save();

        $notification = array(
            'message' => 'Cliente Atualizado!' , 
            'alert-type' => 'success'
        );
        
        return redirect('admin/client/search')->with($notification);
    }

    public function clientsDestroy($id)
    {
        $client = $this->client->find($id);
        

        $verif = $this->clientrecord->get()->where('client_id', '=', $client->id)->first();

        if($verif)
        {
            $notification = array(
                'message' => 'Cliente em uso!' , 
                'alert-type' => 'error'
            );
        }
        else
        {
            $client->delete();

            $notification = array(
                'message' => 'Cliente Deletada!' , 
                'alert-type' => 'success'
            );    
        } 
        
        return redirect('admin/client/search')->with($notification);
    }   
}
