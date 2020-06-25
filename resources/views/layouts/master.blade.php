<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> POS </title>
    <link rel="shortcut icon" href="{{asset('pos.png')}}">
    <!--STYLESHEET-->
    <!--=================================================-->
    <!--Roboto Slab Font [ OPTIONAL ] -->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400" rel="stylesheet">
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('pos/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Jasmine Stylesheet [ REQUIRED ]-->
    <link href="{{asset('pos/css/style.css')}}" rel="stylesheet">
    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--Switchery [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <!--Bootstrap Table [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('pos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('pos/css/demo/jasmine.css')}}" rel="stylesheet">
    <!--SCRIPT-->
    <!--=================================================-->
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('pos/plugins/pace/pace.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('pos/css/select2.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @yield('head')
</head>
<body>
<div id="container" class="effect mainnav-full">
    <!--NAVBAR-->
    <!--===================================================-->
    <header id="navbar">
        <div id="navbar-container" class="boxed">
            <!--Brand logo & name-->
            <!--================================-->
            <div class="navbar-header">
                <a href="{{route('home')}}" class="navbar-brand">
                    <i class="fa fa-shopping-cart brand-icon"></i>
                    <div class="brand-title">
                        <span class="brand-text">POS System</span>
                    </div>
                </a>
            </div>
            <!--================================-->
            <!--End brand logo & name-->
            <!--Navbar Dropdown-->
            <!--================================-->
            <div class="navbar-content clearfix">
                <ul class="nav navbar-top-links pull-left">
                    <!--Messages Dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <i class="fa fa-envelope fa-lg"></i>
                            <span class="badge badge-header badge-warning">9</span>
                        </a>
                        <!--Message dropdown menu-->
                        <div class="dropdown-menu dropdown-menu-md with-arrow">
                            <div class="pad-all bord-btm">
                                <div class="h4 text-muted text-thin mar-no">You have 3 messages.</div>
                            </div>
                            <div class="nano scrollable">
                                <div class="nano-content">
                                    <ul class="head-list">
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">

                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av2.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Andy sent you a message</div>
                                                    <small class="text-muted">15 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av4.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Lucy sent you a message</div>
                                                    <small class="text-muted">30 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av3.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Jackson sent you a message</div>
                                                    <small class="text-muted">40 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av6.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Donna sent you a message</div>
                                                    <small class="text-muted">5 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av4.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Lucy sent you a message</div>
                                                    <small class="text-muted">Yesterday</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left">
                                                    <img src="{{asset('pos/img/av3.png')}}" alt="Profile Picture" class="img-circle img-sm">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Jackson sent you a message</div>
                                                    <small class="text-muted">Yesterday</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Dropdown footer-->
                            <div class="pad-all bord-top">
                                <a href="#" class="btn-link text-dark box-block">
                                    <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Messages
                                </a>
                            </div>
                        </div>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End message dropdown-->
                    <!--Notification dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> <i class="fa fa-bell fa-lg"></i> <span class="badge badge-header badge-danger">5</span> </a>
                        <!--Notification dropdown menu-->
                        <div class="dropdown-menu dropdown-menu-md with-arrow">
                            <div class="pad-all bord-btm">
                                <div class="h4 text-muted text-thin mar-no"> Notification </div>
                            </div>
                            <div class="nano scrollable">
                                <div class="nano-content">
                                    <ul class="head-list">
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left"> <span class="icon-wrap icon-circle bg-primary"> <i class="fa fa-comment fa-lg"></i> </span> </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">New comments waiting approval</div>
                                                    <small class="text-muted">15 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <span class="badge badge-success pull-right">90%</span>
                                                <div class="media-left"> <span class="icon-wrap icon-circle bg-danger"> <i class="fa fa-hdd-o fa-lg"></i> </span> </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">HDD is full</div>
                                                    <small class="text-muted">50 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left"> <span class="icon-wrap icon-circle bg-info"> <i class="fa fa-file-word-o fa-lg"></i> </span> </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Write a news article</div>
                                                    <small class="text-muted">Last Update 8 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <span class="label label-danger pull-right">New</span>
                                                <div class="media-left"> <span class="icon-wrap icon-circle bg-purple"> <i class="fa fa-comment fa-lg"></i> </span> </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Comment Sorting</div>
                                                    <small class="text-muted">Last Update 8 hours ago</small>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#" class="media">
                                                <div class="media-left"> <span class="icon-wrap icon-circle bg-success"> <i class="fa fa-user fa-lg"></i> </span> </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">New User Registered</div>
                                                    <small class="text-muted">4 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Dropdown footer-->
                            <div class="pad-all bord-top">
                                <a href="#" class="btn-link text-dark box-block"> <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Notifications </a>
                            </div>
                        </div>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End notifications dropdown-->
                </ul>
                <ul class="nav navbar-top-links pull-right">
                    <!--Profile toogle button-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="hidden-xs" id="toggleFullscreen">
                        <a class="fa fa-expand" data-toggle="fullscreen" href="#" role="button">
                            <span class="sr-only">Toggle fullscreen</span>
                        </a>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Profile toogle button-->
                    <!--User dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li id="dropdown-user" class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                            <span class="pull-right"> <img class="img-circle img-user media-object" src="{{asset('pos.png')}}" alt="Profile Picture"> </span>
                            <div class="username hidden-xs">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right with-arrow">
                            <!-- User dropdown menu -->
                            <ul class="head-list">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End user dropdown-->
                </ul>
            </div>
            <!--================================-->
            <!--End Navbar Dropdown-->
            <nav class="navbar navbar-default megamenu">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle">
                        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end navbar-header -->
                <div id="defaultmenu" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- standard drop down -->
                        @if(Auth::user()->id == 1)
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-gear fa-fw"></i> Settings <b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('roles.index') }}">Roles </a></li>
                                    @if(Auth::user()->id == 1)
                                    <li><a href="{{ route('users.index') }}">Users</a></li>
                                    @endif
                                </ul>
                                <!-- end dropdown-menu -->
                            </li>
                        @endif
                            <!-- end standard drop down -->
                        @if(Auth::user()->id == 6 || Auth::user()->id == 1)
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-apple fa-fw"></i> Initialized <b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('categories.index') }}">Categories </a></li>
                                    <li><a href="{{ route('products.index') }}">Products </a></li>
                                    <li><a href="{{ route('townships') }}">Townships </a></li>
                                </ul>
                                <!-- end dropdown-menu -->
                            </li>
                            @if(Auth::user()->id == 1)
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle zawgyi-one"><i class="fa fa-plus fa-fw"></i> Stock Add <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('stock-add') }}">Stock Add </a></li>
                                    </ul>
                                    <!-- end dropdown-menu -->
                                </li>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle zawgyi-one"><i class="fa fa-home fa-fw"></i> Warehouse<b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('warehouse') }}">Warehouse Add </a></li>
                                        <li><a href="{{ route('stock-export') }}">Export</a></li>
                                        <li><a href="{{ route('warehouse-getqty') }}">Warehouse Qty</a></li>
                                    </ul>
                                    <!-- end dropdown-menu -->
                                </li>
                            @endif
                        @endif
                        @if(Auth::user()->id == 1 ||Auth::user()->id == 4 || Auth::user()->id == 5)
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-plus fa-fw"></i> Shop <b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->id == 1 ||Auth::user()->id == 4)
                                        <li><a href="{{ route('local_shop') }}">Local Shop </a></li>
                                    @endif
                                    @if(Auth::user()->id == 4 ||Auth::user()->id == 6)
                                        <li><a href="{{ url('products') }}" >Products Lists </a></li>
                                    @endif
                                    @if(Auth::user()->id == 1 || Auth::user()->id == 5 ||Auth::user()->id == 6)
                                    <li><a href="{{ route('online_shop') }}">Online Shop </a></li>
                                    @endif
                                </ul>
                                <!-- end dropdown-menu -->
                            </li>
                        @endif
                        @if(Auth::user()->id == 4)
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-minus fa-fw"></i> Sale Voucher <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('sales.index') }}">Sale </a></li>
                                <li><a href="{{ route('transfer') }}">Transfer </a></li>
                            </ul>
                            <!-- end dropdown-menu -->
                        </li>
                        @endif
                        @if(Auth::user()->id == 1 || Auth::user()->id == 4)
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-print fa-fw"></i> Report <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('saleReport') }}">Sale Report</a></li>
                                <li><a href="{{ route('t_report') }}">Transfer Report</a></li>
                                @if(Auth::user()->id == 1)
                                    <li><a href="{{ route('dailytotal') }}">Daily TotalSale</a></li>
                                    <li><a href="{{ route('t_dailytotal') }}">Daily Total Transfer</a></li>
                                    <li><a href="{{ route('purchase_report') }}">Purchase Report</a></li>
                                @endif
                            </ul>
                            <!-- end dropdown-menu -->
                        </li>
                        @endif
                        @if(Auth::user()->id == 1 || Auth::user()->id == 6)
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-barcode fa-fw"></i> Barcode <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('barcode') }}">Barcode Generate</a></li>
                            </ul>
                            <!-- end dropdown-menu -->
                        </li>
                        @endif
                        @if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 4)
                            <li><a href="{{ route('stock-check') }}"><i class="fa fa-check fa-fw"></i> Stock Check</a></li>
                        @endif
                        @if(Auth::user()->id == 1)
                            <li><a href="{{route('aladdin_product')}}"><i class="fa fa-refresh fa-fw"></i> Sync Product </a></li>
                        @endif


</ul>
<!-- end nav navbar-nav -->
</div>
<!-- end #navbar-collapse-1 -->
</nav>
<!-- end navbar navbar-default megamenu -->
</div>
</header>
<!--===================================================-->
<!--END NAVBAR-->
<div class="boxed">
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
<div id="profilebody">
<div class="pad-all animated fadeInDown">
<div class="row">
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">Users</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-users fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">Inbox</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-envelope fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">FAQ</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-headphones fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">Settings</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-cogs fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">Calender</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-calendar fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
    <div class="panel panel-default mar-no">
        <div class="panel-body">
            <a href="JavaScript:void(0);">
                <div class="pull-left">
                    <p class="profile-title text-bricky">Pictures</p>
                </div>
                <div class="pull-right text-bricky"> <i class="fa fa-picture-o fa-4x"></i> </div>
            </a>
        </div>
    </div>
</div>
</div>
</div>
</div>
<br/><br/>
<!--Page content-->
<!--===================================================-->
<div id="page-content">
@yield('page-content')
</div>
<!--===================================================-->
<!--End page content-->
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
</div>
<!-- FOOTER -->
<!--===================================================-->
<footer id="footer">
<!-- Visible when footer positions are fixed -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="show-fixed pull-right">
<ul class="footer-list list-inline">
<li>
<p class="text-sm">SEO Proggres</p>
<div class="progress progress-sm progress-light-base">
<div style="width: 80%" class="progress-bar progress-bar-danger"></div>
</div>
</li>
<li>
<p class="text-sm">Online Tutorial</p>
<div class="progress progress-sm progress-light-base">
<div style="width: 80%" class="progress-bar progress-bar-primary"></div>
</div>
</li>
<li>
<button class="btn btn-sm btn-dark btn-active-success">Checkout</button>
</li>
</ul>
</div>
<!-- Visible when footer positions are static -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="hide-fixed pull-right pad-rgt">Currently v1</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Remove the class name "show-fixed" and "hide-fixed" to make the content always appears. -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<p class="pad-lft">&#0169; 2020 POS</p>
</footer>
<!--===================================================-->
<!-- END FOOTER -->
<!-- SCROLL TOP BUTTON -->
<!--===================================================-->
<button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
<!--===================================================-->
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->
<!--JAVASCRIPT-->
<!--=================================================-->
<!--jQuery [ REQUIRED ]-->
<script src="{{asset('pos/js/jquery-2.1.1.min.js')}}"></script>
<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{asset('pos/js/bootstrap.min.js')}}"></script>
<!--Fast Click [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/fast-click/fastclick.min.js')}}"></script>
<!--Jquery Nano Scroller js [ REQUIRED ]-->
<script src="{{asset('pos/plugins/nanoscrollerjs/jquery.nanoscroller.min.js')}}"></script>
<!--Metismenu js [ REQUIRED ]-->
<script src="{{asset('pos/plugins/metismenu/metismenu.min.js')}}"></script>
<!--Jasmine Admin [ RECOMMENDED ]-->
<script src="{{asset('pos/js/scripts.js')}}"></script>
<!--Switchery [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/switchery/switchery.min.js')}}"></script>
<!--Jquery Steps [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/parsley/parsley.min.js')}}"></script>
<!--Jquery Steps [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/jquery-steps/jquery-steps.min.js')}}"></script>
<!--Bootstrap Select [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<!--DataTables [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('pos/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('pos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<!--Bootstrap Wizard [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<!--Masked Input [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/masked-input/bootstrap-inputmask.min.js')}}"></script>
<!--Bootstrap Validator [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/bootstrap-validator/bootstrapValidator.min.js')}}"></script>
<!--Flot Chart [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/flot-charts/jquery.flot.min.js')}}"></script>
<script src="{{asset('pos/plugins/flot-charts/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('pos/plugins/flot-charts/jquery.flot.spline.js')}}"></script>
<script src="{{asset('pos/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('pos/plugins/moment-range/moment-range.js')}}"></script>
<script src="{{asset('pos/plugins/flot-charts/jquery.flot.tooltip.min.js')}}"></script>
<!--Flot Order Bars Chart [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
<!--Morris.js [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/morris-js/morris.min.js')}}"></script>
<script src="{{asset('pos/plugins/morris-js/raphael-js/raphael.min.js')}}"></script>
<!--Easy Pie Chart [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<!--Fullscreen jQuery [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/screenfull/screenfull.js')}}"></script>
<!--DataTables Sample [ SAMPLE ]-->
<script src="{{asset('pos/js/demo/tables-datatables.js')}}"></script>
<!--Form Wizard [ SAMPLE ]-->
<script src="{{asset('pos/js/demo/index.js')}}"></script>
<!--Form Wizard [ SAMPLE ]-->
<script src="{{asset('pos/js/demo/wizard.js')}}"></script>
<!--Form Wizard [ SAMPLE ]-->
<script src="{{asset('pos/js/demo/form-wizard.js')}}"></script>
<script src="{{asset('pos/js/select2.min.js')}}"></script>
@yield('script')
</body>
</html>
