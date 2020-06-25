@extends('layouts.master')
@section('page-content')
    <div id="page-content">
        <div class="row">
            <div class="col-md-5">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Products</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered">
                            <div class="form-group">
                                <div class="col-md-5"> Name </div>
                                <div class="col-md-7">
                                    {{$product->name}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> Code </div>
                                <div class="col-md-7">
                                    {{$product->code}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> Price </div>
                                <div class="col-md-7">
                                    {{$product->sale_price}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> Qty </div>
                                <div class="col-md-7">
                                    {{$product->qty}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> Description </div>
                                <div class="col-md-7">
                                    {{$product->description}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> Category Name</div>
                                <div class="col-md-7">
                                    {{$product->category->name}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> -- </div>
                                <div class="col-md-7">
                                    --
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5"> -- </div>
                                <div class="col-md-7">
                                    --
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Product Detail</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <table id="demo-dt-addrow" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="min-tablet">Barcode</th>
                                            <th class="min-tablet">Qty</th>
                                            <th class="min-tablet">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($product_detail != null)
                                            @foreach($product_detail as $key => $value)
                                                <tr>
                                                    <td>{{$value->Barcode}}</td>
                                                    <td>{{$value->qty}}</td>
                                                    @if($value->status == 1)
                                                        <td>
                                                            <div class="label label-table label-success">Complete</div>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Main Box Lists</h3>
            </div>
            <div class="panel-body">
                <table id="demo-dt-selection" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Barcode</th>
                        <th class="min-tablet">Qty</th>
                        <th class="min-tablet">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if($mainbox != null)
                            @foreach($mainbox as $m)
                                <td>{{  $m->code }}</td>
                                <td>{{  $m->Barcode}}</td>
                                <td>{{ $m->qty }}</td>
                                <td>{{  $m->created_at }}</td>
                            @endforeach
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
