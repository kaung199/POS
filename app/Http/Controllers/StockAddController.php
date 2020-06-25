<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\StockAdd;
use Auth;

class StockAddController extends Controller
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
        $stocks = StockAdd::where('date', date('Y-m-d'))->orderBy('id','DESC')->get();
        $product = Product::orderBy('id', 'desc')->get();
        return view('StockAdd.index', compact('stocks', 'product'));
    }
    public function search(Request $request)
    {
        $stocks = StockAdd::whereBetween('date', [$request->start_date, $request->end_date])->orderBy('id','DESC')->get();
        $product = Product::orderBy('id', 'desc')->get();
        return view('stockAdd.index', compact('stocks', 'product'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'qty' => 'required',
        ]);
        $product = Product::find($request->product_id);
        $product->update([
            'qty' => $product->qty + $request->qty
        ]);
        $stock = StockAdd::create(
            [
                'product_id' => $request->product_id,
                'qty' => $request->input('qty'),
                'date' => date('Y-m-d'),
                'user_id' => Auth::user()->id
            ]);

        return redirect()->route('stock-add')
            ->with('success','Stock added successfully');
    }
    public function destroy($id)
    {
        $stock = StockAdd::find($id);
        $product = Product::find($stock->product_id);
        $product->update([
            'qty' => $product->qty - $stock->qty
        ]);
        $stock->delete();
        return redirect()->route('stock-add')
            ->with('success','Deleted successfully');
    }
}
