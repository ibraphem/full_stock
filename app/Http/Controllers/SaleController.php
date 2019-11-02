<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Inventory;
use App\Item;
use App\ItemKitItem;
use App\Sale;
use App\SaleItem;
use App\SalePayment;
use App\SaleTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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
    public function index()
    {
        $sales = Sale::orderBy('id', 'desc')->paginate(10);
        $customers = Customer::all();
        return view('sale.list')
            ->with('sales', $sales)
            ->with('customers', $customers);
    }

    public function create()
    {
        $sales = Sale::orderBy('id', 'desc')->first();
        $customers = Customer::all();
        return view('sale.index')
            ->with('sale', $sales)
            ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $sale = new Sale();
        if ($request->ajax()) {
            if ($request->action = 'hold-sale') {
                $validation = $this->validator($input);
                if ($validation->fails()) {
                    return $this->sendError('Validation error!', $validation->errors());
                }

                $input['user_id'] = Auth::user()->id;
                $saleItems = SaleTemp::all();
                $sale->processSale($input, $saleItems, $hold=true);
                return $this->sendResponse($input, 'Sale Holded Successfully!');
            }
        }
        $this->validator($input)->validate();
        return $this->processSale($input, $sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = 0;
        $sale->update();
        Session::flash('message', 'Sale Open Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = 1;
        $sale->update();
        Session::flash('message', 'Sale Close Successfully');
        return redirect()->back();
    }

    public function editSale(Request $request, $id)
    {
        $sales = Sale::orderBy('id', 'desc')->first();
        $sale = Sale::findOrFail($id);
        if($request->isMethod('POST')) {
            $input = $request->all();
            $this->validator($input)->validate();
            $sale->resetSale();
            return $this->processSale($input, $sale);
        }
        $sale_item_obj = new SaleItem();
        $saleItems = $sale_item_obj->getAllBySaleId($sale->id);
        SaleTemp::truncate();
        foreach ($saleItems as $item) {
            $saleTemp = new SaleTemp();
            $saleTemp->saveSaleTemp($item);
        }
        $customers = Customer::all();
        return view('sale.edit')
            ->with('sale', $sales)
            ->with('customers', $customers);
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'customer_id'=>'required',
            'payment_type'=>'required',
            'subtotal'=>'required',
            'payment'=>'required'
        ]);
    }

    private function processSale($input, $salesObj)
    {
        $saleItems = SaleTemp::all();
        if (empty($saleItems->toArray())) {
            Session::flash('message', 'Please Add some Items to create sale!');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $item = new Item();
        if ($item->checkItemStock($saleItems)) {
            Session::flash('message', 'Some of your selected Item/Items quantity are out of stock!');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $input['user_id'] = Auth::user()->id;
        $sale = $salesObj->processSale($input, $saleItems);

        $itemssale = SaleItem::where('sale_id', $sale->id)->get();
        Session::flash('message', 'You have successfully added sales');
        return view('sale.complete')
            ->with('sales', $sale)
            ->with('saleItems', $itemssale);
    }

}
