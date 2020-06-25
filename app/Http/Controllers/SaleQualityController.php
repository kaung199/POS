<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use Session;

class SaleQualityController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function data(Request $request)
    {
        $change_qty = $request->qty;
        $code       = $request->code;

        $product = Product::where('name', $code)->first();

        if($product->qty >= $change_qty)

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
                }
                else
                {
                    $session_data = array();
                }
            }

            foreach($session_data as $key => $sd){
                if($sd['code'] == $code){
                    $session_data[$key]['quantity'] = $change_qty;
                    $session_data[$key]['total']    = $change_qty * $sd['price'];
                    break;
                }
            }

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
            return json_encode(array('sales_table'=>array(),'msg'=>'Out of stock!'));
        }


    }

    public function tsq_data(Request $request)
    {
        $change_qty = $request->qty;
        $code       = $request->code;

        $product = Product::where('name', $code)->first();

        if($product->qty >= $change_qty)

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
                }
                else
                {
                    $t_session_data = array();
                }
            }

            foreach($t_session_data as $key => $sd){
                if($sd['code'] == $code){
                    $t_session_data[$key]['quantity'] = $change_qty;
                    $t_session_data[$key]['total']    = $change_qty * $sd['price'];
                    break;
                }
            }

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
            return json_encode(array('t_sales_table'=>array(),'msg'=>'Out of stock!'));
        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
