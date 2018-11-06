<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use DB;

class PaymentMethodController extends Controller
{
    protected $paymentmethod;

    public function __construct(PaymentMethod $paymentmethod)
    {
        $this->paymentmethod = $paymentmethod;
    }

    public function paymentmethodsRegister()
    {
        return view('admin.paymentmethod.register');
    }
    
    public function paymentmethodsCreate(Request $request)
    {

        $paymentmethod = $this->paymentmethod->create($request->all());

        return redirect()->route('paymentmethods.search')->with('success', 'Information has been added');  
    } 
    
    public function paymentmethodsGet()
    {
        $paymentmethod = $this->paymentmethod->all();

        return view('admin.paymentmethod.search', compact('paymentmethod'));        
    }    

    public function paymentmethodEdit()
    {        
        $client = $this->client->find($id);
        
        return view('admin.paymentmethod.edit');       
    }

    public function paymentmethodsUpdate(Request $request, $id)
    {
        $paymentmethod = $this->paymentmethod->find($id);

        $paymentmethod->update($request->all());        
        $paymentmethod->save();

        return redirect('admin/paymentmethod/search');
    }

    public function paymentmethodsDestroy($id)
    {
        $paymentmethod = $this->paymentmethod->find($id);
        
        $paymentmethod->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }   
}