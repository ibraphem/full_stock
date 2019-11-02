<?php namespace App;

use App\ReceivingItem;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    const DUE = 0;
    const PAID = 1;
    const HOLD = 2;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public static function receiving_detailed($receiving_id)
    {
        $receivingitems = ReceivingItem::where('receiving_id', $receiving_id)->get();
        return $receivingitems;
    }

    public function receivingItems()
    {
        return $this->hasMany('App\ReceivingItem');
    }

    public function saveReceiving()
    {
        
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
