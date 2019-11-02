<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Item;
use App\Inventory;
use App\SaleTemp;
use Illuminate\Support\Facades\Input;
use \Auth;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use \Session;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ItemController extends Controller
{
    use FileUploadTrait;

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

        $items = Item::where('type', 1)->get();
        return view('item.index')->with('item', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('item.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validator($input)->validate();
        $items = new Item;
        if (!empty($request->file('avatar'))) {
            $avatarName = $this->uploadImage($request->file('avatar'), "images/items/");
            $input['avatar'] = $avatarName;
        }
        $items->saveItem($input);
        // process inventory
        if (!empty($input['quantity'])) {
            $inventories = new Inventory;
            $input['item_id'] = $items->id;
            $input['user_id'] = Auth::user()->id;
            $input['remarks'] = "Manual Edit of Quantity";
           $inventories->saveInventory($input);
        }
        // process avatar
        Session::flash('message', __('You have successfully added item'));
        return Redirect::to('items/create');
    }

    public function customCreate(Request $request)
    {
        $input = $request->all();
        $item = new Item();
        $item->saveItem($input);

        $SaleTemps = new SaleTemp();
        $SaleTemps->item_id = $item->id;
        $SaleTemps->cost_price = $item->cost_price;
        $SaleTemps->selling_price = $item->selling_price;
        $SaleTemps->quantity = $request->qty;
        $SaleTemps->total_cost = $item->cost_price;
        $SaleTemps->total_selling = $item->selling_price;
        $SaleTemps->save();

        return redirect()->back();
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
        $items = Item::find($id);
        return view('item.edit')
            ->with('item', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->validator($input)->validate();
        $items = Item::find($id);
        // process avatar
        if (!empty($request->file('avatar'))) {
            $avatarName = $this->uploadImage($request->file('avatar'), "images/items/");
            $input['avatar'] = $avatarName;
        } else {
            $input['avatar'] = $items->avatar;
        }
        $items->saveItem($input);

        // process inventory
        $inventories = new Inventory;
        $input['item_id'] = $id;
        $input['user_id'] = Auth::user()->id;
        $input['quantity'] = $input['quantity'] - $items->quantity;
        $input['remarks'] = "Manual Edit of Quantity";
        $inventories->saveInventory($input);

        Session::flash('message', __('You have successfully updated item'));
        return Redirect::to('items');
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
            $item = Item::find($id);
            if (count($item->saleitem()->get()) > 0 || count($item->receivingitem()->get()) > 0) {
                Session::flash('message', __('Item can"t be deleted. Some sales or Receivings found with this Item. Please delete them first.'));
                Session::flash('alert-class', 'alert-danger');
                return Redirect::to('items');
            }
            $item->delete();

            Session::flash('message', __('You have successfully deleted item'));
            return Redirect::to('items');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('message', __('Integrity constraint violation: You Cannot delete a parent row'));
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('items');
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'avatar'=>'mimes:jpeg,bmp,png|max:5120kb',
            'upc_ean_isbn'=>'required|max:90',
            'size'=>'max:20',
            'item_name'=>'required|max:90',
            'cost_price'=>'required|numeric|max:9999999',
            'selling_price'=>'required|numeric|max:9999999',
            'quantity'=>'required|integer|max:999999999'
        ]);
    }
}
