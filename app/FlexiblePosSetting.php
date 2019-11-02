<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class FlexiblePosSetting extends Model
{
    protected $fillable = ['language', 'logo_path', 'fevicon_path', 'company_name', 'company_address', 'starting_balance', 'currency_code'];

    public $status = false;

    public function saveSettings($inputData)
    {
        $this->language = $inputData['language'];
        if (!empty($inputData['logo_path'])) {
            $this->logo_path = $inputData['logo_path'];
        }
        if (!empty($inputData['fevicon_path'])) {
            $this->fevicon_path = $inputData['fevicon_path'];
        }
        $this->company_name = $inputData['company_name'];
        $this->company_address = $inputData['company_address'];
        $this->starting_balance = $inputData['starting_balance'];
        $this->currency_code = $inputData['currency_code'];
        if ($this->save()) {
            Session::put('setting', $this);
            $this->status = true;
        }
    }

    public function setting($key, $default)
    {
        $result = null;
        if (empty(Session::get('setting'))) {
            $setting = $this->first();
            Session::put('setting', $setting);
        }
        $setting = Session::get('setting');
        if ($key == 'language' && empty($setting->$key)) {
            return App::getLocale();
        }
        if (!empty($setting)) {
            $result = $setting->$key;
        }
        return $result;
    }
}
