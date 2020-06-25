@extends('layouts.master')
@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Warehouse Qty</h3>
        </div>

        <div class="panel-body">
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="min-tablet">Product Name</th>
                    <th class="min-tablet">Qty</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($stocks as $value)
                    <tr>
                        @can('purchase-list')
                            <td>{{$i}}</td>
                            <td>{{ $value->product->name }} ( {{ $value->product->code}} )</td>
                            <td>{{ $value->tqty }}</td>
                        @endcan
                    </tr>
                <?php $i++ ?>
                @endforeach
                </tbody>
            </table> 
        </div>
    </div>



@endsection
