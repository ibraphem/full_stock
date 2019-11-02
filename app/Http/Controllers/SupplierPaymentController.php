<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\SupplierPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SupplierPaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validator($input)->validate();
        $input['user_id'] = Auth::user()->id;
        SupplierPayment::create($input);

        $supplier = Supplier::findOrFail($request->supplier_id);
        $supplier->payment = $supplier->payment + $request->payment;
        $supplier->prev_balance = $supplier->prev_balance - $request->payment;
        $supplier->update();
        Session::flash('message', __('You have successfully added Payments for Supplier '.$supplier->name));
        return redirect()->back();
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'payment_type'=>'required|max:100',
            'payment'=>'required|gt:0|numeric|max:9999999999'
        ]);
    }
}
