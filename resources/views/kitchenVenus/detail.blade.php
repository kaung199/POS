@extends('kitchenVenus.master')
@section('head')
    <style type="text/css">
        .zawgyi{
            font-family:Zawgyi-One;
        }
    </style>
@endsection
@section('body')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li class="active">{{$product->name}}</li>
                </ul>
            </div><br/>
            <div class="content-wraper">
                <div class="container">
                    <div class="row single-product-area">
                        <div class="col-lg-5 col-md-6">
                            <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    @foreach($detail as $items)
                                        <div class="lg-image">
                                            <a class="popup-img venobox vbox-item" href="{{$items->filename}}" data-gall="myGallery">
                                                <img src="{{$items->filename}}" alt="product image">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="product-details-thumbs slider-thumbs-1">
                                    @foreach($detail as $items)
                                        <div class="sm-image"><img src="{{$items->filename}}" alt="product image thumb"></div>
                                    @endforeach
                                </div>

                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2>{{$product->name}}</h2>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">{{$product->price}} Ks</span>
                                    </div>
                                    <div class="product-desc zawgyi">
                                        <p>
                                            <span>{{$product->description}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection