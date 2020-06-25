
@extends('layouts.pawn')
@section('contents')
    @can('pawn-costs')
    <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
            <div class="row">
            <div class="col-md-12 pb-3">
                <h3 class="text-center text-danger">အသံုးစရိတ္</h3>
            </div>
            <div class="pb-3">
                <form class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="{{ route('c_search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                    <label for="from">From</label>
                    <input type="date" data-date-inline-picker="true" style="box-shadow: none;" name="from" class="form-control" aria-label="Search" aria-describedby="basic-addon2">
                    <label for="to">To</label>
                    <input type="date" data-date-inline-picker="true" style="box-shadow: none;" name="to" class="form-control" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" value="search">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </div>
            @if(Auth::user()->id == 2)
            <div class="text-right">
                <a  href="{{ route('expense_excel') }}" class="btn btn-danger">Excel</a>
            </div>
        @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($costs as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->amount }}</td>
                            <td>{{ $p->reason }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
    </div>
    @endcan
@endsection