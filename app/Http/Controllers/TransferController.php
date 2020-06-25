<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Township;
use DB;
use App\Product;
use App\ProductDetail;
use Illuminate\Support\Str;
use App\SaleDetail;
use Session;
use Auth;
use App\Stock;

class TransferController extends Controller
{
    public function index()
    {
        //
        $data = session()->get('t_session_data');

        if(empty($data))
        {
            $t_session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $t_session_data = $data;
            }
            else
            {
                $t_session_data = array();
            }
        }
        $townships = Township::all();
        return view('transfer.index', compact('t_session_data', 'townships'));
    }

    public function data(Request $request)
    {
        $data = $request->session()->get('t_sales_table');
        
        if(empty($data))
        {
            $t_session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $t_session_data = $data;
                //print_r($t_session_data);exit;
            }
            else
            {
                $t_session_data = array();
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
                foreach($t_session_data as $key =>$sd)
                {
                    if($sd['barcode']==$barcode)
                    {
                        return json_encode(array('t_sales_table'=>array(),'msg'=>'Aready Exists!'));
                    }

                }

                $t_session_data[] = array('product_id'=>$product_id,'sale_price'=>$sale_price,'code'=>$code,'name'=>$name,'quantity'=>1,'price'=>$price, 'total'=>1*$price, 'barcode'=> $barcode);
                // return json_encode(array('success'=>'Added Successfully!'));

                $grand_total = 0;
                foreach($t_session_data as $sd)
                {
                    $grand_total +=  $sd['total'];
                }
                $request->session()->put('t_sales_table', $t_session_data);
                return json_encode(array('t_sales_table'=>$t_session_data,'msg'=>'',
                    'grand_total'=>$grand_total));
            }
            else
            {
                return json_encode(array('t_sales_table'=>array(),'msg'=>'Out of stock...!'));
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
                foreach($t_session_data as $key =>$sd)
                {
                    if($sd['code'] == $code){

                        if( $quantity <= $t_session_data[$key]['quantity'] ) {
                            return json_encode(array('t_sales_table'=>array(),'msg'=>'Out Of Stock!'));
                        }

                        $t_session_data[$key]['quantity'] =  $sd['quantity'] +1;
                        $t_session_data[$key]['total']    = $t_session_data[$key]['quantity'] * $sd['price'];
                        $grand_total = 0;
                        foreach($t_session_data as $sd)
                        {
                            $grand_total +=  $sd['total'];
                        }
                        $request->session()->put('t_sales_table', $t_session_data);
                        return json_encode(array('t_sales_table'=>$t_session_data,'msg'=>'',
                            'grand_total'=>$grand_total));
                        break;
                    }
                }

                $t_session_data[] = array('product_id'=>$product_id,'sale_price'=>$sale_price,'code'=>$code,'name'=>$name,'quantity'=>1,'price'=>$price, 'total'=>1*$price, 'barcode'=> $barcode);
                // return json_encode(array('success'=>'Added Successfully!'));

                $grand_total = 0; 
                foreach($t_session_data as $sd)
                {
                    $grand_total +=  $sd['total'];
                }
                $request->session()->put('t_sales_table', $t_session_data);
                return json_encode(array('t_sales_table'=>$t_session_data,'msg'=>'',
                    'grand_total'=>$grand_total));
            }
            else
            {
                return json_encode(array('t_sales_table'=>array(),'msg'=>'Out of stock...!'));
            }
        }
        else
        {
            return json_encode(array('t_sales_table'=>array(),'msg'=>'Please check your code and try again!'));
        }

    }


    public function remove(Request $request)
    {
       
        $code = $request->pcode;
        $barcode = $request->bar_code;
        //return json_encode(array('product_code'=>$code,'msg'=>'found'));

        $data = $request->session()->get('t_sales_table');

        if(empty($data))
        {
            $t_session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $t_session_data = $data;
            }
            else
            {
                $t_session_data = array();
            }
        }

        foreach($t_session_data as $key => $sd){
            if($sd['barcode'] == $barcode){
                unset($t_session_data[$key]);
                break;
            }
        }

        $grand_total = 0;
        foreach($t_session_data as $sd)
        {
            $grand_total +=  $sd['total'];
        }
        // $request->session()->put('t_sales_table', $t_session_data);
        // return json_encode(array('t_sales_table'=>$t_session_data,'msg'=>'',
        //     'grand_total'=>$grand_total));  

        $request->session()->put('t_sales_table', $t_session_data);
        return json_encode(array('msg'=>'', 'grand_total'=>$grand_total,'barcode'=>$barcode));  
    }
    public function allremove(Request $request)
    {
        $request->session()->forget('t_sales_table');
        $grand_total = 0;
        $request->session()->put('t_sales_table', '');
        return json_encode(array('t_sales_table'=> '','msg'=>'Removed Successfully!',
            'grand_total'=>$grand_total));
        
    }
// gg
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'grand_total' => 'required|gt:0',
        ]); 
        $data = $request->session()->get('t_sales_table');
        // print_r($data);exit;

        if(empty($data))
        {
            $t_session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $t_session_data = $data;
            }
            else
            {
                $t_session_data = array();
            }
        }
        $totalqty = 0;
        
        foreach($t_session_data as $key => $sd){

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
            'invoice_no' => $shuffled,
            'qty' => $totalqty,
            'paid' => 0,
            'r_change' => 0,
            'transfer_status' => 1,
            'total_price' => $request->grand_total,
            'date' => date('Y-m-d'),
        ]);
        foreach($t_session_data as $key => $sd) {
            $saleDetails = SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $sd['product_id'],
                'Barcode' => $sd['barcode'],
                'qty' => $sd['quantity'],
                'total_price' => $sd['price'] * $sd['quantity'],
                'transfer_status' => 1,
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
        $request->session()->forget('t_sales_table');
        $data = session()->get('t_session_data');

        if(empty($data))
        {
            $t_session_data = array();
        }
        else
        {
            if(is_array($data))
            {
                $t_session_data = $data;
            }
            else
            {
                $t_session_data = array();
            }
        }
        // return json_encode(array('sale'=> $sale, 'saleDetails'=> $saleDetails, 'msg'=>'Success!'));
        return view('transfer.index', \compact('sale', 't_session_data', 'saleDetail'))->with('saleSuccess', 'Successfully!');
        
    }
}
