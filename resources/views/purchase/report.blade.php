@extends('layouts.master')
@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">
                Purchase Report
                @if(isset($count))
                    <span class="text-success">({{ $count }}) Founds</span>
                @endif    
            </h3>
        </div>

        <div class="panel-body">
            <form class="form-inline" action="{{ route('purchase_search') }}" method="GET">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name" class="control-label"><b>End Date</b></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="end_date" name="end_date" value="<?= date('Y-m-d');?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <br/>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="min-tablet">Voucher No.</th>
                    <th class="min-tablet">Product Name</th>
                    <th class="min-tablet">qty</th>
                    <th class="min-tablet">Delivery Date</th>
                    <th class="min-tablet">User Name</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($purchase as $key => $value)
                    <tr>
                        @can('purchase-list')
                            <td>{{$i}}</td>
                            <td>{{ $value->voucher }}</td>
                            <td>{{ $value->product->name }} ( {{ "000". $value->product->id}} )</td>
                            <td>{{ $value->qty }}</td>
                            <td>{{ $value->delivery_date }}</td>
                            <td>{{ $value->user->name }}</td>
                        @endcan                            
                    </tr>
                <?php $i++ ?>
                @endforeach
                </tbody>
            </table>
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
