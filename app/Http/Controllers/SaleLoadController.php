<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SaleLoadController extends Controller
{
//    public function __construct() {
//        $this->middleware("auth");
//    }

    public function barcode(Request $request) 
    {
        dd($request->all());
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
            }
            else
            {
                $session_data = array();
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

    //transfer
    public function t_data(Request $request)
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

        $grand_total = 0;
        foreach($t_session_data as $sd)
        {
            $grand_total +=  $sd['total'];
        }
        $request->session()->put('t_sales_table', $t_session_data);
        return json_encode(array('t_sales_table'=>$t_session_data,'msg'=>'',
            'grand_total'=>$grand_total));

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
