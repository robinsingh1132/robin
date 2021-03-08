@php
if(empty($order))
$order='';
if(empty($check1))
$check1='';
if(empty($check2))
$check2='';
if(empty($check0))
$check0='';
@endphp
<form id="frm-order-details" method="POST" action="{{ route('update-payment-status',$payment->order_id) }}">
    @csrf
    <div class="form-group form-show-validation">
        <label for="name">Payment Id</label>
        <input type="text" class="form-control" value="{{ @$payment->id}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Order Id</label>
        <input type="text" class="form-control" value="{{ @$payment->order_id}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Transaction Id</label>
        <input type="text" class="form-control" value="{{ @$payment->transaction_id}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Payment Mode</label>
        <input type="text" class="form-control" value="{{ @$payment->payment_mode}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Amount</label>
        <input type="text" class="form-control" value="{{ @$payment->amount}}" disabled="true">
    </div>
    <div class="form-check">
        <label>Status <span class="required-label">*</span></label><br>
        @php
            if($payment->payment_status==1){
                $check1='checked';
            }elseif($payment->payment_status==2){
                $check2='checked';
            }elseif($payment->payment_status==0){
                $check0='checked';
            }else{
                $check1='';
                $check2='';
                $check0='';
            }
        @endphp
        <label class="form-radio-label">        
            <input class="form-radio-input" type="radio" name="payment_status" value="1" {{$check1}}>
            <span class="form-radio-sign">Done</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="payment_status" value="0" {{$check0}}>
            <span class="form-radio-sign">cancel</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="payment_status" value="2" {{$check2}}>
            <span class="form-radio-sign">Pending</span>
        </label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update</button>
        <a href="{{ route('order-payment-details',$payment->order_id) }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
    </div>
</form>