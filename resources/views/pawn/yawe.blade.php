@extends('layouts.pawn')
@section('contents')
    <div class="yawe-content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 shadow pt-2 pb-2">
            <h3 class="text-center zawgyi-one">ေရြး</h3>
                <form action="{{ route('yawe_update', $pawn->id) }}" method="post">
                @csrf 
                    <div class="form-group">
                        <label> ေပါင္ေသာ Date</label>
                        <input type="text" class="form-control" name="pdate" value="{{  $pawn->date }}" readonly>                        
                    </div>
                    <div class="form-group">
                        <label>Voucher No.</label>
                        <input type="text" class="form-control" name="voucher" value="{{ $pawn->voucher }}" readonly>                        
                    </div>
                    <div class="form-group">
                        <label>ပစၥည္း အမ်ိဳးအမည္</label>
                        <input type="text" class="form-control" name="name" value="{{ $pawn->name }}" readonly>                        
                    </div>
                    <div class="form-group">
                        <label>ယူေငြ </label>
                        <input type="text" class="form-control" name="pamount" value="{{ $pawn->amount }}" readonly>                        
                    </div>
                    <div class="form-group">
                        <label class="zawgyi-one">က်သင့္ေငြ</label>
                    <input type="text" class="form-control" name="cash" value="{{$yawe_price}}" readonly>                        
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" name="discount" placeholder="Enter Discount">                        
                    </div>
                    <div>
                        <input type="radio" id="finished_yawe" name="yawe_status" value="finished"
                               checked>
                        <label for="finished_yawe">အျပီး ေရြး</label>
                      </div>
                      
                      <div>
                        <input type="radio" id="loss_pawn" name="yawe_status" value="loss">
                        <label for="loss_pawn">အေပါင္ဆံုး</label>
                      </div>

                    {{-- <div class="form-group">
                        <label>Interest</label>
                        <input type="number" class="form-control" name="interest" placeholder="Type Interest" required>                        
                    </div> --}}
                    <button class="btn btn-success">Confirm</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>        
    </div>
@endsection