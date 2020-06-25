
@extends('layouts.pawn')
@section('contents')
@can('pawn-investment')
   <div class="row pt-5 ptb">
        <div class="col-md-3">
            <div class="padding-border bg-primary">
            <h3 class="text-center pt-5">Investment</h3>
            <h4 class="text-center badge-danger">{{ $bank->investment }}</h4>
            <h5 class="text-center pt-2">
                <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalExample">Edit</a>
                 <!-- create pawn -->
                    <div id="ModalExample" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-xs-center">Investment</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="{{ route('bankedit') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $bank->id }}" name="id">
                                        <div class="form-group">
                                            <label>Investment</label>
                                            <input type="number" class="form-control" name="investment" value="{{ $bank->investment }}">                        
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
                    </div>
                    <!-- /.modal end-->
            </h5>
            </div>
        </div>
        <div class="col-md-3">            
            <div class="padding-border bg-warning">
            <h3 class="text-center pt-5">Current Amount</h3>
            <h4 class="text-center badge-danger">{{ $bank->min }}</h4>
            </div>
        </div>
        <div class="col-md-3">  
            <div class="padding-border bg-info">
            <h3 class="text-center pt-5">Expenses</h3>
            <h4 class="text-center badge-danger">{{ $bank->cost }}</h4>
            </div>
        </div>
        <div class="col-md-3">  
            <div class="padding-border bg-success">
            <h3 class="text-center pt-5">Profit</h3>
            <h4 class="text-center badge-danger">{{ $bank->min - $bank->investment }}</h4>
            </div>
        </div>     
        
   </div>
   <div class="pb-5">
        <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
            <div class="row">
                <div class="col-md-12 pb-3">
                    <h2 class="text-center text-danger">Report</h2>
                </div>
                <div class="pb-3">                                 
                    <form class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="{{ route('searchall') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <select class="custom-select" name="search" style="width:200px;">
                                    <option selected value="all">All</option>
                                    <option value="allpawn">All Pawn</option>
                                    <option value="pawn">Pawn</option>
                                    <option value="yawe">Yawe</option>
                                    <option value="discount">Discount</option>
                                    <option value="loss">Loss Pawn</option>
                                    <option value="expense">Expenses</option>
                                </select>
                            </div>
                            <div class="col-md-8">
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
                            </div>
                        </div>
                    </form>                        
                    
                </div>        
            </div>
                <hr> 
                @if(isset($search))
                <div class="shadow p-3">
                    <h3 class="text-center text-danger">Grand Total</h3>                
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Pawn 
                                    @if(isset($allpawn))
                                        <span class="text-success">( {{ $allcount}} )</span>                                    
                                    @endif
                                </th>
                                <th scope="col">
                                    Yawe 
                                    @if(isset($allpawn))
                                        <span class="text-success">( {{ $allyawecount}} )</span>                                    
                                    @endif
                                </th>
                                @if(isset($yawe))
                                <th scope="col">
                                    Interest 
                                </th>
                                @endif
                                <th scope="col">
                                    Loss Pawn 
                                    @if(isset($allpawn))
                                        <span class="text-success">( {{ $alllosscount}} )</span>                                    
                                    @endif
                                </th>
                                <th scope="col">Expenses</th>
                                @if(isset($discount))
                                    <th scope="col">Discount</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                $tp = 0;
                                $tit = 0;
                                $ty = 0;
                                $tc = 0;
                                $tl = 0;
                                $tap = 0;
                                $tay = 0;
                                $tal = 0;
                                $ds = 0;
                                if(isset($pawn)) {
                                    foreach($pawn as $pp) {
                                        $tp += $pp->amount;
                                    }
                                } 
                                if(isset($allpawn)) {
                                    foreach($allpawn as $app) {
                                        $tap += $app->amount;
                                    }
                                    if(isset($allyawe)) {
                                        foreach($allyawe as $ayy) {
                                            $tay += $ayy->total;
                                        }
                                    }
                                    if(isset($allpawn)) {
                                        foreach($allloss as $allo) {
                                            $tal += $allo->total;
                                        }
                                    }
                                }
                                if(isset($yawe)) {
                                    foreach($yawe as $yy) {
                                        $ty += $yy->total;
                                        $tit += $yy->interest;
                                    }
                                } 
                                if(isset($costs)) {
                                    foreach($costs as $cc) {
                                        $tc += $cc->amount;
                                    }
                                } 
                                if(isset($loss)) {
                                    foreach($loss as $ll) {
                                        $tl += $ll->total;
                                    }
                                } 
                                if(isset($discount)) {
                                    foreach($discount as $dd) {
                                        $ds += $dd->total;
                                    }
                                } 
                            ?>

                            <td>
                                @if(!isset($allpawn))
                                    {{ $tp }}
                                @elseif(isset($allpawn))
                                    {{ $tap }}
                                @endif
                                
                            </td>
                            <td>
                                @if(!isset($allpawn))
                                    {{ $ty }}
                                @elseif(isset($allpawn))
                                    @if(isset($allyawe))
                                        {{ $tay }}
                                    @endif
                                @endif
                            </td>
                            @if(isset($yawe))
                                <td>{{ $tit }}</td>                                        
                            @endif
                            
                            <td>
                                @if(!isset($allpawn))
                                    {{ $tl }}
                                @elseif(isset($allpawn))
                                    @if(isset($allloss))
                                        {{ $tal }}
                                    @endif
                                @endif
                            </td>
                            <td>{{ $tc }}</td>
                            @if(isset($discount))
                                <td>{{ $ds }}</td> 
                            @endif

                        </tbody>
                    </table>
                    <hr>
                </div>
                    
                @endif
        </div>
        @if(isset($allpawn)) 
            @if(collect($allpawn)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger zawgyi-one">All Pawn</h3>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Voucher No.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Yawe</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                @foreach($allpawn as $ap)
                                    <tr>
                                        <td>{{ $ap->name }}</td>
                                        <td>{{ $ap->voucher }}</td>
                                        <td>{{ $ap->date }}</td>
                                        <td>{{ $ap->amount }}</td>
                                        <td>
                                            @if($ap->status == 2)
                                                @if($ap->yawe_status == 'loss')
                                                    <p class="text-danger">Loss Pawn</p>
                                                @elseif($ap->yawe_status == 'finished')
                                                    <p class="text-success">Success</p>
                                                @endif
                                                
                                            @endif
                                            @if($ap->status == 1)
                                                <p class="text-primary">Pending</p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $ap->id }}">
                                                Detail
                                            </button>
                                        </td>
                                        {{-- detial --}}
                                        <div class="modal fade" id="exampleModalLong{{$ap->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@if($ap->customer !=null){{ $ap->customer->name }}@endif Details</h5>
                                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($ap->photos[0]))
                                                        <img src="{{ asset('storage/' . $ap->photos[0]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($ap->photos[1]))
                                                        <img src="{{ asset('storage/' . $ap->photos[1]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    @if(isset($ap->photos[2]))
                                                        <img src="{{ asset('storage/' . $ap->photos[2]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($ap->photos[3]))
                                                        <img src="{{ asset('storage/' . $ap->photos[3]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Item Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Pawn Date</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->created_at }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Voucher No</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->voucher }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">{{ $ap->amount }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount+Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $ap->real_price }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Discount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $ap->discount }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $ap->interest }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Total</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $ap->total }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Quantity</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->quantity }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Stone+Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->stone_weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Price</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->price }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Cashier Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $ap->cashier_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Customer Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($ap->customer !=null)
                                                            {{ $ap->customer->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Phone</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($ap->customer !=null)  {{ $ap->customer->phone }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Address</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($ap->customer !=null)  {{ $ap->customer->address }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- detial end --}}
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
        @if(isset($pawn)) 
            @if(collect($pawn)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger zawgyi-one">ေပါင္</h3>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Voucher No.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                @foreach($pawn as $p)
                                    <tr>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->voucher }}</td>
                                        <td>{{ $p->date }}</td>
                                        <td>{{ $p->amount }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $p->id }}">
                                                Detail
                                            </button>
                                        </td>
                                        {{-- detial --}}
                                        <div class="modal fade" id="exampleModalLong{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@if($p->customer !=null){{ $p->customer->name }}@endif Details</h5>
                                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($p->photos[0]))
                                                        <img src="{{ asset('storage/' . $p->photos[0]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($p->photos[1]))
                                                        <img src="{{ asset('storage/' . $p->photos[1]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    @if(isset($p->photos[2]))
                                                        <img src="{{ asset('storage/' . $p->photos[2]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($p->photos[3]))
                                                        <img src="{{ asset('storage/' . $p->photos[3]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Item Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Pawn Date</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->created_at }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Voucher No</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->voucher }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">{{ $p->amount }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Quantity</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->quantity }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Stone+Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->stone_weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Price</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->price }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Cashier Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $p->cashier_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Customer Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($p->customer !=null)
                                                            {{ $p->customer->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Phone</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($p->customer !=null)  {{ $p->customer->phone }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Address</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($p->customer !=null)  {{ $p->customer->address }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- detial end --}}
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
        @if(isset($yawe)) 
            @if(collect($yawe)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger">ေရြး</h3>
                        </div>
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
                                <th scope="col">Action</th>
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
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $y->id }}">
                                                Detail
                                            </button>
                                        </td>
                                        {{-- detial --}}
                                        <div class="modal fade" id="exampleModalLong{{$y->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@if($y->customer !=null){{ $y->customer->name }}@endif Details</h5>
                                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($y->photos[0]))
                                                        <img src="{{ asset('storage/' . $y->photos[0]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($y->photos[1]))
                                                        <img src="{{ asset('storage/' . $y->photos[1]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    @if(isset($y->photos[2]))
                                                        <img src="{{ asset('storage/' . $y->photos[2]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($y->photos[3]))
                                                        <img src="{{ asset('storage/' . $y->photos[3]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Item Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Pawn Date</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->created_at }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Voucher No</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->voucher }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">{{ $y->amount }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount+Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $y->real_price }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Discount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $y->discount }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $y->interest }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Total</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $y->total }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Quantity</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->quantity }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Stone+Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->stone_weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Price</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->price }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Cashier Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $y->cashier_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Customer Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($y->customer !=null)
                                                            {{ $y->customer->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Phone</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($y->customer !=null)  {{ $y->customer->phone }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Address</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($y->customer !=null)  {{ $y->customer->address }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- detial end --}}
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
        @if(isset($discount)) 
            @if(collect($discount)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger">Discount</h3>
                        </div>
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
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                @foreach($discount as $d)
                                    <tr>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->voucher }}</td>
                                        <td>{{ $d->date }}</td>
                                        <td>{{ $d->repayDate  }}</td>
                                        <td>{{ $d->amount }}</td>
                                        <td>{{ $d->interest }}</td>
                                        <td>{{ $d->total }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $d->id }}">
                                                Detail
                                            </button>
                                        </td>
                                        {{-- detial --}}
                                        <div class="modal fade" id="exampleModalLong{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@if($d->customer !=null){{ $d->customer->name }}@endif Details</h5>
                                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($d->photos[0]))
                                                        <img src="{{ asset('storage/' . $d->photos[0]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($d->photos[1]))
                                                        <img src="{{ asset('storage/' . $d->photos[1]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    @if(isset($d->photos[2]))
                                                        <img src="{{ asset('storage/' . $d->photos[2]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($d->photos[3]))
                                                        <img src="{{ asset('storage/' . $d->photos[3]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Item Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Pawn Date</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->created_at }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Voucher No</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->voucher }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">{{ $d->amount }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount+Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $d->real_price }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Discount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $d->discount }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $d->interest }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Total</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $d->total }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Quantity</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->quantity }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Stone+Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->stone_weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Price</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->price }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Cashier Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $d->cashier_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Customer Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($d->customer !=null)
                                                            {{ $d->customer->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Phone</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($d->customer !=null)  {{ $d->customer->phone }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Address</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($d->customer !=null)  {{ $d->customer->address }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- detial end --}}
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
        @if(isset($loss)) 
            @if(collect($loss)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger">Loss</h3>
                        </div>
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
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                    
                                @foreach($loss as $l)
                                    <tr>
                                        <td>{{ $l->name }}</td>
                                        <td>{{ $l->voucher }}</td>
                                        <td>{{ $l->date }}</td>
                                        <td>{{ $l->repayDate  }}</td>
                                        <td>{{ $l->amount }}</td>
                                        <td>{{ $l->interest }}</td>
                                        <td>{{ $l->total }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $l->id }}">
                                                Detail
                                            </button>
                                        </td>
                                        {{-- detial --}}
                                        <div class="modal fade" id="exampleModalLong{{$l->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">@if($l->customer !=null){{ $l->customer->name }}@endif Details</h5>
                                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($l->photos[0]))
                                                        <img src="{{ asset('storage/' . $l->photos[0]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($l->photos[1]))
                                                        <img src="{{ asset('storage/' . $l->photos[1]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    @if(isset($l->photos[2]))
                                                        <img src="{{ asset('storage/' . $l->photos[2]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    @if(isset($l->photos[3]))
                                                        <img src="{{ asset('storage/' . $l->photos[3]->filename) }}" alt="" style="width:200px; height:200px; border:1px solid #ddd;">
                                                    @endif
                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Item Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Pawn Date</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->created_at }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Voucher No</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->voucher }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">{{ $l->amount }}</span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Amount+Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $l->real_price }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Discount</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $l->discount }}
                                                            </span>            
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Interest</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $l->interest }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Total</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            <span class="badge badge-danger">
                                                                {{ $l->total }}
                                                            </span>                                                 
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Quantity</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->quantity }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Stone+Weight</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->stone_weight }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Price</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->price }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Cashier Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            {{ $l->cashier_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Customer Name</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($l->customer !=null)
                                                            {{ $l->customer->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Phone</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($l->customer !=null)  {{ $l->customer->phone }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <Strong>Address</Strong>
                                                        </div>
                                                        <div class="col-md-1">::</div>
                                                        <div class="col-md-8">
                                                            @if($l->customer !=null)  {{ $l->customer->address }} @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- detial end --}}
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
        @if(isset($costs)) 
            @if(collect($costs)->isNotEmpty())
                <div class="container shadow pt-5 pb-5 pr-3 pl-3 table-responsive">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <h3 class="text-center text-danger">အသံုးစရိတ္</h3>
                        </div>
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
                                @foreach($costs as $c)
                                    <tr>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->created_at }}</td>
                                        <td>{{ $c->amount }}</td>
                                        <td>{{ $c->reason }}</td>
                                    </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            @endif
        @endif
   </div>
@endcan
@endsection