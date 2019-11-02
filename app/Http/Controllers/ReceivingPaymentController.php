<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Receiving;
use App\ReceivingPayment;
use Illuminate\Support\Facades\Auth;
use App\Supplier;

class ReceivingPaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $payment = new ReceivingPayment;
        $payment->payment = $request->payment;
        $payment->receiving_id = $request->receiving_id;
        $payment->payment_type = $request->payment_type;
        //updating sales
        $receiving = Receiving::findOrFail($request->receiving_id);
        $receiving->payment = $receiving->payment + $request->payment;
        $dues = $receiving->dues = $receiving->dues - $request->payment;
        
        $receiving->update();
        $payment->user_id = Auth::user()->id;
        $payment->dues = $dues;
        $payment->save();

        //updating customer balance
        $supplier = Supplier::where('id', $receiving->supplier_id)->first();
        $supplier->prev_balance = $supplier->prev_balance - $request->payment;
        $supplier->update();
        Session::flash('message', __('You have successfully added Payments for bill/receivings ID#'.$request->receiving_id));
        return redirect()->back();
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'payment_type' => 'required|max:150',
            'payment'=>'required|numeric|max:9999999999'
        ]);
    }
}
