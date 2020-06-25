@extends('layouts.master')
@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Stock Add Lists</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @can('purchase-create')
            <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                <i class="fa fa-save fa-fw"></i> Stock Add
            </button>
        @endcan

        <div class="panel-body">
            <form class="form-inline" action="{{ route('stock-add-search') }}" method="GET">
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
                    <th class="min-tablet">Product Name</th>
                    <th class="min-tablet">qty</th>
                    <th class="min-tablet">Date</th>
                    <th class="min-tablet">Added By</th>
                    <th class="min-tablet">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($stocks as $value)
                    <tr>
                        @can('purchase-list')
                            <td>{{$i}}</td>
                            <td>{{ $value->product->name }} ( {{ $value->product->code}} )</td>
                            <td>{{ $value->qty }}</td>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->user->name }}</td>
                        @endcan
                            <td>
                                @can('purchase-delete')
                                    <div class="col-md-3">
                                        <form action="{{ route('stock-add-delete', $value->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-icon btn-circle icon-sm fa fa-trash" type="submit"
                                                    onclick="return confirm('Are you sure to delete? It Will reduce quantity of product!!')"></button>
                                        </form>
                                    </div>
                                @endcan
                            </td>
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
                    <h4 class="modal-title text-xs-center">Add Stock</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('stock-add-store')}}">
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
