<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('barcode');
    }

    public function processbarcode(Request $request)
    {
        $barcode = trim($request->input('barcode'));
        return view('barcode')->with('barcode', $barcode);
    }
}
