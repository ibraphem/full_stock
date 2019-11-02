<?php namespace App\Http\Controllers;

use App\Inventory;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
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
        //
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
        $item = Item::with('inventory', 'inventory.user')->find($id);
        $sal_inv = [];
        $rec_inv = [];
        $other_inv = [];
        foreach ($item->inventory as $inventory ) {
            $first_four = substr($inventory->remarks, 0, 4);
            if (strtoupper($first_four) == 'SALE') {
                $sal_inv[] = $inventory;
            } elseif (strtoupper($first_four) == 'RECV') {
                $rec_inv[] = $inventory;
            } else {
                $other_inv[] = $inventory;
            }
        }
        $inventories = Inventory::all();
        return view('inventory.edit')
            ->with('item', $item)
            ->with('sal_inv', $sal_inv)
            ->with('rec_inv', $rec_inv)
            ->with('other_inv', $other_inv)
            ->with('inventory', $inventories);
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
        $items = Item::find($id);
        $items->quantity = $items->quantity + Input::get('in_out_qty');
        $items->save();

        $inventories = new Inventory;
        $inventories->item_id = $id;
        $inventories->user_id = Auth::user()->id;
        $inventories->in_out_qty = Input::get('in_out_qty');
        $inventories->remarks = Input::get('remarks');
        $inventories->save();

        Session::flash('message', __('You have successfully updated item'));
        return Redirect::to('inventory/' . $id . '/edit');
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

    public function validator(Array $data)
    {
        return Validator::make($data, [
           "in_out_qty" =>"required|numeric|max:999999999",
            'remarks'=>'required|max:255'
        ]);
    }
}
