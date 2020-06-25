
@extends('layouts.pawn')
@section('contents')
@can('pawn-report')
    @if(collect($pawn)->isNotEmpty())
    <div class="container shadow pt-5 pb-5 table-responsive">
    <h3 class="text-center text-danger">ေပါင္</h3>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Voucher No.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pawn as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->voucher }}</td>
                            <td>{{ $p->date }}</td>
                            <td>{{ $p->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    @endif
    @if(collect($yawe)->isNotEmpty())
    <div class="container shadow pt-5 pb-5 table-responsive">
        <h3 class="text-center text-success">ေရြး</h3>
        <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Voucher No.</th>
                <th scope="col">Date</th>
                <th scope="col">Repay Date</th>
                <th scope="col">Amount</th>
                <th scope="col">Interest</th>
                <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($yawe as $y)
                    <tr>
                        <td>{{ $y->name }}</td>
                        <td>{{ $y->voucher }}</td>
                        <td>{{ $y->date }}</td>
                        <td>{{ $y->repayDate  }}</td>
                        <td>{{ $y->amount }}</td>
                        <td>{{ $y->interest }}</td>
                        <td>{{ $y->total }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
    @endif
@endcan
@endsection