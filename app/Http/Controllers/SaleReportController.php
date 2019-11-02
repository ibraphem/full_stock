<?php 
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use \Auth, \Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
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
        $months = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        
        if ( !empty($request->input('month')) && !empty($request->input('year')) ) {

            $salesReport = Sale::where('status', '!=', Sale::HOLD)->whereMonth('updated_at',$request->input('month'))->whereYear('updated_at', $request->input('year'))->get();
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
            
            return view('report.sale')->with('saleReport', $salesReport)->with('formated_report', $formated_report)->with('units', $units)->with('input', $request->all())->with('months', $months);
        } else if (!empty($request->input('year'))) {

            $salesReport = Sale::where('status', '!=', Sale::HOLD)->whereYear('updated_at',$request->input('year'))->get();

        } else {

            $salesReport = Sale::where('status', '!=', Sale::HOLD)->latest()->get();

        }
        
        // dd($days);
        $months = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        
        foreach($salesReport as $report){
            $formated_report[$report->updated_at->format('m')][] = $report;
        }
        return view('report.sale')->with('saleReport', $salesReport)->with('formated_report', $formated_report)->with('units', $months)->with('input', $request->all())->with('months', $months);
    }

    public function getSales(Request $request)
    {
        if ($request->ajax()) {
            $saleReport = Sale::with( 'customer','saleItems', 'user', 'saleItems.item')->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('report.listssale')->with('saleReport', $saleReport);
        }
    }


    public function getSale()
    {
        $saleReport = Sale::pluck('created_at');
        return view('report.getsale')->with('saleReport', $saleReport);
    }



    public function getSaleReport(Request $request)
    {
        if ($request->ajax()) {
            $saleReport = Sale::with( 'customer','saleItems', 'user', 'saleItems.item')->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('report.listssale')->with('saleReport', $saleReport);
        }
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