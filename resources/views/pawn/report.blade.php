
@extends('layouts.pawn')
@section('contents')
@can('pawn-report')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   <div class="container shadow pt-5 pb-5 pl-3 pr-3 table-responsive">
        <div class="row">
            <div class="col-md-12 pb-3">
                <h3 class="text-center text-danger">ေပါင္</h3>
            </div>  
        <div class="pb-3">
            <form class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="{{ route('p_search') }}" method="GET">
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
        </div><br>
        @if(Auth::user()->id == 2)
            <div class="text-right">
                <a  href="{{ route('pawn_excel') }}" class="btn btn-danger">Excel</a>
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ပစၥည္း အမ်ိဳးအမည္</th>
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
                        @if(Auth::user()->id)
                            @can('pawn-investment')
                                <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#ModalExample{{ $p->id }}">Edit</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong{{ $p->id }}">
                                        Detail
                                    </button>
                                </td>
                                {{-- detial --}}
                                <div class="modal fade" id="exampleModalLong{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">@if($p->customer != null){{ $p->customer->name }} @endif Details</h5>
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
                                                    <Strong>ပစၥည္း အမ်ိဳးအမည္                                                    </Strong>
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
                                                    <Strong>ယူေငြ</Strong>
                                                </div>
                                                <div class="col-md-1">::</div>
                                                <div class="col-md-8">
                                                    <span class="badge badge-danger">{{ $p->amount }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <Strong>အေရအတြက္</Strong>
                                                </div>
                                                <div class="col-md-1">::</div>
                                                <div class="col-md-8">
                                                    {{ $p->quantity }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <Strong>ေရႊအေလးခ်ိန္</Strong>
                                                </div>
                                                <div class="col-md-1">::</div>
                                                <div class="col-md-8">
                                                    {{ $p->weight }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <Strong>ေက်ာက္ပါ အေလးခ်ိန္</Strong>
                                                </div>
                                                <div class="col-md-1">::</div>
                                                <div class="col-md-8">
                                                    {{ $p->stone_weight }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <Strong>တန္ဖိုး</Strong>
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
                                                    @if($p->customer != null)
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
                                                    @if($p->customer != null)
                                                        {{ $p->customer->phone }}
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                     <Strong>Address</Strong>
                                                </div>
                                                <div class="col-md-1">::</div>
                                                <div class="col-md-8">
                                                    @if($p->customer != null)
                                                    {{ $p->customer->address }}
                                                    @endif
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
                            <!-- create pawn -->
                                <div id="ModalExample{{ $p->id }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-xs-center">Edit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pawn_edit', $p->id) }}" method="POST" enctype='multipart/form-data'>
                                                @csrf
                                                    <div class="form-group">
                                                        <label>Pawned Date</label>
                                                        <input type="date" class="form-control" name="pdate" value="{{  $p->date }}">                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Voucher No.</label>
                                                        <input type="text" class="form-control" name="voucher" value="{{ $p->voucher }}" readonly>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cutomer Name</label>
                                                        <input type="text" class="form-control" name="name" value="@if($p->customer !=null){{ $p->customer->name }}@endif" required>                        
                                                    </div>
                                                     {{-- start --}}
                                                    <div class="form-group">
                                                        <label>Phone No.</label>
                                                        <input type="tel" class="form-control" name="phone" value="@if($p->customer !=null){{ $p->customer->phone }}@endif" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea name="address" rows="2" class="form-control"  required>@if($p->customer !=null){{ $p->customer->address }}@endif</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ပစၥည္း အမ်ိဳးအမည္</label>
                                                        <input type="text" class="form-control" name="items"  value="{{ $p->name }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>အေရအတြက္</label>
                                                        <input type="number" class="form-control" name="quantity"  value="{{ $p->quantity }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ေရႊအေလးခ်ိန္</label>
                                                        <input type="text" class="form-control" name="weight" value="{{ $p->weight }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ေက်ာက္ပါ အေလးခ်ိန္</label>
                                                        <input type="text" class="form-control" name="stone_weight" value="{{ $p->stone_weight }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>တန္ဖိုး</label>
                                                        <input type="number" class="form-control" name="price" value="{{ $p->price }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ယူေငြ</label>
                                                        <input type="number" class="form-control" name="cash" max="{{ $bank->min }}" value="{{ $p->amount }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cashier Name</label>
                                                        <input type="text" class="form-control" name="cashier_name" value="{{ $p->name }}" required>                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="photos">Photos</label>
                                                        <input type="file" id="photos" name="photos[]" class="form-control" multiple>
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
                            @endcan
                        @endif
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
   </div>
@endcan
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<script>
    @if(session('success'))        
            Swal.fire({
                title: 'Success!',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                }
            })    
    @endif
</script>
@endsection