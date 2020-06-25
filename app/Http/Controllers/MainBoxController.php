<?php

namespace App\Http\Controllers;

use App\MainBox;
use App\Product;
use App\Purchase;
use App\ProductDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Session;

class MainBoxController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mainBox-list|mainBox-create|mainBox-edit|mainBox-delete', ['only' => ['index','store']]);
        $this->middleware('permission:mainBox-create', ['only' => ['create','store']]);
        $this->middleware('permission:mainBox-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:mainBox-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainboxes = MainBox::orderBy('id', 'DESC')->where('status', 1)->get();
        $id = MainBox::latest()->first();
        $purchases = Purchase::orderBy('id', 'desc')->whereNotIn('min_qty', [0])->get();
        if (isset($id)){
            // number auto increase
            $code = $id->id + 1;
            return view('mainbox.index', compact('code', 'purchases', 'mainboxes'));
        }

        return view('mainbox.index', compact('purchases', 'mainboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:main_boxes,code',
            'qty' => 'required',
            'type' => 'required',
            'purchase_id' => 'required',
        ]);

        $purchase = Purchase::where('id', $request->purchase_id)->first();
        $product = Product::where('id', $purchase->product_id)->first();

        $orgDate = $purchase->delivery_date;
        $year = date("Y", strtotime($orgDate));
        $month = date("m", strtotime($orgDate));
        $day = date("d", strtotime($orgDate));

        $good_qty = $purchase->min_qty;

        if ($good_qty >= (int)$request->qty){
//            Main Box Save
             $data = [
                    'code'  => str_pad($request->code + 0, 2, 0, STR_PAD_LEFT),
                    'Barcode'     => $product->category->code.str_pad($request->code + 0, 2, 0, STR_PAD_LEFT),
                    'qty'  => $request->qty,
                    'type'     => $request->type,
                    'product_id'     => $purchase->product_id,
                    'user_id'     => Auth::user()->id,
                    'purchase_id' => $purchase->id,
                    'status' => 1,
                    'date' => '0000-00-00',
                ];
             $mainBox = MainBox::create($data);
            $purchase->update([
                'min_qty' => $purchase->min_qty - $request->qty,
            ]);

            Alert::message('Create', 'Mainbox Created Successfully!');
            return redirect()->back();
        }else{
            Alert::message('Error', 'Not Enough Purchase Qty');
            return redirect()->back();
        }
    }

    public function local(Request $request)
    {
        $MW = MainBox::orderBy('id', 'DESC')->where('status', 1)->get();
        $mainboxes = MainBox::orderBy('id', 'DESC')->where('status', 2)->get();
        $local = 'Local Shop';
        return view('mainbox.shop', \compact('MW','mainboxes', 'local'));
    }

    public function online(Request $request)
    {
        $MW = MainBox::orderBy('id', 'DESC')->where('status', 1)->get();
        $mainboxes = MainBox::orderBy('id', 'DESC')->where('status', 3)->get();
        $online = 'Online Shop';
        return view('mainbox.shop', \compact('MW','mainboxes', 'online'));
    }

    public function status(Request $request)
    {
        $mainbox = MainBox::find($request->mainbox_id);
        $mainbox->update([
            'status' => $request->status,
            'date' => date('Y-m-d'),
        ]);
        if($request->status == 2) {
            // Product Detail Save
                // for( $i = 0; $i<$mainbox->qty; $i++ ) {
                    
                //     $m = date('m');
                //     $d = date('d');
                //     $h = date('h');

                //     $ml = substr($m, -1);
                //     $dl = substr($d, -1);
                //     $hl = substr($h, -1);

                //     $fr = rand(0, 9);
                //     $sr = rand(0, 9);
                //     $tr = rand(0, 9);
                //     $fr = rand(0, 9);

                //     $arr =[$ml, $dl, $hl, $fr, $sr, $tr, $fr];
                //     shuffle($arr);
                //     $array_random = array_rand($arr, 4);
                //     $frrs = str_shuffle($array_random[0].$array_random[1].$array_random[2].$array_random[3]);
                //     $bcrand = $mainbox->product->code.$frrs;
                //     $string = preg_replace('/\s+/', '', $bcrand); 

                //     ProductDetail::create([
                //         'purchase_id' => $mainbox->purchase_id,
                //         'product_id' => $mainbox->product_id,
                //         'Barcode' => $string,
                //         'mainBox_id' => $mainbox->id,
                //         'qty' => 1,
                //     ]);
                // }
            //end pD

            // Product Qty Update
            $product = Product::find($mainbox->product_id);
            $product->qty += $mainbox->qty;
            $product->mainbox_id = $mainbox->id;
            $product->user_id = Auth::user()->id;
            $product->save();
        }
        return redirect()->back()->with('success', 'Successful');
    }

    public function mainbox_barcode(Request $request)
    {
       $mainboxes = MainBox::where('status', 1)->get();
            return view('mainbox.loBarcode', \compact('mainboxes'));       
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\MainBox  $mainBox
     * @return \Illuminate\Http\Response
     */
    public function show(MainBox $mainBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MainBox  $mainBox
     * @return \Illuminate\Http\Response
     */
    public function edit(MainBox $mainBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainBox  $mainBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainBox $mainBox)
    {
        // $this->validate($request, [
        //     'qty' => 'required',
        //     'type' => 'required',
        //     'product_id' => 'required',
        // ]);

        // $product = Product::find($request->product_id)
        //     ->join('purchases', 'purchases.product_id', '=', 'products.id')
        //     ->first();

        // if ($product == null){
        //     return redirect()->back()->with('404','NO Product Found');;
        // }else{

        //     $orgDate = $product->delivery_date;
        //     $year = date("Y", strtotime($orgDate));
        //     $month = date("m", strtotime($orgDate));
        //     $day = date("d", strtotime($orgDate));
        //     // dd($product->category->code.$year.$month.$day.$request->code.$product->code);

        //     $data = [
        //         'qty'  => $request->qty,
        //         'type'     => $request->type,
        //         'product_id'     => $request->product_id,
        //         'user_id'     => Auth::user()->id,
        //     ];
        //     $mainBox->update($data);
        //     $product_details = ProductDetail::where('mainBox_id', $mainBox->id)->delete();

        //     $bcrand = $year.$month.$day.$product->category->code.$product->code.$request->code;
        //     $three = 99;
        //     for( $i = 0; $i<$request->qty; $i++ ) {
        //         $three++;
        //        ProductDetail::create([
        //             'product_id' => $request->product_id,
        //             'Barcode' => $bcrand.$three,
        //             'qty' => 1,
        //        ]);
        //     }
        //     $pp = Product::find($request->product_id);
        //     $pp->update([
        //         'qty' => $request->qty,
        //         'mainbox_id' => $mainBox->id,
        //         'user_id'     => Auth::user()->id,
        //     ]);
        //     return redirect()->back()->with('update', 'Mainbox Created Successfully!');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainBox  $mainBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainBox $mainBox)
    {
        ProductDetail::where('mainBox_id', $mainBox->id)->delete();
        
        MainBox::where('id',$mainBox->id)->delete();
        $product = Product::find($mainBox->product_id);
        $product->update([
            'qty' => $product->qty - $mainBox->qty,
        ]);
       return redirect()->back()->with('200', 'MainBox Deleted Successfully!');
    }
}
