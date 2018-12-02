<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Item;
use App\Models\Adress;
use App\Models\ProviderItem;
use DB;

class ProviderController extends Controller
{

    protected $provider;
    protected $adress;
    protected $items;
    protected $provideritem;

    public function __construct(Provider $provider, ProviderItem $provideritem, Adress $adress, Item $items)
    {
        $this->provider = $provider;
        $this->adress = $adress;
        $this->item = $items;
        $this->provideritem = $provideritem;
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
                'cnpj'  => $request->cnpj,
                'telephone' => $request->telephone
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

            $notification = array(
                'message' => 'Fornecedor Registrado!' , 
                'alert-type' => 'success'
            );

            return redirect()->route('providers.search')->with($notification);  
        }  
    } 

    public function providersGet()
    {
        $provider = $this->provider->all();

        return view('admin.provider.search', compact('provider'));        
    }    

    public function providersEdit($id)
    {        
        $provider = $this->provider->find($id);
        $items    = $this->item->all();
        return view('admin.provider.edit',compact('provider','items'));        
    }

    public function providersUpdate(Request $request, $id)
    {
        $provider = $this->provider->find($id);

        $adress = $this->adress->get()->where('edit_provider_id','=', $provider->id)->first();

        $providerupdate = [
            'name'      => $request->name,
            'cnpj'      => $request->cnpj,
            'telephone' => $request->telephone
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
/*
        if(isset($request->seller))
        {
            foreach($request->item_id as $key => $item)
            {
                if($request->seller = 'on')
                {
                    $item_seller = [
                        'item_id'     => $item,
                        'value'       => $request->value_provider[$key], 
                        'provider_id' => $provider->id
                    ];

                    $provideritem = $this->provideritem->get()->where('provideritem->item_id', '=', $item)->where('provideritem->provider_id', '=', $provider->id)->first();
                    
                    if(isset($provideritem))
                    {
                        $provideritem = $this->provideritem->update($item_seller);
                        $provideritem->save();
                    }

                    else
                    {
                        $provideritem = $this->provideritem->create($item_seller);
                    }
                }    
            };
        };
*/
        $notification = array(
            'message' => 'Fornecedor Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/provider/search')->with($notification);
    }    

    public function providersDestroy($id)
    {
        $provider = $this->provider->find($id);        

        $verif = $this->provideritem->get()->where('provider_id', '=', $provider->id)->first();

        if($verif)
        {
            $notification = array(
                'message' => 'Fornecedor em uso!' , 
                'alert-type' => 'error'
            );
        }
        else
        {
            $provider->delete();

            $notification = array(
                'message' => 'Fornecedor Deletado!' , 
                'alert-type' => 'success'
            );
        } 
        
        return redirect('admin/provider/search')->with($notification);
    }   

    public function pitemsCreate(Request $request)
    {
        $provider = $this->provider->findOrFail($request->provider_id);

        $price = str_replace('R$ ', '', $request->get('provider_price'));

        $item_seller = [
            'item_id'     => $request->item_id,
            'value'       => $price, 
            'provider_id' => $provider->id
        ];

        $provideritem = $this->provideritem->create($item_seller);

        $notification = array(
            'message' => 'Item Adicionado!' , 
            'alert-type' => 'success'
        );
        
        return redirect(route('providers.edit', $provider->id))->with($notification);
    }   
    public function pitemsUpdate(Request $request, $id)
    {
        
        $price = str_replace('R$ ', '', $request->get('provider_price'));
        
        $provideritem = $this->provideritem->findOrFail($id);
        
        $provideritem->value = $price;
        $provideritem->save();

        $notification = array(
            'message' => 'Produto do Fornecedor atuliazado!' , 
            'alert-type' => 'success'
        );
        
        return redirect(route('providers.edit', $provideritem->provider_id))->with($notification);
    } 
    public function pitemsDestroy($id)
    {
        $provideritem = $this->provideritem->find($id);
        $provideritem->delete();

        $notification = array(
            'message' => 'Produto do Fornecedor Deletado!' , 
            'alert-type' => 'success'
        );
        
        return redirect(route('providers.edit', $provideritem->provider_id))->with($notification);
    }   
}
