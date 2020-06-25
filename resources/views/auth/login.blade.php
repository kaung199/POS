<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login | POS ...</title>
    <link rel="shortcut icon" href="{{asset('pos.png')}}">
    <!--STYLESHEET-->
    <!--=================================================-->
    <!--Roboto Slab Font [ OPTIONAL ] -->
    <link href="{{asset('pos/css/googlefonts.css')}}" rel="stylesheet">
    <link href="{{asset('pos/css/googlefonts1.css')}}" rel="stylesheet">
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
    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('pos/css/demo/jasmine.css')}}" rel="stylesheet">
    <!--SCRIPT-->
    <!--=================================================-->
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="{{asset('pos/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('pos/plugins/pace/pace.min.js')}}"></script>
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
<div id="container" class="cls-container">
    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="lock-wrapper">
        <div class="panel lock-box">
            <div class="center"> <img alt="" src="{{asset('pos/img/user.png')}}" class="img-circle"/> </div>
            <h4> Hello User !</h4>
            <p class="text-center">Please login to Access your Account</p>
            <div class="row">
                <form method="POST" action="{{ route('login') }}" class="form-inline">
                    @csrf
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="text-left">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                 <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                            <br/>
                            <label for="email" class="text-muted">{{ __('E-Mail') }}</label>
                            <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>

                        <div class="text-left">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                            <br/>
                            <label for="password" class="text-muted">{{ __('Password') }}</label>
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        <div class="pull-left pad-btm">
                            <label class="form-checkbox form-icon form-text" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">
                            {{ __('Sign In') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
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
<!--Switchery [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/switchery/switchery.min.js')}}"></script>
<!--Bootstrap Select [ OPTIONAL ]-->
<script src="{{asset('pos/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
</body>
</html>
