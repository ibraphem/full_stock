<?php

namespace App\Http\Controllers;

use App\CustomerPayment;
use App\DailyReport;
use App\Expense;
use App\FlexiblePosSetting;
use App\ReceivingPayment;
use App\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailyreports = DailyReport::latest()->get();
        return view('report.reportsummary', compact('dailyreports'));
    }

    public function getDailyReport(Request $request)
    {
        if ($request->ajax()) {
            $daily_sales = SalePayment::whereDate("created_at", '=', $request->DateCreated)->get();
            //return $daily_sales;
            $customer_payments = CustomerPayment::whereDate("created_at", '=', $request->DateCreated)->get();
            $receiving_payments = ReceivingPayment::whereDate("created_at", '=', $request->DateCreated)->get();
            $expenses = Expense::whereDate("created_at", '=', $request->DateCreated)->get();

            $dailyreport = DailyReport::whereDate("created_at", '=', $request->DateCreated)->first();
            $settings = FlexiblePosSetting::orderBY("created_at", 'desc')->first();
            if ($dailyreport) {
                $prev_balance = DailyReport::latest()->first()->prev_balance;
            } else {
                $prev_report  = DailyReport::latest()->first();
                if (!$prev_report) {
                    $prev_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
                } else {
                    $prev_balance = $prev_report->net_balance;
                }
                $dailyreport = array();
            }
            
            return view('report.report', compact('prev_balance', 'dailyreport', 'daily_sales', 'customer_payments', 'receiving_payments', 'expenses', 'request'));
        }
    }

    public function createPastDailyReport(Request $request)
    {
        $prev_report  = DailyReport::latest()->first();
        $dailyReport = new DailyReport();
        if (is_null($prev_report)) {
            $dailyReport->prev_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
        } else {
            $dailyReport->prev_balance = $prev_report->net_balance;
        }
        $total_sales = $dailyReport->total_sales = DB::table('sales')->whereDate('created_at', '=', $request->DateCreated)->sum('grand_total');
        $total_sale_payment = $dailyReport->total_payment = DB::table('sale_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
        $dailyReport->total_dues = DB::table('sales')->whereDate('created_at', '=', $request->DateCreated)->sum('dues');
        $dailyReport->sale_profit = $total_sales - DB::table('sale_items')->whereDate('created_at', '=', $request->DateCreated)->sum('total_cost');
        $total_customer_payment = DB::table('customer_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
        $total_income = $dailyReport->total_income = $total_sale_payment + $total_customer_payment;
        $total_expense = $dailyReport->total_expense = DB::table('expenses')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
        $dailyReport->total_receivings = DB::table('receivings')->whereDate('created_at', '=', $request->DateCreated)->sum('total');
        $total_receivings_payment = $dailyReport->total_receivings_payment = DB::table('receiving_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
        $dailyReport->total_receivings_dues = DB::table('receivings')->whereDate('created_at', '=', $request->DateCreated)->sum('total');
        $total_supplier_payment = $dailyReport->total_supplier_payment = DB::table('supplier_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
        $total_costing = $dailyReport->total_costing = $total_expense + $total_receivings_payment + $total_supplier_payment;
        $total_profit = $dailyReport->total_profit = $total_income - $total_costing;
        $dailyReport->net_balance = $dailyReport->prev_balance + $total_profit;
        $dailyReport->user_id = Auth::user()->id;
        $dailyReport->created_at = $request->DateCreated ." 10:00:00";
        $dailyReport->save();
        Session::flash('message', __('Daily Report Closed Successfully'));
        return redirect('reports/dailyreport');
    }

    public function createDailyReport()
    {
        $prev_report  = DailyReport::latest()->first();
        $dailyReport = new DailyReport();
        if (!$prev_report) {
            $dailyReport->prev_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
        } else {
            $dailyReport->prev_balance = $prev_report->net_balance;
        }

        $total_sales = $dailyReport->total_sales = DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('grand_total');
        $total_sale_payment = $dailyReport->total_payment = DB::table('sale_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment');

        $dailyReport->total_dues = DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('dues');
        $dailyReport->sale_profit = $total_sales - DB::table('sale_items')->whereDate('created_at', '=', date('Y-m-d'))->sum('total_cost');

        $total_customer_payment = DB::table('customer_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment');
        $total_income = $dailyReport->total_income = $total_sale_payment + $total_customer_payment;

        $total_expense = $dailyReport->total_expense = DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment');
        $dailyReport->total_receivings = DB::table('receivings')->whereDate('created_at', '=', date('Y-m-d'))->sum('total');
        $total_receivings_payment = $dailyReport->total_receivings_payment = DB::table('receiving_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment');
        $dailyReport->total_receivings_dues = DB::table('receivings')->whereDate('created_at', '=', date('Y-m-d'))->sum('dues');
        $total_supplier_payment = $dailyReport->total_supplier_payment = DB::table('supplier_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment');
        $total_costing = $dailyReport->total_costing = $total_expense + $total_receivings_payment + $total_supplier_payment;

        $total_profit = $dailyReport->total_profit = $total_income - $total_costing;
        $dailyReport->net_balance = $dailyReport->prev_balance + $total_profit;
        $dailyReport->user_id = Auth::user()->id;
        $dailyReport->save();
        Session::flash('message', __('Daily Report Closed Successfully'));
        return redirect('reports/dailyreport');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = date("Y-m-d");
        $daily_sales = SalePayment::whereBetween('created_at', [ $date.' 00:00:00', $date.' 23:59:59'])->get();
        $customer_payments = CustomerPayment::whereBetween('created_at', [ $date.' 00:00:00', $date.' 23:59:59'])->get();
        $receiving_payments = ReceivingPayment::whereBetween('created_at', [ $date.' 00:00:00', $date.' 23:59:59'])->get();
        $expenses = Expense::whereBetween('created_at', [ $date.' 00:00:00', $date.' 23:59:59'])->get();
         
        $dailyreport  = DailyReport::latest()->first();
        //getting starting balance
        $starting_balance = 0;
        if (!$dailyreport) {
            if (DB::table('flexible_pos_settings')->first()) {
                $starting_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
            } else {
                Session::flash('message', 'Please make settings for your application.');
                return redirect(route('flexiblepossetting.create'));
            }
        } elseif ($dailyreport) {
            $starting_balance = $dailyreport->net_balance;
        }

        $exist_report = DailyReport::whereDate('created_at', '=', $date)->first();
        return view('report.dailyreport', compact('exist_report', 'daily_sales', 'starting_balance', 'customer_payments', 'receiving_payments', 'expenses', 'dailyreport'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        DailyReport::findOrFail($id)->delete();
        return redirect()->back();
    }
}
