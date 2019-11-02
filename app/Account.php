<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name', 'company', 'branch_name', 'account_no', 'pin', 'email', 'balance', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
