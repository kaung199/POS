@extends('layouts.master')
@section('head')
    <link href="{{asset('pos/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('page-content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    @if(isset($transfer))
                        Transfer Total Products
                        @php
                            $route = 't_dailytotal';
                        @endphp
                    @else
                        Daily Total Sales   
                        @php
                            $route = 'dailytotal';
                        @endphp
                    @endif        
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-inline" action="{{ route($route) }}" method="GET">
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
                                <input type="text" class="form-control pull-right" id="endDate" name="end_date" value="<?= date('Y-m-d');?>">
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit">Search</button>

                    </div>
                </form>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table id="demo-dt-addrow" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $gt = 0;
                            @endphp
                        @foreach($saleDetails as $s)
                            @php
                                $gt += $s->tp;
                            @endphp
                            
                            <tr>
                                <td>{{ $s->product->name }}</td>
                                <td class="text-right">{{ $s->tqty }}</td>
                                <td class="text-right">{{ $s->product->sale_price }}</td>
                                <td class="text-right">{{ $s->tp }}</td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tr>
                            <th colspan="3" class="text-center">Grand Total</th>
                            <th class="text-right">{{ $gt }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

     
@endsection

@section('script')
    <script src="{{asset('pos/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endsection
