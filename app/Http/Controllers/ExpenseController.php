<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenses = Expense::with('user','expense_category')->latest()->get();
        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_categories = ExpenseCategory::pluck('name', 'id');
        return view('expense.edit', compact('expense_categories'));
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
        $expense = new Expense();
        $expense->expense_category_id = $request->expense_category_id;
        $expense->description = $request->description;
        $qty = $expense->qty = $request->qty;
        $unit_price = $expense->unit_price = $request->unit_price;
        $total = $expense->total = $qty * $unit_price;
        $payment = $expense->payment = $request->payment;
        $expense->dues = $total -$payment;
        $expense->payment_type = $request->payment_type;
        $expense->user_id = Auth::user()->id;
        $expense->save();
        Session::flash('message', __('Expense Created successfully'));
        return redirect('expense');
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
        $expense = Expense::findOrFail($id);
        $expense_categories = ExpenseCategory::pluck('name', 'id');
        return view('expense.edit', compact('expense', 'expense_categories'));
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
        $this->validator($request->all())->validate();
        $expense = Expense::findOrFail($id);
        $expense->expense_category_id = $request->expense_category_id;
        $expense->description = $request->description;
        $qty = $expense->qty = $request->qty;
        $unit_price = $expense->unit_price = $request->unit_price;
        $total = $expense->total = $qty * $unit_price;
        $payment = $expense->payment = $request->payment;
        $expense->dues = $total -$payment;
        $expense->payment_type = $request->payment_type;
        $expense->user_id = Auth::user()->id;
        $expense->update();
        //dd($expense);
        Session::flash('message', __('Expense Updated successfully'));
        return redirect('expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();
        return redirect()->back();
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'expense_category_id'=>'required|integer|exists:expense_categories,id',
            'description'=>'required',
            'payment'=>'required|numeric|max:9999999999',
            'dues'=>'numeric|max:9999999999',
            'total'=>'numeric|max:9999999999',
            'unit_price'=>'numeric|max:9999999999',
            'qty'=>'integer|max:9999999999',
            'payment_type'=>'required|max:50'
        ]);
    }
}
