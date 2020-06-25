<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductDetail;
use Illuminate\Http\Request;
use App\Sale;
use App\Township;
use DB;
use App\Stock;
use Illuminate\Support\Str;

use App\SaleDetail;
use Session;

class SalesController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//  star cart session
    // public function barcode(Request $request) 
    // {
    //     $product = ProductDetail::where('Barcode', $request->barcode)->first();
    //     if(!$product) {
    // 		return redirect()->back()->with('no-exist', 'Does not exist!');;
    //     }
    //     if($product->product->qty < 1) {
    //         return redirect()->back()->with('outofstock', 'Out of Stock');
    //     }
    	
    //     $id = $product->id;
    // 	$cart = session()->get('cart');
    // 	if(!$cart) {
    // 		$cart = [
    // 				$id => [
    //                         'product_id' => $product->product_id,
    //                         'sale_price' => $product->product->sale_price,
    //                         'code' => $product->product->code,
    //                         'name' => $product->product->name,
    //                         'quantity' => 1,
    //                         'price' => $product->product->sale_price,
    //                         'barcode' => $product->Barcode,
    // 				]
    // 		];
    // 		session()->put('cart', $cart);
    // 		return redirect()->back()->with('success', "Product Added Successfully!");
    //     }
        
    // 	$cart[$id] = [
    //         'id' => $product->id,
    //         'product_id' => $product->product_id,
    //         'sale_price' => $product->product->sale_price,
    //         'code' => $product->product->code,
    //         'name' => $product->product->name,
    //         'quantity' => 1,
    //         'price' => $product->product->sale_price,
    //         'barcode' => $product->Barcode,
    // 	];
    // 	session()->put('cart', $cart);
    // 	return redirect()->back()->with('success', "Product Added Successfully!");
    // }

//end cart session

    public function index()
    {
        //
        $data = session()->get('session_data');

        if(empty($data))
        {
            $session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $session_data = $data;
            }
            else
            {
                $session_data = array();
            }
        }
        $townships = Township::all();
        return view('sales.index', compact('session_data', 'townships'));
    }

    public function data(Request $request)
    {
        $data = $request->session()->get('sales_table');
        
        if(empty($data))
        {
            $session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $session_data = $data;
                //print_r($session_data);exit;
            }
            else
            {
                $session_data = array();
            }
        }

        $product = ProductDetail::where('Barcode', $request->code)->where('status', null)->first();
        $product_barcode = Product::where('code', $request->code)->first();
        //  return json_encode(array('product_code'=>$product,'msg'=>'found'));
        if($product != null)
        {
            $product_id = $product->product_id;
            $sale_price = $product->product->sale_price;
            $code = $product->product->code;
            $name = $product->product->name;
            $quantity = $product->product->qty;
            $price = $product->product->sale_price;
            $barcode = $product->Barcode;
            if($quantity > 0)
            {
                foreach($session_data as $key =>$sd)
                {
                    if($sd['barcode']==$barcode)
                    {
                        return json_encode(array('sales_table'=>array(),'msg'=>'Aready Exists!'));
                    }

                }
                $session_data[] = array('product_id'=>$product_id,'sale_price'=>$sale_price,'code'=>$code,'name'=>$name,'quantity'=>1,'price'=>$price, 'total'=>1*$price, 'barcode'=> $barcode);
                // return json_encode(array('success'=>'Added Successfully!'));

                $grand_total = 0;
                foreach($session_data as $sd)
                {
                    $grand_total +=  $sd['total'];
                }
                
                $request->session()->put('sales_table', $session_data);
                return json_encode(array('sales_table'=>$session_data,'msg'=>'',
                    'grand_total'=>$grand_total));
            }
            else
            {
                return json_encode(array('sales_table'=>array(),'msg'=>'Out of stock...!'));
            }
        } elseif($product_barcode != null)
        {
            $product_id = $product_barcode->id;
            $sale_price = $product_barcode->sale_price;
            $code = $product_barcode->code;
            $name = $product_barcode->name;
            $quantity = $product_barcode->qty;
            $price = $product_barcode->sale_price;
            $barcode = $product_barcode->code;

            if($quantity > 0)
            {
                foreach($session_data as $key =>$sd)
                {
                    if($sd['code'] == $code){

                        if( $quantity <= $session_data[$key]['quantity'] ) {
                            return json_encode(array('sales_table'=>array(),'msg'=>'Out Of Stock!'));
                        }

                        $session_data[$key]['quantity'] =  $sd['quantity'] +1;
                        $session_data[$key]['total']    = $session_data[$key]['quantity'] * $sd['price'];
                        $grand_total = 0;
                        foreach($session_data as $sd)
                        {
                            $grand_total +=  $sd['total'];
                        }
                        $request->session()->put('sales_table', $session_data);
                        return json_encode(array('sales_table'=>$session_data,'msg'=>'',
                            'grand_total'=>$grand_total));
                        break;
                    }
                }

                $session_data[] = array('product_id'=>$product_id,'sale_price'=>$sale_price,'code'=>$code,'name'=>$name,'quantity'=>1,'price'=>$price, 'total'=>1*$price, 'barcode'=> $barcode);
                // return json_encode(array('success'=>'Added Successfully!'));

                $grand_total = 0; 
                foreach($session_data as $sd)
                {
                    $grand_total +=  $sd['total'];
                }
                $request->session()->put('sales_table', $session_data);
                return json_encode(array('sales_table'=>$session_data,'msg'=>'',
                    'grand_total'=>$grand_total));
            }
            else
            {
                return json_encode(array('sales_table'=>array(),'msg'=>'Out of stock...!'));
            }
        }
        else
        {
            return json_encode(array('sales_table'=>array(),'msg'=>'Please check your code and try again!'));
        }

    }


    public function remove(Request $request)
    {
       
        $code = $request->pcode;
        $barcode = $request->bar_code;
        //return json_encode(array('product_code'=>$code,'msg'=>'found'));

        $data = $request->session()->get('sales_table');

        if(empty($data))
        {
            $session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $session_data = $data;
            }
            else
            {
                $session_data = array();
            }
        }

        foreach($session_data as $key => $sd){
            if($sd['barcode'] == $barcode){
                unset($session_data[$key]);
                break;
            }
        }

        $grand_total = 0;
        foreach($session_data as $sd)
        {
            $grand_total +=  $sd['total'];
        }
        // $request->session()->put('sales_table', $session_data);
        // return json_encode(array('sales_table'=>$session_data,'msg'=>'',
        //     'grand_total'=>$grand_total));  

        $request->session()->put('sales_table', $session_data);
        return json_encode(array('msg'=>'', 'grand_total'=>$grand_total,'barcode'=>$barcode));  
    }
    public function allremove(Request $request)
    {
        $request->session()->forget('sales_table');
        $grand_total = 0;
        $request->session()->put('sales_table', '');
        return json_encode(array('sales_table'=> '','msg'=>'Removed Successfully!',
            'grand_total'=>$grand_total));
        
    }
// gg
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'grand_total' => 'required|gt:0',
            'change_amount' => 'required',
            'paid' => 'required',
            'township_id' => 'required',
        ]);
        if($request->paid < $request->grand_total) {
            return redirect()->back()->with('price_error', 'Please Paid Full!');
        }  
        $data = $request->session()->get('sales_table');
        // print_r($data);exit;

        if(empty($data))
        {
            $session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $session_data = $data;
            }
            else
            {
                $session_data = array();
            }
        }
        $totalqty = 0;
        
        foreach($session_data as $key => $sd){
            $product = Product::find($sd['product_id']);

            if($product->qty < $sd['quantity'])
            {
                return redirect()->back()->with('price_error', $product->name . ' is not enough quantity!');
            }

            $product->update([
                'qty' => $product->qty - $sd['quantity']
            ]);
            $product_detail = ProductDetail::where('Barcode', $sd['barcode']);
            $product_detail->update([
                'status' => 1
            ]);
            
            $totalqty += $sd['quantity'];
            
        }

        $y = date('y');
        $m = date('m');
        $d = date('d');
        $h = date('h');
        $i = date('i');
        $s = date('s');
        $random = $y.$m.$d.$h.$i.$s;
        $shuffled = str_shuffle($random);
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'township_id' => $request->township_id,
            'invoice_no' => $shuffled,
            'qty' => $totalqty,
            'total_price' => $request->grand_total,
            'paid' => $request->paid,
            'r_change' => $request->change_amount,
            'discount' => $request->discount,
            'date' => date('Y-m-d'),
        ]);
        foreach($session_data as $key => $sd) {
            $saleDetails = SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $sd['product_id'],
                'Barcode' => $sd['barcode'],
                'qty' => $sd['quantity'],
                'total_price' => $sd['price'] * $sd['quantity']

            ]);
            
            $stock_checks = Stock::where('product_id', $sd['product_id'])->get();
            foreach($stock_checks as $stock_check)
            {
                $stock_check->update([
                    'r_qty' => $stock_check->r_qty - $sd['quantity']
                ]);
            }
        }
        

        $sale = Sale::find($sale->id);
        // $saleDetail = $sale->saleDetail;

        $saleDetail = SaleDetail::where('sale_id', $sale->id)
                                ->select('product_id', DB::raw("SUM(qty) as tqty"), DB::raw("SUM(total_price) as tp"))
                                ->groupBy('product_id')->get();
                                
        // dd($saleDetail);
        $request->session()->forget('sales_table');
        $data = session()->get('session_data');

        if(empty($data))
        {
            $session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $session_data = $data;
            }
            else
            {
                $session_data = array();
            }
        }

        $townships = Township::all();
        // return json_encode(array('sale'=> $sale, 'saleDetails'=> $saleDetails, 'msg'=>'Success!'));
        return view('sales.index', \compact('sale', 'session_data', 'saleDetail','townships'))->with('saleSuccess', 'Successfully!');
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
