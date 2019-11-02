<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $fillable = ['payment', 'sale_id', 'comments', 'payment_type'];

    public function sale()
    {
    	return $this->belongsTo('App\Sale');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function saveSalePayment($input, $sale_id)
    {
        $this->payment = $input['payment'];
        $this->dues = $input['total'] - $input['payment'];
        $this->payment_type = $input['payment_type'];
        $this->comments = $input['comments'];
        $this->sale_id = $sale_id;
        $this->user_id = $input['user_id'];
        $this->save();
    }

    public function deleteBySaleId($sale_id)
    {
        $this->where('sale_id', $sale_id)->delete();
    }
}
