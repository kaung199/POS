<?php

namespace App\Http\Controllers;

use App\MainBox;
use App\Product;
use App\Purchase;
use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase-list|purchase-create|purchase-edit|purchase-delete', ['only' => ['index','store']]);
        $this->middleware('permission:purchase-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchase = Purchase::where('delivery_date', date('Y-m-d'))->orderBy('id','DESC')->paginate(100);
        $product = Product::orderBy('id', 'desc')->get();
        return view('purchase.index', compact('purchase', 'product'));
    }

    public function pur_search(Request $request)
    {
        $purchase = Purchase::whereBetween('delivery_date', [$request->start_date, $request->end_date])->paginate(100);
        $product = Product::orderBy('id', 'desc')->get();
        $purchase->setPath('pur_search');
        return view('purchase.index', compact('purchase', 'product'));

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
        $this->validate($request, [
            'product_id'     => 'required',
            'qty' => 'required',
            'delivery_date'   => 'required',
        ]);

        $today = date("Ymd");
        $rand = sprintf("%04d", rand(0,9999));
        $unique = $today . $rand;

        $purchase = Purchase::create(
            [
                'product_id' => $request->product_id,
                'qty' => $request->input('qty'),
                'min_qty' => $request->input('qty'),
                'voucher' => $unique,
                'delivery_date' => $request->delivery_date,
                'user_id' => Auth::user()->id,
                'bad_qty' => 0,
                'status' => 1,
            ]);

        return redirect()->route('purchase.index')
            ->with('success','Purchase created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'min_qty' => 'required',
            'delivery_date'   => 'required',
        ]);

        $update_purchase = Purchase::find($purchase->id);
        $update_purchase->update([
            'status' => 2,
            'bad_qty' => $update_purchase->bad_qty + $request->bad_qty,
            'loss_qty' => $update_purchase->loss_qty + $request->loss_qty,
            'min_qty' => $update_purchase->min_qty - $request->bad_qty - $request->loss_qty,
        ]);

        return redirect()->route('purchase.index')
            ->with('success','Purchase updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        Purchase::where('id',$purchase->id)->delete();
        return redirect()->route('purchase.index')
            ->with('success','Purchase deleted successfully');
    }
    public function report(Request $request)
    {
        $purchase = Purchase::with('product', 'user')->orderBy('id','DESC')->get();
        return view('purchase.report', compact('purchase'));
    }
    public function search(Request $request)
    {
        $purchase = Purchase::whereBetween('delivery_date', [$request->start_date, $request->end_date])->get();
        $count = count($purchase);
        return view('purchase.report', compact('purchase', 'count'));
    }
    
}
