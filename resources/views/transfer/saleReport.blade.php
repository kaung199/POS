@extends('layouts.master')
@section('head')
    <link href="{{asset('pos/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('page-content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Transfer Report 
                     @if(isset($count))
                        <span class="text-success">({{ $count }}) Founds</span>
                     @endif           
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-inline" action="{{ route('t_ReportSearch') }}" method="GET">
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
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Bill No</th>
                            <th>Date</th>
                            <th class="min-tablet">Total Qty</th>
                            <th class="min-tablet">Total Price</th>
                            <th class="min-tablet">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                        @foreach($sale as $s)
                        @php
                            $total += $s->total_price;
                        @endphp
                            <tr>
                                <td>{{ $s->user->name }}</td>
                                <td>{{ $s->invoice_no }}</td>
                                <td>{{ $s->created_at }}</td>
                                <td>{{ $s->qty }}</td>
                                <td>{{ $s->total_price }}</td>
                                <td>
                                <a href="{{ route('t_Detail', $s->id) }}" class="btn btn-primary  btn-circle">
                                        <i class="fa fa-list"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                            <tr>
                                <th colspan="4" class="text-center">
                                    Grand Total
                                </th>
                                <th colspan="2" class="text-left">
                                    {{ $total }}
                                </th>
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
