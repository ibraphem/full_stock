<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
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
        $expense_categories = ExpenseCategory::with('expense')->latest()->get();
        return view('expense.expensecategory')->with('expense_categories', $expense_categories);
    }

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
        $input['slug'] = str_slug($request->name);
        ExpenseCategory::create($input);
        Session::flash('message', __('Expense Category added successfully!'));
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
        $expensecategory = ExpenseCategory::with('expense', 'expense.user', 'expense.expense_category')->where('id', $id)->first();
        $expense_categories = ExpenseCategory::latest()->get();
        return view('expense.expensecategory', compact('expensecategory', 'expense_categories'));
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'name'=>'required|max:150'
        ]);
    }
}
