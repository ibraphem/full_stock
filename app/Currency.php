<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'code', 'digital_code', 'symbol', 'country', 'precision', 'subunit', 'symbol_first', 'decimal_mark', 'thousands_separator'];

    public function getAll()
    {
        return $this->all(['id', 'code', 'symbol']);
    }
}
