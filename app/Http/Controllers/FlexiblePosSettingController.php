<?php

namespace App\Http\Controllers;

use App\FlexiblePosSetting;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Currency;

class FlexiblePosSettingController extends Controller
{
    use FileUploadTrait;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flexiblepossetting = FlexiblePosSetting::orderBy('created_at', 'desc')->get();
        if ($flexiblepossetting->count() > 0) {
            $flexiblepossetting = FlexiblePosSetting::first();
            return $this->edit($flexiblepossetting->id);
        } else {
            $flexiblepossetting = [];
            $currency = new Currency();
            $currencies = $currency->getAll();
            return view('flexiblepos-setting.index', compact('flexiblepossetting', 'currencies'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validator($input)->validate();
        if (!empty($input['logo_path'])) {
            $input['logo_path'] = $this->uploadImage($request->logo_path, "images/company/");
        } else {
            $input['logo_path'] = 'images/fpos.png';
        }
        if (!empty($input['fevicon_path'])) {
            $input['fevicon_path'] = $this->uploadImage($request->fevicon_path, "images/company/");
        } else {
            $input['fevicon_path'] = 'images/fevicon.png';
        }
        $setting = new FlexiblePosSetting();
        $setting->saveSettings($input);
        if ( $setting->status) {
            Session::flash('message', __('You have successfully saved settings.'));
        } else {
            Session::flash('message', __('Your settings can not be saved.'));
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flexiblepossetting = FlexiblePosSetting::findOrFail($id);
        $currency = new Currency();
        $currencies = $currency->getAll();
        $currency_code = $flexiblepossetting->currency_code;
        return view('flexiblepos-setting.index', compact('flexiblepossetting', 'currencies', 'currency_code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->validator($input)->validate();
        $flexiblepossetting = FlexiblePosSetting::findOrFail($id);
        if (!empty($input['logo_path'])) {
            $input['logo_path'] = $this->uploadImage($request->logo_path, "images/company/");
            if (file_exists($flexiblepossetting->logo_path) && $flexiblepossetting->logo_path != 'images/fpos.png') {
                unlink($flexiblepossetting->logo_path);
            }
        }
        if (!empty($input['fevicon_path'])) {
            $input['fevicon_path'] = $this->uploadImage($request->fevicon_path, "images/company/");
            if (file_exists($flexiblepossetting->fevicon_path) && $flexiblepossetting->fevicon_path != 'images/fevicon.png') {
                unlink($flexiblepossetting->fevicon_path);
            }
        }
        $flexiblepossetting = FlexiblePosSetting::findOrFail($id);
        $flexiblepossetting->saveSettings($input);
        if ( $flexiblepossetting->status) {
            Session::flash('message', __('You have successfully update settings.'));
        } else {
            Session::flash('message', __('Your settings can not be update.'));
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->back();
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
           'logo_path'=>'mimes:jpeg,bmp,png|max:5120kb',
           'fevicon_path'=>'mimes:jpeg,bmp,png|max:5120kb',
            'language'=>'required|max:2|min:2',
            "company_name"=>"required|max:100",
            "starting_balance"=>'required|numeric|max:9999999999',
            "company_address"=>"required"
        ]);
    }
}
