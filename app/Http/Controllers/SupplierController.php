<?php namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Image;
use \Auth;
use \Redirect;
use \Session;
use App\Receiving;
use App\SupplierPayment;
use App\ReceivingPayment;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
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
        $suppliers = Supplier::all();
        return view('supplier.index')->with('supplier', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('supplier.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $suppliers = new Supplier;
        $suppliers->saveSupplier($request->all());

        if (!empty(Input::get('payment'))) {
            //$prev_balance= $suppliers->prev_balance - $suppliers->payment;
            $payment = new SupplierPayment;
            $payment->payment = $request->payment;
            $payment->supplier_id = $suppliers->id;
            $payment->user_id = Auth::user()->id;
            $payment->save();
        }
        // process avatar
        $image = $request->file('avatar');
        if (isset($image)) {
            $suppliers->saveSupplierAvatar($image);
        }
        Session::flash('message', __('You have successfully added supplier'));
        return Redirect::to('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $receivings = Receiving::where('supplier_id', $id)->get();
        $total_receivings = $receivings->count();
        $total_dues = $receivings->sum('dues');
        $total_supplier_payment = SupplierPayment::where('supplier_id', $id)->sum('payment');
        $receivingReport_dues = Receiving::with('receivingItems', 'user', 'supplier', 'receivingItems.item')->where([['supplier_id', $id],['dues', '>', 0.00], ['status', '=', 0]])->paginate(10);
        $receivingReport_completed = Receiving::with('receivingItems', 'user', 'supplier', 'receivingItems.item')->where([['supplier_id', $id],['dues', '=', 0.00]])->orWhere([['supplier_id', $id],['status', '=', 1]])->paginate(10);
        $supplier_payments = SupplierPayment::with('user')->where('supplier_id', $id)->latest()->paginate(3);

        $receiving_payments = ReceivingPayment::with(array('receiving' => function($query) use ($id) {
            $query->where('supplier_id', '=', $id);
        }, 'user'))->orderBy('id', 'desc')->paginate(5);

        return view('supplier.show', compact('total_supplier_payment', 'supplier', 'receivingReport_completed', 'receivingReport_dues', 'total_receivings', 'total_dues', 'supplier_payments', 'receiving_payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        return view('supplier.edit')
            ->with('supplier', $suppliers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $suppliers = Supplier::find($id);
        $suppliers->saveSupplier($request->all());

        // process avatar
        $image = $request->file('avatar');
        if (isset($image)) {
            if (file_exists($suppliers->avatar) && $suppliers->avatar != 'no-foto.png') {
                unlink($suppliers->avatar);
            }
            $suppliers->saveSupplierAvatar($image);
        }
        Session::flash('message', __('You have successfully updated supplier'));
        return Redirect::to('suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $suppliers = Supplier::find($id);
            $suppliers->delete();
            Session::flash('message', 'You have successfully deleted supplier');
            return Redirect::to('suppliers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('suppliers');
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'avatar'=>'mimes:jpeg,bmp,png|max:5120kb',
            'name'=>'required|max:100',
            'company_name'=>'required|max:50',
            'email'=>'max:100',
            'address'=>'max:185',
            'city'=>'max:100',
            'state'=>'max:100',
            'account'=>'max:20',
            'zip'=>'max:10',
            'phone_number'=>'max:20',
            'prev_balance'=>'max:9999999999|numeric',
            'payment'=>'max:9999999999|numeric|nullable'
        ]);
    }
}
