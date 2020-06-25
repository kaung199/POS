<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>BarCode Products</title>
    <style>
        .wrap {
            width: 100%;
            margin-left: 0;
            padding-left: 0;
        }
        .wrap td {
            padding-right: 1em;
        }
        @media print {
            .no-prnt {
                display: none;
            }
            .wrap {
                width: 100%;
            }
            .pad {
                padding-left: 10px;
                padding-right: 13px;
            }
        }
        .price{
            padding-left: 6em;
        }
        .delivery_date{
            padding-left: 9.5em;
        }
        .pading-leftb {
            padding-left: 5px;
        }

    </style>

</head>
<body>
<div class="no-prnt">
    @if(Auth::user()->id == 1)
        <a href="{{route('login')}}" class="btn btn-primary">Back To Home</a>
    @endif
    @if(Auth::user()->id == 4)
        <a href="{{url('sales')}}" class="btn btn-primary">Back To Home</a>
    @endif
    <div class="container">
        <h3 class="text-center">" <u>Barcode Generate</u> "</h3>
        <br>
        <div class="row">
            <div class="col-md-6 shadow p-3">
                <form action="{{ route('barcodegenerate') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="category">Products</label>
                        <select class="form-control" name="product_id" style="width: 100%" required>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->code }} | {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-info">All Barcode</button>
                </form>
            </div>
            <div class="p-1"></div>
            <div class="col-md-5 shadow p-3">
                <form action="{{ route('mainbox_barcode') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="category">
                            MainBox
                            @if(session('NotFound'))
                                <div class="text-danger">
                                    Not Found...!
                                </div>
                            @endif
                        </label>
                        <input type="text" class="form-control" name="main_barcode" placeholder="Enter MainBox Barcode" autofocus>
                    </div>
                    <button class="btn btn-success">Generate</button>
                </form>
            </div>
        </div>

    </div>

</div>
@if(isset($barcode))
    <div class="Bshow">
        <div class="wrap">
            <div class="row">
                @php
                    $barcode["Barcode"] = preg_replace('/\s+/', '', $barcode["Barcode"]);
                    //dd(preg_replace('/\s+/', '', $barcode["Barcode"]));
                @endphp
                <div class="col mb-5 mt-3 pad">
                            <span class="barcodeFont price" style="font:bold 15px monospace;">
                                {{ $barcode["sale_price"] }} Ks
                            </span><br/>
                    <span class="text-center pl-3">
                                <b>{{ $barcode["name"] }}</b>
                            </span>
                    <br/>
                    <a href="{{ route('oneBarcodeGenerate',  $barcode["Barcode"])}}">
                        {{--<svg class="barcode d-block"--}}
                             {{--jsbarcode-format="ITF"--}}
                             {{--jsbarcode-value={!!  $barcode["Barcode"] !!}--}}
                                     {{--jsbarcode-textmargin="0"--}}
                             {{--jsbarcode-fontoptions="bold"--}}
                             {{--jsbarcode-font ="OCRB"--}}
                             {{--jsbarcode-fontSize ="18">--}}
                        {{--</svg>--}}
                        <svg id="barcode"
                             jsbarcode-value="{!!  $barcode["Barcode"] !!}">
                        </svg>
                    </a>

                    <br>
                </div>
            </div>
        </div>
    </div>
@endif
</body>
<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script type="text/javascript">
    JsBarcode("#barcode").init();
</script>
</html>
