@extends('layouts.master')

@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">MainBox List ( Main Warehouse )</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('404'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('200'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @include('sweet::alert')

        <div class="panel-body">
            @can('mainBox-create')
                <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                    <i class="fa fa-save fa-fw"></i> New MainBox
                </button>
                <div style="padding-left: 10px;">
                    <a href="{{ route('mainbox_barcode') }}" class="btn btn-success table-toolbar-left">
                    <i class="fa fa-print fa-fw"></i> Barcode
                    </a>
                </div>
            @endcan
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="min-tablet">Code</th>
                    <th class="min-tablet">Barcode</th>
                    <th class="min-tablet">ProductName</th>
                    <th class="min-tablet">Qty</th>
                    <th class="min-tablet">Type</th>
                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($mainboxes as $key => $mb)
                    <tr>
                        @can('mainBox-list')
                            <td>{{$i}}</td>
                            <td>{{ $mb->code }}</td>
                            <td>{{ $mb->Barcode }}</td>
                            <td>{{$mb->product->code}} | {{ $mb->product->name }}</td>
                            <td>{{ $mb->qty }}</td>
                            <td>{{ $mb->type }}</td>
                        @endcan
                        <td>
                            <!-- @can('mainBox-edit')
                                <div class="col-md-3">
                                    <a href="{{ url('mainBox.edit',$mb->id) }}" class="btn btn-primary  btn-circle"
                                       data-toggle="modal" data-target="#modal-edit{{ $mb->id }}" id="modal-edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            @endcan -->

                            @can('mainBox-delete')
                                <div class="col-md-2">
                                    <form action="{{ route('mainBox.destroy', $mb->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure to delete?')"> <i class="fa fa-trash-o"></i></button>
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
                    <h4 class="modal-title text-xs-center">Create MainBox</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('mainBox.store')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Code</label>
                            @if(isset($code))
                                <input type="text" class="form-control" name="code" id="code" value="{{"0".$code}}" readonly>
                            @else
                                <input type="text" class="form-control" name="code" id="code" value="{{"01"}}" readonly>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control selectpicker" data-live-search="true" name="purchase_id" id="qty" required>
                                @foreach($purchases as $purchase)
                                    <option value="{{ $purchase->id }}">
                                        {{$purchase->product->code}} | {{ $purchase->product->name }} ( {{$purchase->min_qty}} Qty )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <div>
                                <select class="form-control selectpicker" data-live-search="true" name="type" required>
                                    <option value="full">Full</option>
                                    <option value="pieces">Pieces</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputQty">Qty</label>
                            <input type="number" class="form-control" id="inputQty" placeholder="Enter your Qty" name="qty" value="qty" required/>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#ModalExample").on('shown.bs.modal', function(){
                $(this).find('#inputQty').focus();
            });

            $(".edit").on('shown.bs.modal', function(){
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

    </script>
@endsection
