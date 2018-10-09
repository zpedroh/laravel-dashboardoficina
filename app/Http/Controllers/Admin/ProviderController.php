<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Provider;
use App\Models\Item;
use DB;

class ProviderController extends Controller
{

    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }
    /*protected $provider;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function providersRegister()
    {
        return view('admin.client.register');
    }
    
    public function providersCreate(Request $request)
    {
        if($request->name != null)
        {
            $client = $this->client->create($request->all());

            return redirect()->route('providers.register')->with('success', 'Information has been added');  
        }  
    } 
    */
    public function providersGet()
    {
        //$client = $this->client->all();

        return view('admin.provider.search', compact('client'));        
    }    

    public function providersEdit()
    {        
        //$client = $this->client->find($id);

        $item = $this->item->all();
        
        return view('admin.provider.edit',compact('item'));       
    }
/*,compact('provider','id')
    public function providersUpdate(Request $request, $id)
    {
        $provider = $this->provider->find($id);
        $provider->name = $request->get('name');        
        $provider->save();
        return redirect('admin/provider/search');
    }

    public function providersDestroy($id)
    {
        $provider = $this->provider->find($id);
        $provider->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    } */  
}
