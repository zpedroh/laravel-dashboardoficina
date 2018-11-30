<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCreateRequest;
use DB;
use App\Models\Brand;
use App\Models\Item;


class BrandController extends Controller
{

    protected $brand;
    protected $item;

    public function __construct(Brand $brand, Item $item)
    {
        $this->brand = $brand;
        $this->item  = $item;
    }

    public function brandsRegister()
    {
        return view('admin.brand.register');
    }

    public function brandsCreate(BrandCreateRequest $request)
    {
        if($request->name != null)
        {
            $brand = $this->brand->create($request->all());

            $notification = array(
                'message' => 'Marca Registrada!' , 
                'alert-type' => 'success'
            );

            return redirect()->route('brands.search')->with($notification);  
        }         
    } 

    public function brandsGet()
    {
        $brand = $this->brand->all();

        return view('admin.brand.search', compact('brand'));        
    }

    public function brandsEdit($id)
    {        
        $brand = $this->brand->find($id);
        //return view('admin.brand.edit',compact('brand','id'));        
    }

    public function brandsUpdate(Request $request, $id)
    {
        $brand = $this->brand->find($id);
        $brand->name = $request->get('name');        
        $brand->save();

        $notification = array(
            'message' => 'Marca Atualizada!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/brand/search')->with($notification);
    }

    public function brandsDestroy($id)
    {
        $brand = $this->brand->find($id);

        $verif = $this->item->get()->where('brand_id', '=', $brand->id)->first();

        if($verif)
        {
            $notification = array(
                'message' => 'Marca em uso!' , 
                'alert-type' => 'error'
            );
        }
        else
        {
            $brand->delete();

            $notification = array(
                'message' => 'Marca Deletada!' , 
                'alert-type' => 'success'
            );    
        } 

        return redirect('admin/brand/search')->with($notification);
    }
}
