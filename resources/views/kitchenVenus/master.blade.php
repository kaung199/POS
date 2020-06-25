<!doctype html>
<html lang="en">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kitchen Venus</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    {{--<meta name="description" content="">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('kitchenVenus/images/favicon.png')}}">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/material-design-iconic-font.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/font-awesome.min.css')}}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('kitchenVenus/css/responsive.css')}}">
    <!-- Modernizr js -->
    <script src="{{asset('kitchenVenus/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('kitchenVenus/fonts/Zawgyi-One_V3.1.ttf')}}">

    @yield('head')

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <a href="/">
                                <img src="{{asset('kitchenVenus/images/menu/logo/Untitled-1.jpg')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->

                        <form action="{{route('search')}}" class="hm-searchbox">
                            <select class="nice-select select-search-category" name="ddl_product">
                                <option value="0">All</option>
                                @foreach($categories as $items)
                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                @endforeach
                            </select>

                            <input name="search_product" type="text" placeholder="Enter your search products ...">
                            <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu">
                                <!-- Begin Header Middle Wishlist Area -->
                                <li class="hm-wishlist">
                                    <a href="wishlist.html">
                                        <span class="cart-item-count wishlist-item-count">0</span>
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </li>
                                <!-- Header Middle Wishlist Area End Here -->
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span class="item-text">£80.00
                                                    <span class="cart-item-count">2</span>
                                                </span>
                                    </div>
                                    <span></span>
                                    <div class="minicart">
                                        <ul class="minicart-product-list">
                                            <li>
                                                <a href="single-product.html" class="minicart-product-image">
                                                    <img src="{{asset('images/product/small-size/5.jpg')}}" alt="cart products">
                                                </a>
                                                <div class="minicart-product-details">
                                                    <h6><a href="single-product.html">Aenean eu tristique</a></h6>
                                                    <span>£40 x 1</span>
                                                </div>
                                                <button class="close" title="Remove">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <a href="single-product.html" class="minicart-product-image">
                                                    <img src="{{asset('images/product/small-size/6.jpg')}}" alt="cart products">
                                                </a>
                                                <div class="minicart-product-details">
                                                    <h6><a href="single-product.html">Aenean eu tristique</a></h6>
                                                    <span>£40 x 1</span>
                                                </div>
                                                <button class="close" title="Remove">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        <p class="minicart-total">SUBTOTAL: <span>£80.00</span></p>
                                        <div class="minicart-button">
                                            <a href="shopping-cart.html" class="li-button li-button-fullwidth li-button-dark">
                                                <span>View Full Cart</span>
                                            </a>
                                            <a href="checkout.html" class="li-button li-button-fullwidth">
                                                <span>Checkout</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu">
                            <nav>
                                <ul>
                                    <li ><a href="/">Home</a></li>
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area d-lg-none d-xl-none col-12">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu">
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    @yield('body')

    <!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-20 pb-20">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-5 col-md-6">
                            <ul class="des">
                                <li>
                                    <span>Address: </span>
                                    No(262), Bargayar Road, Myaynigone, Sanchaung Township, Yangon
                                </li>
                                <li>
                                    <span>Phone: </span>
                                    <a href="#">09-66 195 6600</a>
                                </li>
                                <li>
                                    <span>Opening Hours: </span>
                                    <a href="#">8:00 AM to 9:00 PM (Daily)</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Logo Area End Here -->

                        <div class="col-lg-2"></div>
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-5">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Follow Us</h3>
                                <ul class="social-link">
                                    <li class="twitter">
                                        <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com/Kitchen-Venus-104926781047049" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Middle Area End Here -->
    </div>
    <div class="col-md-12 text-center">
        <p>© Copyright 2020, Kitchen Venus. All Rights Reserved.</p>
    </div>
    <!-- Footer Area End Here -->
</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src="{{asset('kitchenVenus/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('kitchenVenus/js/vendor/popper.min.js')}}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{asset('kitchenVenus/js/bootstrap.min.js')}}"></script>
<!-- Ajax Mail js -->
<script src="{{asset('kitchenVenus/js/ajax-mail.js')}}"></script>
<!-- Meanmenu js -->
<script src="{{asset('kitchenVenus/js/jquery.meanmenu.min.js')}}"></script>
<!-- Wow.min js -->
<script src="{{asset('kitchenVenus/js/wow.min.js')}}"></script>
<!-- Slick Carousel js -->
<script src="{{asset('kitchenVenus/js/slick.min.js')}}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{asset('kitchenVenus/js/owl.carousel.min.js')}}"></script>
<!-- Magnific popup js -->
<script src="{{asset('kitchenVenus/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('kitchenVenus/js/isotope.pkgd.min.js')}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset('kitchenVenus/js/imagesloaded.pkgd.min.js')}}"></script>
<!-- Mixitup js -->
<script src="{{asset('kitchenVenus/js/jquery.mixitup.min.js')}}"></script>
<!-- Countdown -->
<script src="{{asset('kitchenVenus/js/jquery.countdown.min.js')}}"></script>
<!-- Counterup -->
<script src="{{asset('kitchenVenus/js/jquery.counterup.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('kitchenVenus/js/waypoints.min.js')}}"></script>
<!-- Barrating -->
<script src="{{asset('kitchenVenus/js/jquery.barrating.min.js')}}"></script>
<!-- Jquery-ui -->
<script src="{{asset('kitchenVenus/js/jquery-ui.min.js')}}"></script>
<!-- Venobox -->
<script src="{{asset('kitchenVenus/js/venobox.min.js')}}"></script>
<!-- Nice Select js -->
<script src="{{asset('kitchenVenus/js/jquery.nice-select.min.js')}}"></script>
<!-- ScrollUp js -->
<script src="{{asset('kitchenVenus/js/scrollUp.min.js')}}"></script>
<!-- Main/Activator js -->
<script src="{{asset('kitchenVenus/js/main.js')}}"></script>
@yield('script')

</body>

<!-- index30:23-->
</html>