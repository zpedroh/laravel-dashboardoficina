<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCreateRequest;
use DB;
use App\Models\Brand;


class BrandController extends Controller
{

    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
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

            return redirect()->route('brands.register')->with('success', 'Information has been added');  
        }    
                
              
    } 

    public function brandsGet()
    {
        $brand = $this->brand->all();

        return view('admin.brand.search', compact('brand'));        
    }

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
}
