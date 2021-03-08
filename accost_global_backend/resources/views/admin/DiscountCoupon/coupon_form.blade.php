<div class="tab-pane active wizard-container" id="general" role="tabpanel" ariarequired-labelledby="general-tab"> 
@php 
    if(empty($id)){
        $id='';
    }
    if(!empty($coupon)){
        $id='discount-coupon-validate_edit'; 
    }else{
        $id='discount-coupon-validate';
    }
@endphp 
    <form id="{{$id}}" method="POST" action="{{$coupon_form_action}}">
        @csrf
        <div class="form-group form-show-validation">
            <div class="select2-input select2-warning">
                <label for="discount_type"> Discount Type <span class="required-label">*</span></label>
                <select id="discount_type" name="coupon_type" class="form-control prodAttr">
                    @php $discountType = ['0'=>'Amount', '1'=>'Percentage'] @endphp
                    <option value="">Select Discount Type</option>
                    @if(@$discountType)                   
                        @foreach(@$discountType as $key=>$val)
                            @if($key === @$coupon->coupon_type)
                                @php $selected = 'selected'; @endphp
                            @else
                                @php $selected = '';    @endphp
                            @endif
                            <option {{$selected}} value="{{$key}}">{{ $val }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <div class="select2-input select2-warning">
                <label for="coupon_available_on"> Discount Available On<span class="required-label">*</span></label>
                <select id="coupon_available_on" name="coupon_available_on" class="form-control prodAttr">
                    @php $couponAvailableOn = ['0'=>'All', '1'=>'Category', '2'=>'Product'] @endphp
                    <option value="">Select Discount Available On</option>
                    @if(@$couponAvailableOn)
                        @foreach(@$couponAvailableOn as $key=>$val)
                            @if($key === @$coupon->coupon_available_on)
                                @php $selected = 'selected'; @endphp
                            @else
                                @php $selected = '';    @endphp
                            @endif
                            <option {{$selected}} value=" {{$key}}">{{ $val }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label for="name"> Coupon Name <span class="required-label">*</span></label><span class="help-label" style="float: right">(Coupon Name format should be alphanumeric.)</span>
            <input type="text" class="form-control coupon_name" value="{{ @$coupon->name ?? old('name') }}" name="name" placeholder="Enter coupon name" autocomplete="off">
        </div>
        <div class="form-group form-show-validation">
            <label for="coupon_code"> Coupon Code <span class="required-label">*</span></label><span class="help-label" style="float: right">(Coupon code format should be alphanumeric.)</span>
            <input type="text" class="form-control coupon_code" value="{{ @$coupon->coupon_code ?? old('coupon_code') }}" name="coupon_code" placeholder="Coupon Code format like: welcome300" autocomplete="off">
        </div>
        <div class="form-group form-show-validation">
            <label for="coupon_description"> Coupon Description<span class="required-label">*</span></label>
            <textarea required class="form-control" id="summernote" name="coupon_description" placeholder="Coupon Description" >{!! strip_tags($coupon->coupon_description ?? old('coupon_description')) !!}</textarea>
            <label class="error" id="summernote-1-error"></label>
        </div>
        <div class="form-group form-show-validation">
            <label for="value"> Value <span class="required-label">*</span></label>
            <input type="text" class="form-control" value="{{ @$coupon->value ?? old('value') }}" name="value" placeholder="Enter value" autocomplete="off">
        </div>        
        <div class="form-group form-show-validation">
            <div class="select2-input select2-warning">
                <label for="duration"> Duration <span class="required-label">*</span></label>
                @php $duration = ['once'=>'Once', 'forever'=>'Forever'] @endphp
                <select id="duration" name="duration" class="form-control date_change">
                    <option value="">Select Duration</option>
                    @if(@$duration)
                        @foreach(@$duration as $key=>$val)
                            @if($key == @$coupon->duration)
                                @php $selected = 'selected'; @endphp
                            @else
                                @php $selected = '';    @endphp
                            @endif
                            <option {{$selected}} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label for="maximum_quantity"> Maximum Quantity <span class="required-label">*</span></label>
            <input type="text" id="maximum_quantity" class="checkNumber form-control" name="maximum_quantity" value="{{ @$coupon->maximum_quantity ?? old('maximum_quantity') }}" placeholder="Enter maximum quantity" autocomplete="off">
        </div>
        <div class="form-group form-show-validation">
            <label for="minimum_quantity"> Minimum Quantity <span class="required-label">*</span></label>
            <input type="text" id="minimum_quantity" class="checkNumber form-control" name="minimum_quantity" value="{{ @$coupon->minimum_quantity ?? old('minimum_quantity') }}" placeholder="Enter minimum quantity" autocomplete="off">
        </div>
        <div class="form-group form-show-validation">
            <label for="maximum_redemption"> Maximum Redemption </label>
            <input type="text" class="checkNumber form-control" name="maximum_redemption" value="{{ @$coupon->maximum_redemption ?? old('maximum_redemption') }}" placeholder="Enter maximum redemption" autocomplete="off">
        </div>
        <div class="form-group form-show-validation">
            <label for="start_date"> Start Date <span class="required-label">*</span></label>
            <input type="hidden" id="prv_start_date_edit" class="form-control " name="prv_start_date_edit" value="{{ date('d/m/Y', strtotime(@$coupon->start_date)) ?? old('start_date') }}">
            <input type="text" id="start_date" class="form-control  startDate" name="start_date" value="{{ date('d/m/Y', strtotime(@$coupon->start_date)) ?? old('start_date') }}" placeholder="Enter start date" autocomplete="off">
        </div>
        <div class="form-group form-show-validation end_date_validation">
            <label for="end_date"> End Date <span class="required-label">*</span></label>
            <input type="hidden" id="prv_end_date" class="form-control " name="prv_end_date" value="">
            <input type="hidden" id="prv_end_date_edit" class="form-control " name="prv_end_date_edit" value="{{ date('d/m/Y', strtotime(@$coupon->end_date)) ?? old('end_date') }}">
            <input type="text" id="end_date" class="form-control date_change endDate" name="end_date" value="{{ date('d/m/Y', strtotime(@$coupon->end_date)) ?? old('end_date') }}" placeholder="Enter end date" autocomplete="off">
        </div>
        @if(!empty($onlyView))
            <div class="form-group form-show-validation">
                <!-- <input type="hidden" name="is_next_tab" value='0'> -->
                <a href="{{ route('edit-coupons',$coupon->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
            </div>
        @elseif(!empty($coupon->id))
            <div class="form-group form-show-validation">
                <input type="hidden" name="is_next_tab" value='0'>
                <button type="submit" class="btn btn-primary coupon_submit"><span class="btnrequired-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update & Continue</button>
                <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
            </div>
        @elseif(!empty($saveTab))
            <div class="form-group form-show-validation">
                <input type="hidden" name="is_next_tab" value='0'>
                <button type="submit" class="btn btn-primary coupon_submit"><span class="btnrequired-label"><i class="fas fa-save" ></i></span> Save & Continue</button>
                <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
            </div>
        @else
            <div class="form-group form-show-validation">
                <input type="hidden" name="is_next_tab" value='0'>
                <button type="submit" class="btn btn-primary coupon_submit"><span class="btnrequired-label"><i class="fas fa-save" ></i></span> Save & Continue</button>
                <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
            </div>
        @endif
    </form>
</div>