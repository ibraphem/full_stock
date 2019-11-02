<?php
namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Receiving;
use App\Expense;
use \Auth, \Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceivingReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $units = [];
        $formated_report = [];
        $formated_expense = [];
        $expense_cat = (new ExpenseCategory)->getAll();
        $months = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        
        if ( !empty($request->input('month')) && !empty($request->input('year')) ) {

            $salesReport = Receiving::where('status', '!=', Receiving::HOLD)->whereMonth('updated_at',$request->input('month'))->whereYear('updated_at', $request->input('year'))->get();
            $date = '01-'.$request->input('month').'-'.$request->input('year');
            $total_days = Carbon::parse($date)->daysInMonth;
           
            for($i=1; $i<=$total_days; $i++) {
                if ($i < 10) { 
                    $i = '0'.$i;
                }
                $units[$i] = $i.' '.$months[$request->input('month')];
            }
            foreach($salesReport as $report){
                $formated_report[$report->updated_at->format('d')][] = $report;
            }

            $expenses = Expense::whereMonth('updated_at',$request->input('month'))->whereYear('updated_at', $request->input('year'))->get();
            if (!empty($expenses)) {
                foreach($expenses as $expense){
                    $formated_expense[$report->updated_at->format('d')][] = $expense;
                }
            }
            
            return view('report.receiving')->with('saleReport', $salesReport)->with('formated_report', $formated_report)->with('units', $units)->with('input', $request->all())->with('months', $months)->with('formated_expense', $formated_expense)->with('expense_cat', $expense_cat);
        } else if (!empty($request->input('year'))) {

            $salesReport = Receiving::whereYear('updated_at',$request->input('year'))->where('status', '!=', Receiving::HOLD)->get();
            $expenses = Expense::whereYear('updated_at', $request->input('year'))->get();

        } else {

            $salesReport = Receiving::where('status', '!=', Receiving::HOLD)->latest()->get();
            $expenses = Expense::latest()->get();
        }
        
        // dd($days);
        $months = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        
        foreach($salesReport as $report){
            $formated_report[$report->updated_at->format('m')][] = $report;
        }
        if (!empty($expenses)) {
            foreach($expenses as $expense){
                $formated_expense[$report->updated_at->format('m')][] = $expense;
            }
        }
        // dd($formated_expense);
        return view('report.receiving')->with('saleReport', $salesReport)->with('formated_report', $formated_report)->with('units', $months)->with('input', $request->all())->with('months', $months)->with('formated_expense', $formated_expense)->with('expense_cat', $expense_cat);;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}