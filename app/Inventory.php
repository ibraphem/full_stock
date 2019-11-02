<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function saveInventory($input)
    {
        $this->item_id = $input['item_id'];
        $this->user_id = $input['user_id'];
        $this->in_out_qty = $input['quantity'];
        $this->remarks = $input['remarks'];
        $this->save();
    }

    public function deleteBySaleIdAndResetItemQty($sale_id)
    {
        $inventories = $this->where('remarks', 'SALE'.$sale_id)->get();
        foreach($inventories as $inventory) {
            $item = Item::findOrFail($inventory->item_id);
            $item->quantity = $item->quantity - $inventory->in_out_qty;
            $item->save();
        }
        $this->where('remarks', 'SALE'.$sale_id)->delete();
    }
}
