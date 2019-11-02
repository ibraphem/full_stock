<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = ['payment', 'customer_id', 'payment_type', 'user_id','comments'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
