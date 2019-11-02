<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Inventory')->orderBy('id', 'DESC');
    }

    public function receivingtemp()
    {
        return $this->hasMany('App\ReceivingTemp')->orderBy('id', 'DESC');
    }

    public function receivingitem()
    {
        return $this->hasMany('App\ReceivingItem')->orderBy('id', 'DESC');
    }

    public function saletemp()
    {
        return $this->hasMany('App\SaleTemp')->orderBy('id', 'DESC');
    }

    public function saleitem()
    {
        return $this->hasMany('App\SaleItem')->orderBy('id', 'DESC');
    }

    public function saveItem($input)
    {
        $result = false;
        $this->upc_ean_isbn = !empty($input['upc_ean_isbn']) ? $input['upc_ean_isbn'] : "";
        $this->item_name = $input['item_name'];
        $this->size = !empty($input['size']) ? $input['size'] : "";;
        $this->description = !empty($input['description']) ? $input['description'] : "";
        $this->cost_price = $input['cost_price'];
        $this->selling_price = $input['selling_price'];
        $this->quantity = $input['quantity'];
        $this->stock_limit = !empty($input['stock_limit']) ? $input['stock_limit'] : 0;
        $this->expire_date = !empty($input['expire_date']) ? $input['expire_date'] :null;
        $this->avatar = !empty($input['avatar']) ? $input['avatar'] : "no-foto.png";
        if($this->save()) {
            $result = true;
        }
        return $result;
    }

    public function checkItemStock($saleItems)
    {
        $result = false;
        foreach ($saleItems as $value) {
           $item = $this->find($value->item_id);
           if ($item->quantity < $value->quantity && $item->stock_limit < $value->quantity) {
               $result = true;
           }
        }
        return $result;
    }
}
