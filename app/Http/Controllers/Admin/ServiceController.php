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
        $price = str_replace('R$ ', '', $request->get('price'));

        $dataService = [
            'name'  => $request->name,
            'price' => $price
        ];

        $service = $this->service->create($dataService);

        $notification = array(
            'message' => 'Serviço Registrado!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('services.search')->with($notification);  
                   
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

        $price = str_replace('R$ ', '', $request->get('price'));

/* 

$price = str_replace('R$ ', '', $request->get('price'));
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);

*/
       // dd($price);

        $service= \App\Models\Service::find($id);
        $service->name = $request->get('name'); 
        $service->price = $price;       
        $service->save();

        $notification = array(
            'message' => 'Serviço Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('services.search')->with($notification);
    }

    public function servicesDestroy($id)
    {        
        $service = \App\Models\Service::find($id);
        $service->delete();

        $notification = array(
            'message' => 'Serviço Deletado!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('services.search')->with($notification);
    }
}
