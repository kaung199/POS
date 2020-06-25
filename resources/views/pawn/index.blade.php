@extends('layouts.pawn')
@section('contents')
    @can('pawn-index')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="padding-content">
        <div class="row">
            <div class="col-md-12 pb-3 text-center">
            <button class="btn btn-success w-b zawgyi-one" data-toggle="modal" data-target="#ModalExample">ေပါင္</button>
            </div>
            <div class="col-md-12 pb-3 text-center">
            <button class="btn btn-success w-b zawgyi-one" data-toggle="modal" data-target="#ModalExample1">ေရြး</button>
            </div>
            <div class="col-md-12 pb-3 text-center">
            <button class="btn btn-success w-b zawgyi-one" data-toggle="modal" data-target="#ModalExample2">အသံုးစရိတ္</button>
            </div>
        </div>
         <!-- create pawn -->
        <div id="ModalExample" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-xs-center zawgyi-one">ေပါင္</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('pawnform') }}" enctype='multipart/form-data'>
                        @csrf
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date">                        
                            </div>
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Customer Name" required>                        
                            </div>
                            <div class="form-group">
                                <label>Voucher No.</label>
                                <input type="text" class="form-control" name="voucher" placeholder="Voucher Number" required>                        
                            </div>
                            {{-- start --}}
                            <div class="form-group">
                                <label>Phone No.</label>
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>                        
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" rows="2" class="form-control" placeholder="Enter Address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>ပစၥည္း အမ်ိဳးအမည္</label>
                                <input type="text" class="form-control" name="items"  placeholder="Items Name" required>                        
                            </div>
                            <div class="form-group">
                                <label>အေရအတြက္</label>
                                <input type="number" class="form-control" name="quantity"  placeholder="Amount Price" required>                        
                            </div>
                            <div class="form-group">
                                <label>ေရႊအေလးခ်ိန္</label>
                                <input type="text" class="form-control" name="weight" placeholder="Enter Weight" required>                        
                            </div>
                            <div class="form-group">
                                <label>ေက်ာက္ပါ အေလးခ်ိန္</label>
                                <input type="text" class="form-control" name="stone_weight" placeholder="Stone + Weight" required>                        
                            </div>
                            <div class="form-group">
                                <label>တန္ဖိုး</label>
                                <input type="number" class="form-control" name="price" placeholder="Enter Price" required>                        
                            </div>
                            <div class="form-group">
                                <label>ယူေငြ</label>
                                <input type="number" class="form-control" name="cash" max="{{ $bank->min }}" placeholder="Enter cash" required>                        
                            </div>
                            <div class="form-group">
                                <label>Cashier Name</label>
                                <input type="text" class="form-control" name="cashier_name" placeholder="Enter Your Name" required>                        
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
         <!-- create yawe -->
        <div id="ModalExample1" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-xs-center zawgyi-one">ေရြး</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="GET" action="{{ route('yawe') }}">
                        @csrf
                            <div class="form-group">
                                <label>Voucher No.</label>
                                <input type="text" class="form-control" name="search" placeholder="Enter Voucher No" required>                        
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-info btn-block">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal end-->
         <!-- create costs -->
        <div id="ModalExample2" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-xs-center zawgyi-one">အသံုးစရိတ္</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('costs') }}">
                        @csrf
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control" value="{{ date('Y-m-d') }}" name="date" readonly>                        
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>                        
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="Enter Amount" required>                        
                            </div>
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea name="reason" cols="30" rows="2" class="form-control" placeholder="Enter Reason" required></textarea>                      
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
    @if(session('notfount'))        
            Swal.fire({
                title: 'Voucher Not Found!',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                }
            })    
    @endif
</script>
@endsection
