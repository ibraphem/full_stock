<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleTemp extends Model
{
	public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function saveSaleTemp($sale_item)
    {
        $this->item_id = $sale_item->item_id;
        $this->cost_price = $sale_item->cost_price;
        $this->selling_price = $sale_item->selling_price;
        $this->quantity = $sale_item->quantity;
        $this->total_cost = $sale_item->cost_price;
        $this->total_selling = $sale_item->selling_price;
        $this->save();
    }
}
