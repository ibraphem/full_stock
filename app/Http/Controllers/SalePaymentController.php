<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SalePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $payment = new SalePayment;
        $payment->payment = $request->payment;
        $payment->payment_type = $request->payment_type;
        $payment->comments = $request->comments;
        $payment->sale_id = $request->sale_id;
        //updating sales
        $sale = Sale::findOrFail($request->sale_id);
        $sale->payment = $sale->payment + $request->payment;
        $dues = $sale->dues = $sale->dues - $request->payment;
        $sale->update();
        $payment->user_id = Auth::user()->id;
        $payment->dues = $dues;
        $payment->save();
        //updating customer balance
        $customer = Customer::where('id', $sale->customer_id)->first();
        $customer->prev_balance = $customer->prev_balance - $request->payment;
        $customer->update();
        Session::flash('message', __('Sale Payment added successfully!'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validator(Array $data)
    {
        return Validator::make($data, [
            'payment'=>'required|numeric|max:9999999999',
            'payment_type'=>'required|max:100',
        ]);
    }
}
