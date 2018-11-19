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

        return view('admin.provider.search', compact('provider'));        
    }    

    public function providersEdit($id)
    {        
        dd($id);
        $provider = $this->provider->find($id);
        return view('admin.provider.edit',compact('provider','id'));        
    }

    public function providersUpdate(Request $request, $id)
    {

        //dd($request->all());

        $provider = $this->provider->find($id);

        $adress = $this->adress->all()->where('provider_id','=', $provider->id)->first();

        $providerupdate = [
            'name' => $request->name,
            'cnpj'  => $request->cnpj
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

        $provider->update($providerupdate);        
        $provider->save();

        $adress->update($adressupdate);  
        $adress->save();
        
        return redirect('admin/provider/search');
    }

    public function providersDestroy($id)
    {
        $provider = $this->provider->find($id);
        $provider->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }   
}
