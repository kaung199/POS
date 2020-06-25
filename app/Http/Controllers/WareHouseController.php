<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WareHouse;
use App\WarehouseQty;
use Auth;
use DB;

class WareHouseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase-list|purchase-create|purchase-edit|purchase-delete', ['only' => ['index','store']]);
        $this->middleware('permission:purchase-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $stocks = WareHouse::where('date', date('Y-m-d'))->orderBy('id','DESC')->get();
        $product = Product::orderBy('id', 'desc')->get();
        return view('warehouse.index', compact('stocks', 'product'));
    }
    public function qty()
    {
        $stocks = WareHouse::select('product_id', DB::raw("SUM(min) as tqty"))
                                ->groupBy('product_id')->get();
        // $stocks = WarehouseQty::orderBy('id','DESC')->get();
        return view('warehouse.qty', compact('stocks'));
    }

    public function search(Request $request)
    {
        $stocks = WareHouse::whereBetween('date', [$request->start_date, $request->end_date])->orderBy('id','DESC')->get();
        $product = Product::orderBy('id', 'desc')->get();
        return view('warehouse.index', compact('stocks', 'product'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'qty' => 'required',
        ]);
        $stock = WareHouse::create(
            [
                'product_id' => $request->product_id,
                'qty' => $request->input('qty'),
                'min' => $request->input('qty'),
                'date' => date('Y-m-d'),
                'user_id' => Auth::user()->id
            ]);
            $wqty = WareHouseQty::where('product_id',$request->product_id)->first();
            if($wqty == null) {
                WareHouseQty::create(
                    [
                        'product_id' => $request->product_id,
                        'qty' => $request->input('qty'),
                    ]);
            } else {
                $wqty->update([
                    'qty' => $wqty->qty + $request->input('qty')
                ]);
            }
       

        return redirect()->route('warehouse')
            ->with('success','WareHouse added successfully');
    }
    public function destroy($id)
    {
        $stock = WareHouse::find($id);
        $wqty = WareHouseQty::where('product_id',$stock->product_id)->first();
        $wqty->update([
            'qty' => $wqty->qty - $stock->qty
        ]);
        $stock->delete();
        return redirect()->route('warehouse')
            ->with('success','Deleted successfully');
    }
}
