<?php

namespace App\Http\Controllers;

use App\AladdinProduct;
use App\AladdinProductPhoto;
use App\Categories;
use Illuminate\Http\Request;

class KitchenVenusController extends Controller
{
    function load_data(Request $request){
        if ($request->ajax()){
            if ($request->id > 0){
                $data = AladdinProduct::where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(12)->get();
            }else{
                $data = AladdinProduct::inRandomOrder()->orderBy('id', 'DESC') ->limit(12)->get();
            }
            $output = '';
            $last_id = '';
            if (!$data->isEmpty()){
                foreach ($data as $row){
                    if(collect($row->photos)->isNotEmpty()) {
                        $html_photo = $row->photo;
                    } else {
                        $html_photo = asset('/cs.jpg');
                    }
                    $output .= '
                        <div class="col-lg-3 col-md-3 col-sm-5 mt-40">
                            <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="'.route('kvDetail', $row->id).'">
                                            <img src="'.$html_photo.'" alt="Li\'s Product Image">
                                        </a>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="'.route('kvDetail', $row->id).'">'.$row->name.'</a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a class="product_name" href="'.route('kvDetail', $row->id).'">'.$row->name.'</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">'.$row->price.' Ks</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="shopping-cart.html">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <!-- single-product-wrap end -->
                        </div>
                    ';
                    $last_id = $row->id;
                }

                $output .= '
                <div id="load_more" class="col-lg-12 mt-40">
                    <br/><br>
                   <button type="button" name="load_more_button"
                        class="btn btn-lg" data-id="'.$last_id.'" 
                        id="load_more_button" style="background: #ffc107; color: black; width: 100%;">
                        <i class="fa fa-spinner"></i> Load More
                    </button>
                </div>
            ';

            }else{
                $output .= '
                    <div id="load_more" class="col-lg-12 mt-40">
                        <button type="button" name="load_more_button" 
                        class="btn btn-lg" style="background: #ffebac; color: black; width: 100%;">
                                No data Found
                        </button>
                    </div>
                ';
            }


            echo $output;
        }
    }

    public function kvDetail($id){
        $categories = Categories::all();
        $product = AladdinProduct::where('id', $id)->first();
        $detail = AladdinProductPhoto::where('product_id', $id)->get();
        return view('kitchenVenus.detail', compact('categories', 'product', 'detail'));
    }
}
