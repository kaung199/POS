@extends('layouts.master')
@section('head')
    <link href="{{asset('pos/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="panel-title stock-head">Stock Check</h1>
                </div>
                <div class="col-md-3">
                <h4 class="panel-title stock-menu float-right" data-toggle="modal" data-target="#Completed" style="cursor:pointer;">Completed Check <span class="text-success">( {{ $count_c }} )</span></h3>
                </div>
                <div class="col-md-3">
                    <h4 class="panel-title stock-menu float-left" data-toggle="modal" data-target="#InComplete" style="cursor:pointer;">InComplete Check <span class="text-danger">( {{ $count_inC }} )</span></h3>
                </div>
            </div>
            
            
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        

        <div class="panel-body date-pad">
            @can('products-list')
                <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left new-check" data-toggle="modal" data-target="#ModalExample">
                    <i class="fa fa-save fa-fw"></i> New Check
                </button>
                <form class="form-inline" action="{{ route('search-stock-check') }}" method="GET">
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
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary date-float" type="submit">Search</button>
                    </div>
                </form>
            @endcan
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="min-tablet">Name</th>

                        @if(Auth::user()->id == 1)
                            <th class="min-tablet">InStock</th>
                        @endif

                        <th class="min-tablet">Checked Stock</th>

                        @if(Auth::user()->id == 1)
                            <th class="min-tablet">Real-Time-Stock</th>
                            <th class="min-tablet">Balance</th>
                        @endif

                        <th class="min-tablet">Date</th>
                        <th class="min-desktop">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($products as $key => $product)
                        <tr>
                            @can('products-list')
                                <td>{{$i}}</td>
                                <td class="zawgyi-one">{{ $product->product->name }}</td>

                                @if(Auth::user()->id == 1)
                                    <td>{{ $product->product->qty }}</td>
                                @endif

                                <td>{{ $product->qty }}</td>

                                @if(Auth::user()->id == 1)
                                    <td>{{ $product->r_qty }}</td>
                                    <td>{{ $product->product->qty - $product->r_qty }}</td>
                                @endif
                                <td>{{ $product->date }}</td>
                            @endcan
                            <td>
                                @can('products-list')
                                        <div class="col-md-2">
                                            <a href="#" class="btn btn-primary  btn-circle"
                                            data-toggle="modal" data-target="#modal-edit{{ $product->id }}" id="modal-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                @endcan


                                {{-- <div class="col-md-2">
                                    <a href="#" class="btn btn-primary  btn-circle"><i class="fa fa-list"></i></a>
                                </div> --}}
                            </td>

                            <!-- edit users -->
                            <div id="modal-edit{{ $product->id }}" class="modal fade edit">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-xs-center">Edit Stock Check</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form role="form" method="post" action="{{ route('stock-check-update', $product->id)}}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="inputName">Name</label>
                                                    <select class="form-control js-example-basic-single" data-live-search="true" name="product_id" style="width: 100%" required>
                                                            <option value="{{$product->product->id}}" class="zawgyi-one">{{$product->product->name}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sale_price">Check Qty</label>
                                                    <input type="decimal" class="form-control" id="sale_price" placeholder="Enter Qty" name="qty" value="{{ $product->qty }}" required/>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date" value="{{ $product->date }}" required/>
                                                </div> --}}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6 btm-pad">
                                                            <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="col-md-6 btm-pad">
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
    </div>

    <!-- create users -->
    <div id="ModalExample" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Create Check Stock</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{ route('stock-check-create') }}" method="POST">
                        @csrf 

                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <select class="form-control js-example-basic-single" data-live-search="true" name="product_id" style="width: 100%" required>
                                    @foreach($inStocks as $item)
                                        <option value="{{$item->id}}" class="zawgyi-one">{{$item->name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Check Qty</label>
                            <input type="number" class="form-control" id="qty" placeholder="Enter your check Stock Qty" name="qty" required/>
                        </div>
                        
                        <div class="form-group">
                            {{-- <label for="date">Date</label> --}}
                            <input type="hidden" id="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 btm-pad">
                                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-6 btm-pad">
                                    <button type="submit" class="btn btn-info btn-block">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- InComplete Check -->
    <div id="InComplete" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center">InComplete Check Producs</h3>
                </div>
                <div class="modal-body">
                    @foreach ($inComplete as $Inc)
                <h4 class="text-center p-name-pad zawgyi-one">{{ $Inc->name }}</h4>
                    @endforeach
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Complete Check -->
    <div id="Completed" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Complete Check Producs</h3>
                </div>
                <div class="modal-body">
                    @foreach ($completed as $c)
                        <h4 class="text-center p-name-pad zawgyi-one">{{ $c->name }}</h4>
                    @endforeach
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
                $(this).find('#inputName').focus();
                $('#code').prop("disabled",false);
            });

            $(".edit").on('shown.bs.modal', function(){
                $(this).find('#inputName').focus();
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
