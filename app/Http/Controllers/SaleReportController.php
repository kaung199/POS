<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Sale;
use App\MainBox;
use App\SaleDetail;
use App\Product;
use App\Township;
use App\ProductDetail;
use DB;

use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    //
    public function saleReport(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $townships = Township::all();
        $sale = Sale::where('date', $today)->where('transfer_status', null)->latest()->get();
        return view('report.saleReport', \compact('sale', 'townships'));
    }
    public function t_Report(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $sale = Sale::where('date', $today)->where('transfer_status', 1)->latest()->get();
        return view('transfer.saleReport', \compact('sale'));
    }
    public function saleDetail($id)
    {
        $sale = Sale::find($id);
        return view('report.detail', \compact('sale'));
    }
    public function t_Detail($id)
    {
        $sale = Sale::find($id);
        return view('transfer.detail', \compact('sale'));
    }

    public function search(Request $request)
    {
        $townships = Township::all();
        if($request->township_id == null) {
            $sale = Sale::whereBetween('date', [$request->start_date, $request->end_date])->where('transfer_status', null)->get();
        } else {
            $sale = Sale::whereBetween('date', [$request->start_date, $request->end_date])->where('township_id', $request->township_id)->where('transfer_status', null)->get();
        }
        $count = count($sale);
        return view('report.saleReport', \compact('sale', 'count', 'townships'));
    }
    public function t_search(Request $request)
    {
        $sale = Sale::whereBetween('date', [$request->start_date, $request->end_date])->where('transfer_status', 1)->get();
        $count = count($sale);
        return view('transfer.saleReport', \compact('sale', 'count'));
    }

    public function barcodegenerate(Request $request)
    {

        $pds = Product::find($request->product_id);
        $products = Product::whereNotIn('qty', [0])->get();
        return view('mainbox.barcode', compact('products', 'pds'));
    }
    public function oneBarcodeGenerate($id)
    {
        $barcode = ProductDetail::join('products', 'product_details.product_id', '=', 'products.id')
        ->where('Barcode', $id)
        ->where('status', null)
        ->first();
        $products = Product::whereNotIn('qty', [0])->get();
        return view('mainbox.one_barcode', compact('products', 'barcode'));
    }

    public function barcode()
    {
        $products = Product::whereNotIn('qty', [0])->get();
        return view('mainbox.barcode', compact('products'));
    }

    public function mainbox_barcode(Request $request)
    {
        $mainbox = MainBox::where('Barcode', $request->main_barcode)->first();
        if($mainbox == null) {
            return redirect()->back()->with('NotFound', 'Not Found');
        }
        // dd($mainbox->product_id);
        $pds = ProductDetail::join('products', 'product_details.product_id', '=', 'products.id')
                            ->where('product_details.mainBox_id', $mainbox->id)
                            ->where('status', null)->get();
        if(collect($pds)->isEmpty()) {
            return redirect()->back()->with('NotFound', 'Not Found');
        }
        $products = Product::whereNotIn('qty', [0])->get();
        return view('mainbox.barcode', compact('products', 'pds'));
    }

    public function dailytotal(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;
        $saleDetails = SaleDetail::where('transfer_status', null)->whereBetween(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), [$from, $to])
                                ->select('product_id', DB::raw("SUM(qty) as tqty"), DB::raw("SUM(total_price) as tp"))
                                ->groupBy('product_id')->get();
        return view('report.totalsale', compact('saleDetails'));
    }
    public function t_dailytotal(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;
        $transfer = 't';
        $saleDetails = SaleDetail::where('transfer_status', 1)->whereBetween(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), [$from, $to])
                                ->select('product_id', DB::raw("SUM(qty) as tqty"), DB::raw("SUM(total_price) as tp"))
                                ->groupBy('product_id')->get();
        return view('report.totalsale', compact('saleDetails', 'transfer'));
    }
}
