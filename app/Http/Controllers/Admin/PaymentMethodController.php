<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use DB;
use App\Models\Parcel;

class PaymentMethodController extends Controller
{
    protected $paymentmethod;
    protected $parcel;

    public function __construct(PaymentMethod $paymentmethod, Parcel $parcel)
    {
        $this->paymentmethod = $paymentmethod;
        $this->parcel  = $parcel;
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
    
        $verif = $this->parcel->get()->where('payment_method_id', '=', $paymentmethod->id)->first();

        if($verif)
        {
            $notification = array(
                'message' => 'Forma de Pagamento em uso!' , 
                'alert-type' => 'error'
            );
        }
        else
        {
            $paymentmethod->delete();

            $notification = array(
                'message' => 'Forma de Pagamento Deletado!' , 
                'alert-type' => 'success'
            );
        }      
        
        return redirect('admin/paymentmethod/search')->with($notification);
    }   
}