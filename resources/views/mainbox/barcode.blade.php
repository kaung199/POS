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
            margin-left: 15px;
            padding-left: 0;
        }
        .wrap td {
            padding-right: 1em;
        }
        .price_print {
            transform:rotate(90deg); 
            padding-top:10px; 
            padding-left:80px; 
            font:bold 25px monospace; 
            color:black;
        }
        
        @media print {
           
            .name_pad {
                margin-left: -20px !important;
            }
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
            .price_print{ 
                position: absolute;
                top: 85px; 
                left: 150px;
            }
        }
        .price{
            padding-left: 2em;
        }
        .delivery_date{
            padding-left: 9.5em;
        }
        .pading-leftb {
            padding-left: 5px;
        }

    </style>
    <script src="{{asset('js/JsBarcode.ean-upc.min.js')}}"></script>
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
                <button class="btn btn-info">Generate</button>
            </form>
        </div>

    </div>
</div>
@if(isset($pds))
    <div class="Bshow">
        <div class="wrap">
                <div class="row">
                    <div class="col mb-2 pad">
                        <span class="text-center pl-3 name_pad" style="font-size:25px;">
                                <b>{{ $pds["name"] }}</b>
                        </span>
                        <br/>
                            <svg id="barcode"
                                jsbarcode-format="CODE128"
                                jsbarcode-textmarginTop="3"
                                jsbarcode-fontoptions="bold"
                                jsbarcode-font ="monospace"
                                jsbarcode-fontSize ="25"
                                jsbarcode-value="{!!  $pds["code"] !!}">
                            </svg>   
                        <span>
                            <p class="price_print">{{ $pds["sale_price"] }} Ks</p>
                        </span>
                        <br>
                    </div>
                    <div class="col mb-2 pad">
                        <span class="text-center pl-3 name_pad" style="font-size:25px;">
                                <b>{{ $pds["name"] }}</b>
                        </span>
                        <br/>
                            <svg id="barcode"
                                jsbarcode-format="CODE128"
                                jsbarcode-textmarginTop="3"
                                jsbarcode-fontoptions="bold"
                                jsbarcode-font ="monospace"
                                jsbarcode-fontSize ="25"
                                jsbarcode-value="{!!  $pds["code"] !!}">
                            </svg>   
                        <span>
                            <p class="price_print">{{ $pds["sale_price"] }} Ks</p>
                        </span>
                        <br>
                    </div>
                    <div class="col mb-2 pad">
                        <span class="text-center pl-3 name_pad" style="font-size:25px;">
                                <b>{{ $pds["name"] }}</b>
                        </span>
                        <br/>
                            <svg id="barcode"
                                jsbarcode-format="CODE128"
                                jsbarcode-textmarginTop="3"
                                jsbarcode-fontoptions="bold"
                                jsbarcode-font ="monospace"
                                jsbarcode-fontSize ="25"
                                jsbarcode-value="{!!  $pds["code"] !!}">
                            </svg>   
                        <span>
                            <p class="price_print">{{ $pds["sale_price"] }} Ks</p>
                        </span>
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
