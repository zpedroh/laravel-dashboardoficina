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

        $notification = array(
            'message' => 'Forma de Pagamento Registrada!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('paymentmethods.search')->with($notification);  
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

        $notification = array(
            'message' => 'Forma de Pagamento Atualizada!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/paymentmethod/search')->with($notification);
    }

    public function paymentmethodsDestroy($id)
    {
        $paymentmethod = $this->paymentmethod->find($id);
        
        $paymentmethod->delete();

        $notification = array(
            'message' => 'Forma de Pagamento Deletada!' , 
            'alert-type' => 'success'
        );
        
        return redirect('admin/home')->with($notification);
    }   
}