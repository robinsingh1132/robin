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
<form id="frm-order-details" method="POST" action="{{ route('update-order',$order->id) }}">
    @csrf
    <div class="form-group form-show-validation">
        <label for="name">Order Id</label>
        <input type="text" class="form-control" value="{{ @$order->id}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Order Date</label>
        <input type="text" class="form-control" value="{{ @$order->order_date}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Invoice Id</label>
        <input type="text" class="form-control" value="{{ @$order->invoice_id}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Total Amount</label>
        <input type="text" class="form-control" value="{{ @$order->total_amount}}" disabled="true">
    </div>
    <div class="form-group form-show-validation">
        <label for="name">Shipped Date</label>
        <input type="text" class="form-control" value="{{ @$order->shipped_date}}" disabled="true">
    </div>
    <div class="form-check">
        <label>Status <span class="required-label">*</span></label><br>
        @php
            if($order->status==1){
                $check1='checked';
            }elseif($order->status==2){
                $check2='checked';
            }elseif($order->status==0){
                $check0='checked';
            }else{
                $check1='';
                $check2='';
                $check0='';
            }
        @endphp
        <label class="form-radio-label">        
            <input class="form-radio-input" type="radio" name="status" value="1" {{$check1}}>
            <span class="form-radio-sign">Approved</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="status" value="0" {{$check0}}>
            <span class="form-radio-sign">Reject</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="status" value="2" {{$check2}}>
            <span class="form-radio-sign">Pending</span>
        </label>
    </div>
    <div class="form-group form-show-validation">
        <label for="remark">Remark</label>
        <textarea class="form-control" id="remark" rows="4" cols="50" name="remark">{{ $order->remark }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update</button>
        <a href="{{ route('list-order') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
    </div>
</form>