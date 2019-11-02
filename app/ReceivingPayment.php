<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingPayment extends Model
{
    protected $fillable = ['supplier_id','receiving_id','payment','user_id','payment_type','comments'];

    public function receiving()
    {
    	return $this->belongsTo('App\Receiving');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
