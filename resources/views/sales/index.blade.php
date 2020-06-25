@extends('layouts.master')

@section('page-content')
    @can('products-list')
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <br/>
                        <h3 class="text-center"><b style="font-size: 30px">Sale (POS)</b></h3><hr/>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = session('price_error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                </div>
                                <input type="text" class="form-control" id="productcode" placeholder="Please Scan the Barcode & Product Name" autofocus/>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="panel-heading col-lg-12">
                            <h3 class="panel-title">Sale Lists</h3>
                        </div>

                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>Code</th>
                                    <td>Barcode</td>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <tbody id="sales_table">

                                @if(is_array($session_data))
                                    @foreach($session_data as $key => $value)
                                        <tr class="{{ $value['barcode'] }}">

                                            @foreach($value as $k => $v)
                                                <td>{{$v}}</td>
                                            @endforeach

                                            <td>
                                                <a class="btn btn-danger btn-xs _delete" id="{{ $value['barcode'] }}" data-rowid="{{ $value['code'] }}" data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('confirm') }}" method="POST">
                        @csrf 
                            <div class="row">
                                <label for="grand_total" class="col-sm-offset-6 col-sm-2 control-label">Grand-Total:</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class='form-control' name="grand_total" id="grand_total" required="required" readonly/>
                                        <span class="input-group-addon">Ks</span>
                                    </div>
                                </div><!--GrandTotal -->
                            </div><br/>

                            <div class="row">
                                <label for="paid" class="col-sm-offset-6 col-sm-2 control-label">Paid</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="0" name="paid" id="paid" required/>
                                        <span class="input-group-addon">Ks</span>
                                    </div>
                                </div><!--Paid -->
                            </div><br/>

                            <div class="row">
                                <label for="change_amount" class="col-sm-offset-6 col-sm-2 control-label">Return Change</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class='form-control' name="change_amount" id="change_amount" value="0" readonly>
                                        <span class="input-group-addon">Ks</span>
                                    </div>
                                </div><!--Return -->
                            </div><br/>

                            <div class="row">
                                <label for="discount" class="col-sm-offset-6 col-sm-2 control-label">Discount:</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class='form-control' name="discount" id="discount" value="0">
                                        <span class="input-group-addon">Ks</span>
                                    </div>
                                </div><!--Discount -->
                            </div><br/>
                            <div class="row">
                                <label for="township" class="col-sm-offset-6 col-sm-2 control-label">Townships:</label>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select class="form-control selectpicker" data-live-search="true" name="township_id" id="township" required>
                                            @foreach($townships as $town)
                                            <option value="{{ $town->id }}">
                                                {{ $town->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--townships -->
                            </div><br/><hr>
                            <div class="row">
                                <div class="demo-jasmine-btn panel-body col-md-offset-9">
                                    <a href="#" class="btn btn-danger" id="allremove" onclick="return confirm('Are you sure to remove?')"><span class="fa fa-remove"></span> Cancel</a>
                                    <!-- <button class="btn btn-pink" id="confirm"><span class="fa fa-check"></span> Confirm Sales</button> -->
                                    <button class="btn btn-pink"><span class="fa fa-check"></span>Confirm Sales</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <div class="printarea">
            @if(isset($sale))
                <h3 class="text-center">" <u>KITCHEN VENUS</u> "</h3>
                <p class="text-center">
                    No. 262 (Ground Floor), Bagaya Road, Sanchaung Township
                </p>
                <p class="text-center">
                    Myaynigone ,Yangon
                </p>
                <p class="text-center">09-661956600</p>
                <br>
                @php
                    $now = now();
                @endphp
                <table class="table">
                    <tr class="text-center">
                        <td><p><b>Date::</b> {{ $now }}</p></td>
                        <td><p><b>Bill No::</b> {{ $sale->invoice_no }}</p></td>
                    </tr>
                </table>
                
                
                

                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Totalprice</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($saleDetail as $d)
                
                <tr>
                    <td>{{  $d->product->name }}</td>
                    <td>{{  $d->tqty }}</td>
                    <td>{{  $d->product->sale_price }}</td>
                    <td>{{  $d->tp }}.00</td>
                </tr>
                @endforeach
                    <tr>
                        <td colspan="3" class="text-center"><h4>Grand Total</h4></td>
                        <td><h4>{{$sale->total_price}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><h4>Paid</h4></td>
                        <td><h4>{{$sale->paid}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><h4>Discount</h4></td>
                        <td><h4>{{$sale->discount}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><h4>Return Change</h4></td>
                        <td><h4>{{$sale->r_change}}</h4></td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <p>Thank You</p>
                    <p>Visit Again</p>
                </div>
                    @if(isset($d))
                        <script>
                            window.print();
                        </script>
                    @endif
            @endif
        </div>

    @endcan
@endsection

@section('script')
    <script type="text/javascript">
    $('button').click(function() {
        $('#productcode').focus();
    });
        
        //PageLoad
        $.get("{{ url('api/salesload/data') }}",
            {
            },
            function(data, status){
                // alert("Data: " + data + "\nStatus: " + status);
                var json = $.parseJSON(data);
                // alert(json);
                if(json.msg=="")
                {
                    $('#paid').val(0);
                    $('#change_amount').val("");
                    $("#sales_table").html();
                    var html = "";
                    $.each(json.sales_table,function(index,value){
                        //alert(value['code']);
                        var code = value['code'];
                        var barcode = value['barcode'];
                        var name = value['name'];
                        var quantity = value['quantity'];
                        var price = value['price'];
                        var total = value['total'];
                        html += '<tr class="'+barcode+'"><td>'+code+'</td><td>'+barcode+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align:center;" class="_qty" data-code="'+name+'" disabled></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" id="'+barcode+'" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                    });
                    $("#sales_table").html(html);
                    var grand_total = json.grand_total;
                    $('#grand_total').val(grand_total);
                    $('#paid').keyup(function(){
                        var paid = $('#paid').val();
                        var change_amount = paid - grand_total;
                        $('#change_amount').val(change_amount);
                    });
                    $('#productcode').val("");
                    $('#productcode').focus();
                }
                else
                {
                    //alert(json.msg);
                    swal({
                        title: "",
                        text: json.msg,
                        type: "warning"
                    });
                    $('#productcode').val("");
                    $('#productcode').focus();
                }
            });
        //add to list
        $("#productcode").keyup(function(e){
            if(e.keyCode == 13)
            {
                var productcode = $('#productcode').val();
                $.get("{{ url('api/sales/data') }}",
                    {
                        code: productcode
                    },
                    function(data, status){
                        // alert("Data: " + data + "\nStatus: " + status);
                        var json = $.parseJSON(data);
                        // alert(json);                      
                        if(json.msg=="")
                        {
                            $('#paid').val(0);
                            $('#change_amount').val("");
                            $("#sales_table").html();
                            var html = "";
                            $.each(json.sales_table,function(index,value){
                                //alert(value['code']);
                                var code = value['code'];
                                var barcode = value['barcode'];
                                var name = value['name'];
                                var quantity = value['quantity'];
                                var price = value['price'];
                                var total = value['total'];
                                html += '<tr class="'+barcode+'"><td>'+code+'</td><td>'+barcode+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+name+'" disabled></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" id="'+barcode+'" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                            });
                            $("#sales_table").html(html);
                            var grand_total = json.grand_total;
                            $('#grand_total').val(grand_total);
                            $('#paid').keyup(function(){
                                var paid = $('#paid').val();
                                var change_amount = paid - grand_total;
                                $('#change_amount').val(change_amount);
                            });
                            $('#productcode').val("");
                            $('#productcode').focus();
                        }
                        else
                        {
                            //alert(json.msg);
                            swal({
                                title: "",
                                text: json.msg,
                                type: "warning"
                            });
                            $('#productcode').val("");
                            $('#productcode').focus();
                        }
                    });
            }
        });
        //delete from List
        $('#sales_table').on('click','._delete',function(){
            var removecode=$(this).attr('data-rowid');
            var B_code=$(this).attr('id');
            $.get("{{ url('/api/sales/remove') }}",
                {
                    pcode: removecode,
                    bar_code: B_code
                    
                },
                function(data, status){
                    //alert("Data: " + data + "\nStatus: " + status);
                    var json = $.parseJSON(data);
                    if(json.msg=="")
                    {
                        $('#paid').val(0);
                        $('#change_amount').val("");
                        $("."+json.barcode).html("");
                        var grand_total = json.grand_total;
                        $('#grand_total').val(grand_total);
                        $('#paid').keyup(function(){
                            var paid = $('#paid').val();
                            var change_amount = paid - grand_total;
                            $('#change_amount').val(change_amount);
                        });
                        $('#productcode').val("");
                        $('#productcode').focus();
                    }
                    else
                    {
                        //alert(json.msg);
                        swal({
                            title: "",
                            text: json.msg,
                            type: "warning"
                        });
                        $('#productcode').val("");
                        $('#productcode').focus();
                    }
                });
        });

        //alldelete session
        $('#allremove').on('click', function(){
            $.get("{{ url('/api/sales/allremove') }}",
                function(data, status){
                    var json = $.parseJSON(data);
                    if(json.msg)
                    {
                        $('#paid').val(0);
                        $('#change_amount').val("");
                        $("#sales_table").html();
                        var html = "";
                        $.each(json.sales_table,function(index,value){
                            var code = value['code'];
                            var barcode = value['barcode'];
                            var name = value['name'];
                            var quantity = value['quantity'];
                            var price = value['price'];
                            var total = value['total'];
                            html += '<tr><td>'+code+'</td><td>'+barcode+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+name+'" disabled></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                        });
                        $("#sales_table").html(html);
                        var grand_total = json.grand_total;
                        $('#grand_total').val(grand_total);
                        $('#paid').keyup(function(){
                            var paid = $('#paid').val();
                            var change_amount = paid - grand_total;
                            $('#change_amount').val(change_amount);
                        });
                        $('#productcode').val("");
                        $('#productcode').focus();

                        swal({
                            title: "",
                            text: json.msg,
                            type: "success"
                        });
                    }
                });
        });
        //confirm sale
        // $('#confirm').on('click', function(){
        //     var grand_total = $('#grand_total').val();
        //     var paid = $('#paid').val();
        //     var discount = $('#discount').val();
        //     var change_amount = $('#change_amount').val();
        //     $.get("{{ url('/api/sales/confirm') }}",
        //         {
        //             grand_total: grand_total,
        //             paid: paid,
        //             discount: discount,
        //             change_amount: change_amount
        //         },
        //         function(data, status){
        //             //  alert("Data: " + data + "\nStatus: " + status);
        //             var json = $.parseJSON(data);

        //             if(json.msg)
        //             {
        //                 $('#paid').val(0);
        //                 $('#change_amount').val("0");
        //                 $('#grand_total').val(0);
        //                 $("#sales_table").html("");
        //                 var html = "";
        //                 $.each(json.saleDetails,function(index,value){
        //                     $(".addrow").append( "<tr><td>"+value['name']+"</td></tr>" );
        //                  });
        //                 // window.print();
        //                 $('#productcode').val("");
        //                 $('#productcode').focus();

        //                 swal({
        //                     title: "",
        //                     text: json.msg,
        //                     type: "success"
        //                 });

                        
        //             }
        //         });
        // });
        //Quantity KeyUp
        $('#sales_table').on('keyup','._qty',function(){
            var productcode=$(this).attr('data-code');
            var qty =$(this).val();
            //alert(qty);
            if(isNaN(qty) || qty <= 0)
            {
                swal({
                    title: "",
                    text: "Quantity must have an correct Amount!",
                    type: "warning"
                });
                var qty =$(this).val(1);
            }
            $.get("{{ url('api/salesqualtity/data') }}",
                {
                    code: productcode ,
                    qty : qty
                },
                function(data, status){
                    // alert("Data: " + data + "\nStatus: " + status);
                    var json = $.parseJSON(data);
                    //alert(json);
                    if(json.msg=="")
                    {
                        $('#paid').val(0);
                        $('#change_amount').val("");
                        $("#sales_table").html();
                        var html = "";
                        $.each(json.sales_table,function(index,value){
                            //alert(value['code']);
                            var code = value['code'];
                            var barcode = value['barcode'];
                            var name = value['name'];
                            var quantity = value['quantity'];
                            var price = value['price'];
                            var total = value['total'];
                            html += '<tr id="'+barcode+'"><td>'+code+'</td><td>'+barcode+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+name+'" readonly/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                        });
                        $("#sales_table").html(html);
                        var grand_total = json.grand_total;
                        $('#grand_total').val(grand_total);
                        $('#paid').keyup(function(){
                            var paid = $('#paid').val();
                            var change_amount = paid - grand_total;
                            $('#change_amount').val(change_amount);
                        });
                        $('#productcode').val("");
                        $('#productcode').focus();
                    }else
                    {
                        //alert(json.msg);
                        swal({
                            title: "",
                            text: json.msg,
                            type: "warning"
                        });
                        $('#productcode').val("");
                        $('#productcode').focus();
                    }
                });
        });

        // let barcodeInput = document.getElementById('productcode');
        // let para = document.createElement('p');
        // para.id = 'newpara';
        // barcodeInput.addEventListener('input', (e) => {
        //     para.innerText = barcodeInput.value;
        //     // e.preventDefault();
        // }, false);
        // document.body.appendChild(para);
    </script>
@endsection