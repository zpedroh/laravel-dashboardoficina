<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Client;


class ClientController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function clientsRegister()
    {
        return view('admin.client.register');
    }

    public function clientsCreate(Request $request)
    {
        if($request->name != null)
        {
            $client = $this->client->create($request->all());

            return redirect()->route('clients.register')->with('success', 'Information has been added');  
        }    
                
              
    } 

    public function clientsGet()
    {
        $client = $this->client->all();

        return view('admin.client.search', compact('client'));        
    }

    /*
    

    public function brandsEdit($id)
    {        
        $brand = \App\Models\Brand::find($id);
        return view('admin.brand.edit',compact('brand','id'));        
    }

    public function brandsUpdate(Request $request, $id)
    {
        $brand= \App\Models\Brand::find($id);
        $brand->name=$request->get('name');        
        $brand->save();
        return redirect('admin/home');
    }

    public function brandsDestroy($id)
    {
        $brand = \App\Models\Brand::find($id);
        $brand->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }
    */
}
