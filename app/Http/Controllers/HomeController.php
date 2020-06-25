<?php

namespace App\Http\Controllers;

use App\AladdinProduct;
use Illuminate\Http\Request;
use App\Categories;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

//    Master Page
    public function kitchenvenus()
    {
        $categories = Categories::all();
        return view('kitchenVenus.index', compact('categories'));
    }
//  End Master Page

    public function category($id)
    {
        // dd($id);
        $categories = Categories::all();
        $products = Product::where('category_id', $id)->get();
        return view('kitchenVenus.index', \compact('categories', 'products'));
    }
    public function about()
    {
        $categories = Categories::all();
        $about = '';
        return view('kitchenVenus.index', \compact('categories', 'about'));
    }
    public function contact()
    {
        $contact = '';
        $categories = Categories::all();
        return view('kitchenVenus.index', \compact('categories', 'contact'));
    }
    public function search(Request $request)
    {
        $categories = Categories::all();
        if ($request->search_product == null){
            $search_p = AladdinProduct::where('category_id', $request->ddl_product)->get();
        }else{
            $search_p = AladdinProduct::where('name', 'LIKE', "%{$request->search_product}%")->get();
            $s_count = count($search_p);
        }

        return view('kitchenVenus.search', \compact('categories', 's_count', 'search_p'));
    }
}
