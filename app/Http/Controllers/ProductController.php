<?php

namespace App\Http\Controllers;

use App\AladdinProduct;
use App\Product;
use App\MainBox;
use App\Categories;
use App\ProductDetail;
use App\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index','store']]);
        $this->middleware('permission:products-create', ['only' => ['create','store']]);
        $this->middleware('permission:products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:products-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        $products = Product::orderBy('id','DESC')->get();
        //        number auto increase
        $id = Product::latest()->first();
        if (isset($id)){
            $code = $id->id + 1;
            return view('products.index', compact('code', 'products', 'categories'));
        }
        return view('products.index', compact('products', 'categories'));
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
        // dd($request->all());
        $this->validate($request, [
            'code' => 'required|unique:products,code',
            'name' => 'required|unique:products,name',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'sale_price' => 'required|max:10',
            'category_id' => 'required',
        ]);

        $product = Product::create([
            'code' => str_pad($request->input('code') + 0, 4, 0, STR_PAD_LEFT),
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'sale_price' => $request->input('sale_price'),
            'description' => $request->input('description'),
            ]);

            // if(isset($request->photo)) {
            //         $filename = $request->photo->getClientOriginalName();
            //         Storage::disk('public')->put($filename, file_get_contents($request->photo));
            //         $product->update([
            //             'photo' => $filename,
            //         ]);
            // }

            if($request->photos) {
                foreach ($request->photos as $photo) {
                    $filename = $photo->getClientOriginalName();
                    Storage::disk('public')->put($filename, file_get_contents($photo));
                    Photo::create([
                        'product_id' => $product->id,
                        'filename' => $filename
                    ]);
                }
            }

        return redirect()->route('products.index')
            ->with('success','Product created successfully');
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
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'sale_price' => 'required|max:10',
            'category_id' => 'required',
        ]);
        $product = Product::find($id);
        $product->update($request->all());

        if($request->photos) {
            foreach($product->photos as $product_photo) {
                Storage::disk('public')->delete($product_photo->filename);
            }
            $product_photos = Photo::where('product_id', $product->id);
            $product_photos->delete();
            
            foreach ($request->photos as $photo) {
                $filename = $photo->getClientOriginalName();
                Storage::disk('public')->put($filename, file_get_contents($photo));
                Photo::create([
                    'product_id' => $product->id,
                    'filename' => $filename
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }

    public function detail($id){
        $product = Product::where('id', $id)->first();
        $product_detail = ProductDetail::where('product_id', $id)->get();
        if(collect($product_detail)->isEmpty()) {
            $product_detail = null;
        }
        $mainbox = MainBox::where('product_id', $id)->where('status', 2)->get();
        if(collect($mainbox)->isEmpty()) {
            $mainbox = null;
        }
        return view('products.detail', compact('product', 'product_detail', 'mainbox'));
    }

}
