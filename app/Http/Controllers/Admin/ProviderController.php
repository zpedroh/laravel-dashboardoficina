<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Item;
use App\Models\Adress;
use DB;

class ProviderController extends Controller
{

    protected $provider;
    protected $adress;

    public function __construct(Provider $provider, Adress $adress)
    {
        $this->provider = $provider;
        $this->adress = $adress;
    }

    public function providersRegister()
    {
        return view('admin.provider.register');
    }

    public function providersCreate(Request $request)
    {
        if($request->name != null)
        {
            $newprovider = [
                'name'  => $request->name,
                'cnpj'  => $request->cnpj
            ];

            $provider = $this->provider->create($newprovider);
            								
            $provideradress = [
                'provider_id' => $provider->id,
                'complement'  => $request->country,
                'state'       => $request->state,
                'zipcode'     => $request->zipcode,
                'city'        => $request->city,
                'district'    => $request->district,
                'street'      => $request->street,
                'number'      => $request->number            
            ];

            $adress = $this->adress->create($provideradress);

            return redirect()->route('providers.search');  
        }  
    } 

    public function providersGet()
    {
        $provider = $this->provider->all();

        return view('admin.provider.search');        
    }    

    public function providersEdit($id)
    {        
        $provider = $this->provider->find($id);
        return view('admin.provider.edit',compact('provider','id'));        
    }

    public function providersUpdate(Request $request, $id)
    {
        $provider = $this->provider->find($id);
        $provider->name = $request->get('name');        
        $provider->save();
        return redirect('admin/home');
    }

    public function providersDestroy($id)
    {
        $provider = $this->provider->find($id);
        $provider->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }   
}
