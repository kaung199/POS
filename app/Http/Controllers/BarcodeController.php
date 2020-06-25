<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function barcode(Request $request){
        $this->validate($request, [
            'code' => 'required',
        ]);

        $check = ProductDetail::where('Barcode', $request->code)->get();
        if (count($check)>0){
            foreach ($check as $checks){
                return response()->json(["message" => $checks->Barcode]);
            }
        }else{
            return response()->json(["message" => 'barcode not found']);
        }
    }
}
