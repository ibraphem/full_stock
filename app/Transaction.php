<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_type', 'amount', 'transaction_with', 'account_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function updateAccountBalance($action)
    {
        $account = Account::findOrFail($this->account_id);
        if ($action == 'delete') {
            if ($this->transaction_type == 2) {
                $account->balance = $account->balance - $this->amount;
            } else {
                $account->balance = $account->balance + $this->amount;
            }
        } elseif ($action == 'create') {
            if ($this->transaction_type == 2) {
                $account->balance = $account->balance + $this->amount;
            } else {
                $account->balance = $account->balance - $this->amount;
            }
        }
        $account->update();
    }
}
