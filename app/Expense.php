<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_category_id', 'qty', 'unit_price', 'total', 'payment', 'payment_type', 'dues', 'description'];

    public function expense_category()
    {
    	return $this->belongsTo('App\ExpenseCategory');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
