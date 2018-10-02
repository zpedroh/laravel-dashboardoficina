<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Service;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function servicesRegister()
    {
        return view('admin.service.register');
    }

    public function servicesCreate(Request $request)
    {
        if($request->name != null)
        {
            $service = $this->service->create($request->all());

            return redirect()->route('services.register')->with('success', 'Information has been added');  
        }             
    } 

    public function servicesGet()
    {
        $service = $this->service->all();

        return view('admin.service.search', compact('service'));        
    }

    public function servicesEdit($id)
    {        
        $service = \App\Models\Service::find($id);
        return view('admin.service.edit',compact('service','id'));        
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service= \App\Models\Service::find($id);
        $service->name=$request->get('name'); 
        $service->price=$request->get('price');       
        $service->save();
        return redirect('admin/home');
    }

    public function servicesDestroy($id)
    {
        $service = \App\Models\Service::find($id);
        $service->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }
}
