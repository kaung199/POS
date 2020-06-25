@extends('layouts.master')
@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Purchase List</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @can('purchase-create')
            <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                <i class="fa fa-save fa-fw"></i> New Purchase
            </button>
        @endcan

        <div class="panel-body">
            <form class="form-inline" action="{{ route('pur_search') }}" method="GET">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name" class="control-label"><b>Start Date</b></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="start_date" name="start_date" value="<?= date('Y-m-d');?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="name" class="control-label"><b>End Date</b></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="end_date" name="end_date" value="<?= date('Y-m-d');?>">
                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit">Search</button>

                </div>
            </form>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="min-tablet">Voucher No.</th>
                    <th class="min-tablet">Product Name</th>
                    <th class="min-tablet">qty</th>
                    <th class="min-tablet">Bad qty</th>
                    <th class="min-tablet">Loss qty</th>
                    <th class="min-tablet">Good qty</th>
                    <th class="min-tablet">Min qty</th>
                    <th class="min-tablet">Delivery Date</th>
                    <th class="min-tablet">User Name</th>
                    <th class="min-tablet">Remark</th>
                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($purchase as $value)
                    <tr @if($value->status == 1) style="background:#ffd8d3;" @endif>
                        @can('purchase-list')
                            <td>{{$i}}</td>
                            <td>{{ $value->voucher }}</td>
                            <td>{{ $value->product->name }} ( {{ $value->product->code}} )</td>
                            <td>{{ $value->qty }}</td>
                            <td>{{ $value->bad_qty }}</td>
                            <td>{{ $value->loss_qty }}</td>
                            <td>{{ $value->qty - $value->bad_qty - $value->loss_qty}}</td>
                            <td>{{ $value->min_qty}}</td>
                            <td>{{ $value->delivery_date }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>{{$value->remark}}</td>
                        @endcan
                            <td>
                                @can('purchase-edit')
                                    <div class="col-md-3">
                                        <a href="{{ url('purchase.edit',$value->id) }}" class="btn btn-primary btn-icon btn-circle icon-sm fa fa-edit"
                                           data-toggle="modal" data-target="#modal-edit{{ $value->id }}" id="modal-edit">
                                        </a>
                                    </div>
                                @endcan

                                @can('purchase-delete')
                                    <div class="col-md-3">
                                        <form action="{{ route('purchase.destroy', $value->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-icon btn-circle icon-sm fa fa-trash" type="submit"
                                                    onclick="return confirm('Are you sure to delete?')"></button>
                                        </form>
                                    </div>
                                @endcan
                                <div class="col-md-3">
                                    <a href="{{ url('purchase.goodbad',$value->id) }}" class="btn btn-primary btn-icon btn-circle icon-sm fa fa-outdent"
                                        data-toggle="modal" data-target="#modal-editt{{ $value->id }}" id="modal-edit" title="Inspection">
                                    </a>
                                </div>
                            </td>

                        <!-- edit users -->
                            <div id="modal-edit{{ $value->id }}" class="modal fade edit">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-xs-center">Edit Purchase</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="post" action="{{route('purchase.update', $value->id)}}">
                                                @csrf
                                                @method('PATCH')

                                                <div class="form-group">
                                                    <label for="product_id">Product Name</label>
                                                    <select class="form-control js-example-basic-single" data-live-search="true" name="product_id" style="width: 100%" required>
                                                        @foreach($product as $products)
                                                            <option {{($value->product_id == $products->id) ? 'selected = "true" ' : ''}} value="{{ $products->id }}">
                                                                {{$products->code}} | {{ $products->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputQty">Qty</label>
                                                    <input type="number" class="form-control" id="inputQty" placeholder="Enter your Qty" name="qty" value="{{$value->qty}}" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDate">Purchase Date</label>
                                                    <input type="date" class="form-control" id="inputDate" name="delivery_date" style="line-height: 19px" value="{{$value->delivery_date}}" required/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-info btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        <!-- edit users2 -->
                            <div id="modal-editt{{ $value->id }}" class="modal fade inspection">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-xs-center">Inspection Purchase Products</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="post" action="{{route('purchase.update', $value->id)}}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="inputVoucher">Voucher No</label>
                                                    <input type="text" class="form-control" id="inputVoucher" name="voucher" value="{{$value->voucher}}" readonly required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_id">Product Name</label>
                                                    <select class="form-control" name="product_id" style="width: 100%" readonly>
                                                            <option  value="{{ $value->product_id }}">
                                                                {{$value->product->code}} | {{ $value->product->name }}
                                                            </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputQty">Min Qty</label>
                                                    <input type="number" class="form-control" id="inputQty" placeholder="Enter your Qty" name="min_qty" value="{{$value->min_qty}}" readonly required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDate">Delivery Date</label>
                                                    <input type="date" class="form-control" id="inputDate" name="delivery_date" style="line-height: 19px" value="{{$value->delivery_date}}" readonly required/>
                                                </div>
                                                <div class="form-group" id="badQty">
                                                    <label for="inputBadQty">Bad Qty</label>
                                                    <input type="number" class="form-control" id="inputBadQty" placeholder="Enter your Bad Qty" name="bad_qty"  required/>
                                                </div>
                                                <div class="form-group" id="badQty">
                                                    <label for="inputBadQty">Loss Qty</label>
                                                    <input type="number" class="form-control" id="inputBadQty" placeholder="Enter your Bad Qty" name="loss_qty" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="remark">Remark</label>
                                                    <textarea name="remark" id="remark" class="form-control" row="2" placeholder="If this product is bad type remak!">{{ $value->remark }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-info btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                    </tr>
                <?php $i++ ?>
                @endforeach
                </tbody>
            </table> 
        </div>
        {{ $purchase->links() }}
    </div>

    <!-- create users -->
    <div id="ModalExample" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Create Purchase</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('purchase.store')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Product Name</label>
                            <div>
                                <select class="form-control selectpicker" data-live-search="true" name="product_id" required>
                                    @foreach($product as $products)
                                        <option value="{{ $products->id }}">
                                            {{$products->code}} | {{ $products->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputQty">Qty</label>
                            <input type="number" class="form-control" id="inputQty" placeholder="Enter your Qty" name="qty" required/>
                        </div>
                        <div class="form-group">
                            <label for="inputDate">Purchase Date</label>
                            <input type="date" class="form-control" id="inputDate" name="delivery_date" style="line-height: 19px"  required/>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-info btn-block">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@section('script')
    <script src="{{asset('pos/js/bootstrap-datepicker.min.js')}}"></script> 
    <script type="text/javascript">
        $(document).ready(function(){
            $("#ModalExample").on('shown.bs.modal', function(){
                $(this).find('#inputQty').focus();
            });

            $(".edit").on('shown.bs.modal', function(){
                $(this).find('#inputQty').focus();
            });

            $(".inspection").on('shown.bs.modal', function(){
                $(this).find('#inputBadQty').focus();
            });

            $(".js-example-basic-single").select2();

        });

        (function ($) {
            $.fn.enter = function (func) {
                this.bind('keypress', function (e) {
                    if (e.keyCode == 13) func.apply(this, [e]);
                });
                return this;
            };
        })(jQuery);

        $(document).ready(function(){
            $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true
            });
        });

    </script>

@endsection
