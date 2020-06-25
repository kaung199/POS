<?php

namespace App\Http\Controllers;

use App\AladdinProduct;
use App\AladdinProductPhoto;
use Illuminate\Http\Request;
use Alert;

class AladdinProductController extends Controller
{
    protected $url = 'http://www.aladdinmyanmar.com/api/pos_product';

    public function getIndex(){
        $products = AladdinProduct::orderBy('id','DESC')->get();
        //        number auto increase
        $id = AladdinProduct::latest()->first();
        if (isset($id)){
            $code = $id->id + 1;
            return view('aladdinProducts.index', compact('code', 'products'));
        }
        return view('aladdinProducts.index');
    }

    public function index(){
        $product = collect($this->getJson($this->url));

        foreach ($product as $items) {
            $count_data = AladdinProduct::where('id', $items->id)->get();
            if (count($count_data)>0){
            }else{
                AladdinProduct::insert([
                    'id'    => $items->id,
                    'code' => $items->code,
                    'name' => $items->name,
                    'quantity' => $items->quantity,
                    'price' => $items->price,
                    'description' => $items->description,
                    'category_id' => $items->category_id,
                    'photo' => 'http://www.aladdinmyanmar.com/storage/'.$items->image,
                ]);

                foreach ($items->photos as $photo){
                    AladdinProductPhoto::insert([
                        'id'    => $photo->id,
                        'filename' => 'http://www.aladdinmyanmar.com/storage/'.$photo->filename,
                        'product_id' => $photo->product_id,
                    ]);
                }
            }
        }

        Alert::message('Sync', 'Sync Finish.... ');
        return redirect()->route('aladdin_product');
    }

    protected function getJson($url)
    {
        $response = file_get_contents($url, false);
        return json_decode( $response );
    }

    public function updateProducts(Request $request){
        $product = AladdinProduct::where('id', $request->id)->first();
        $product->price = $request->price;
        $product->save();
        Alert::message('Success', 'product price change.... ');
        return redirect()->route('aladdin_product');
    }
}
