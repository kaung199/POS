<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Export;
use App\WareHouse;
use App\WarehouseQty;

class StockExportController extends Controller
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
        $stocks = Export::where('date', date('Y-m-d'))->orderBy('id','DESC')->get();
        $product = WareHouse::orderBy('id', 'desc')->whereNotIn('min', [0])->get();
        return view('exports.index', compact('stocks', 'product'));
    }
    public function search(Request $request)
    {
        $stocks = Export::whereBetween('date', [$request->start_date, $request->end_date])
                        ->where('status', $request->shop)->orderBy('id','DESC')->get();
        $product = WareHouse::orderBy('id', 'desc')->whereNotIn('min', [0])->get();
        return view('exports.index', compact('stocks', 'product'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'warehouse_id'     => 'required',
            'qty' => 'required',
            'status' => 'required'
        ]);

        $warehouse = WareHouse::find($request->warehouse_id);
        if($warehouse->min < $request->qty) {
            return \redirect()->back()->with('error', 'Qty must be less than or equal min_qty');
        }

        $warehouse->update([
            'min' => $warehouse->min - $request->qty
        ]);

        $wqty = WareHouseQty::where('product_id',$warehouse->product_id)->first();
        $wqty->update([
            'qty' => $wqty->qty - $request->qty
        ]);

        $stock = Export::create(
            [
                'product_id' => $warehouse->product_id,
                'warehouse_id' => $warehouse->id,
                'qty' => $request->input('qty'),
                'status' => $request->status,
                'date' => date('Y-m-d'),
                'user_id' => Auth::user()->id
            ]);

        return redirect()->route('stock-export')
            ->with('success','Export added successfully');
    }

    public function destroy($id)
    {
        $stock = Export::find($id);
        $warehouse = WareHouse::find($stock->warehouse_id);
        $warehouse->update([
            'min' => $warehouse->min + $stock->qty
        ]);

        $stock->delete();
        return redirect()->route('stock-export')
            ->with('success','Deleted successfully');
    }
}
