<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleTemp;

class Sale extends Model 
{
    const HOLD = 0;
    const DUE = 1;
    const PAID = 2;

	public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public static function sale_detailed($sale_id)
    {
        $SaleItems = SaleItem::where('sale_id', $sale_id)->get();
        return $SaleItems;
    }

    public function saleItems()
    {
        return $this->hasMany('App\SaleItem');
    }

    public function sale_payment()
    {
        return $this->hasMany('App\SalePayment', 'sale_id', 'id');
    }

    public function saveSale($input)
    {
        $this->customer_id = $input['customer_id'];
        $this->user_id = $input['user_id'];
        $this->payment_type = $input['payment_type'];
        $this->comments = $input['comments'];
        $this->discount = $input['total_discount'];
        $this->tax = $input['tax'];
        $this->grand_total = $input['total'];
        //insert payment data in the payment table
        $this->payment = $input['payment'];
        $this->dues = $input['dues'];
        $this->status = $input['status'];
        $this->save();
        return $this;
    }

    public function processSale($input, $saleItems, $hold = false)
    {
        $input['total_discount'] = $total_discount = $input['discount'] + ($input['discount_percent'] * $input['subtotal'])/100;
        $input['tax'] = $tax = ($input['subtotal']*0)/100;
        $input['total'] = $total = $input['subtotal'] + $tax - $total_discount;
        $input['dues'] = $dues = $total - $input['payment'];
        if ($dues > 0) {
            $input['status'] = Sale::DUE;
        } else if($dues == 0) {
            $input['status'] = Sale::PAID;
        }
        if ($hold) {
            $input['status'] = Sale::HOLD;
        }
        // saving sales
        $this->saveSale($input);
        
        if (!$hold) {
            // updating customer prev Balance
            if ($this->dues > 0) {
                $customer = new Customer();
                $customer->updateCustomerBalance($this->customer_id, $this->dues);
            }

            //make a sale Payment
            if ($this->payment > 0) {
                $sale_payment = new SalePayment;
                $sale_payment->saveSalePayment($input, $this->id);
            }
        }

        // Process Sale Items
        foreach ($saleItems as $value) {
            $saleItemsData = new SaleItem();
            $saleItemsData->saveSaleItem($value, $this->id);
            if(!$hold) {
                //process inventory
                $items = Item::find($value->item_id);
                if ($items->type == 1) {
                    //process item quantity
                    $items->quantity = $items->quantity - $value->quantity;
                    $items->save();
                    $inventory_input = [
                        'item_id'=>$value->item_id,
                        'user_id'=>$this->user_id,
                        'quantity'=>-($value->quantity),
                        'remarks'=>'SALE' . $this->id
                    ];
                    $inventories = new Inventory;
                    $inventories->saveInventory($inventory_input);
                } else {
                    $itemkits = ItemKitItem::where('item_kit_id', $value->item_id)->get();
                    foreach ($itemkits as $item_kit_value) {
                        $inventories = new Inventory;
                        $inventories->item_id = $item_kit_value->item_id;
                        $inventories->user_id = Auth::user()->id;
                        $inventories->in_out_qty = -($item_kit_value->quantity * $value->quantity);
                        $inventories->remarks = 'SALE' . $this->id;
                        $inventories->save();
                        //process item quantity
                        $item_quantity = Item::find($item_kit_value->item_id);
                        $item_quantity->quantity = $item_quantity->quantity - ($item_kit_value->quantity * $value->quantity);
                        $item_quantity->save();
                    }
                }
            }
            
        }
         //delete all data on SaleTemp model
         SaleTemp::truncate();
        return $this;
    }

    public function resetSale()
    {
        if ($this->status == self::HOLD) {
            // 1. customer deduct dues
            $customer = new Customer;
            $customer->updateCustomerBalance($this->customer_id, -$this->dues);
            // 2. delete salepayment
            $sale_payment = new SalePayment;
            $sale_payment->deleteBySaleId($this->id);
        }
        
        // 3. delete saleItem
        $sale_item = new SaleItem();
        $sale_item->deleteBySaleId($this->id);

        if ($this->status == self::HOLD) {
            // 4. update item qty
            // 5. Delete Inventory
            $inventory = new Inventory();
            $inventory->deleteBySaleIdAndResetItemQty($this->id);
        }

    }

    public function getStatus()
    {
        $status = '';
        if ($this->status == self::HOLD) {
            $status = '<span class="label label-danger">Hold</span>';
        } else if ( $this->status == self::DUE) {
            $status = '<span class="label label-warning">Due</span>';
        } else if ( $this->status == self::PAID) {
            $status = '<span class="label label-success">Paid</span>';
        }
        return $status;
    }
}
