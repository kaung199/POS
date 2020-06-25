<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{asset('pos/css/demo/jasmine.css')}}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Box</title>
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
    </style>

</head>
<body>
<div class="no-prnt">
    <a href="{{route('login')}}" class="btn btn-primary">Back To Home</a>
    <h3 class="text-center">MainBox Barcode Generate</h3>
</div>
@if(isset($mainboxes))
    <div class="Bshow">
        <div class="wrap">
            @php
                $pdChunks = $mainboxes->chunk(3)->toArray();
                // dd($pdChunks);
            @endphp
            @foreach($pdChunks as $pd)
                <div class="row">
                    @foreach($pd as $barcode)
                        @php
                            $newDate = date("Y-m-d", strtotime($barcode["created_at"]));
                            // dd($newDate);  
                            $barcode["Barcode"] = preg_replace('/\s+/', '', $barcode["Barcode"]);
                            // dd($barcode["Barcode"]);
                        @endphp
                        <div class="col mb-5 mt-3 pad">
                            <span class="barcodeFont price" style="font:bold 15px monospace;">
                                {{ $barcode["code"] }} || {{ $newDate }}
                            </span><br/>
                            <span class="delivery_date" style="font:bold 15px monospace;">
                                MainBox</span>

                            <div class="pl-5">
                                <svg class="barcode d-block"
                                    jsbarcode-format="auto"
                                    jsbarcode-value={!!  $barcode["Barcode"] !!}
                                    jsbarcode-textmargin="0"
                                    jsbarcode-fontoptions="bold"
                                    jsbarcode-font ="OCRB"
                                    jsbarcode-fontSize ="18">
                                </svg>
                            </div>

                            
                            
                            {{-- <svg class="barcode"
                                jsbarcode-format="upc"
                                jsbarcode-value="123456789012"
                                jsbarcode-textmargin="0"
                                jsbarcode-fontoptions="bold">
                            </svg> --}}

                            <br>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif
</body>
<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script type="text/javascript">
    JsBarcode(".barcode").init();
</script>
</html>
