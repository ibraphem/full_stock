<?php
namespace App\Http\Controllers;

use App\Inventory;
use App\Item;
use App\Receiving;
use App\ReceivingItem;
use App\ReceivingPayment;
use App\ReceivingTemp;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ReceivingController extends Controller
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
        $receivingsReport = Receiving::with('receivingItems', 'user', 'supplier', 'receivingItems.item')->latest()->paginate(10);
        $receivings = Receiving::all();
        return view('receiving.list')->with('receivingReport', $receivingsReport)->with('receivings', $receivings);
    }

    public function create()
    {
        $receivings = Receiving::orderBy('id', 'desc')->first();
        $suppliers = Supplier::pluck('company_name', 'id');
        return view('receiving.index')
            ->with('receiving', $receivings)
            ->with('supplier', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $receivingItems = ReceivingTemp::all();
        if (empty($receivingItems->toArray())) {
            Session::flash('message', __('Please Add some Items to create Receivings!'));
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $receivings = new Receiving;
        $receivings->supplier_id = Input::get('supplier_id');
        $receivings->user_id = Auth::user()->id;
        $receivings->payment_type = Input::get('payment_type');
        $total = $receivings->total = Input::get('total');
        $payment = $receivings->payment = Input::get('payment');
        $dues = $receivings->dues = $total - $payment;
        $receivings->comments = Input::get('comments');
        if ($dues > 0) {
            $receivings->status = Receiving::DUE;
        } else {
            $receivings->status = Receiving::PAID;
        }
        $receivings->save();
        $supplier = Supplier::findOrFail($receivings->supplier_id);
        $supplier->prev_balance = $supplier->prev_balance + $dues;
        $supplier->update();
        if (Input::get('payment') > 0) {
            $payment = new ReceivingPayment;
            $paid = $payment->payment = Input::get('payment');
            $payment->payment_type = Input::get('payment_type');
            $payment->dues = $total - $paid;
            $payment->receiving_id = $receivings->id;
            $payment->user_id = Auth::user()->id;
            $payment->save();
        }
        // process receiving items

        $receivingItemsData=[];
        foreach ($receivingItems as $value) {
            $receivingItemsData = new ReceivingItem;
            $receivingItemsData->receiving_id = $receivings->id;
            $receivingItemsData->item_id = $value->item_id;
            $receivingItemsData->cost_price = $value->cost_price;
            $receivingItemsData->quantity = $value->quantity;
            $receivingItemsData->total_cost = $value->total_cost;
            $receivingItemsData->save();
            //process inventory
            $items = Item::findOrFail($value->item_id);
            $inventories = new Inventory;
            $inventories->item_id = $value->item_id;
            $inventories->user_id = Auth::user()->id;
            $inventories->in_out_qty = $value->quantity;
            $inventories->remarks = 'RECV'.$receivings->id;
            $inventories->save();
            //process item quantity
            $items->quantity = $items->quantity + $value->quantity;
            $items->save();
        }
        //delete all data on ReceivingTemp model
        ReceivingTemp::truncate();
        $itemsreceiving = ReceivingItem::where('receiving_id', $receivingItemsData->receiving_id)->get();
        Session::flash('message', __('You have successfully added receivings'));

        return view('receiving.complete')
            ->with('receivings', $receivings)
            ->with('receivingItemsData', $receivingItemsData)
            ->with('receivingItems', $itemsreceiving);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $receiving = Receiving::findOrFail($id);
        $receiving->status = 0;
        $receiving->update();
        Session::flash('message', __('Sale Opened Successfully'));
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
        $receiving = Receiving::findOrFail($id);
        $receiving->status = 1;
        $receiving->update();
        Session::flash('message', __('Sale Closed Successfully'));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $items = Item::find($id);
        // process inventory
        $receivingTemps = new ReceivingTemp;
        $receivingTemps->item_id = $id;
        $receivingTemps->quantity = Input::get('quantity');
        $receivingTemps->save();
        Session::flash('message', __('You have successfully add item'));
        return Redirect::to('receivings');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'supplier_id'=>'required',
            'payment_type'=>'required',
            'total'=>'required',
            'payment'=>'required'
        ]);
    }
}
