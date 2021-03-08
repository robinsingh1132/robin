<div class="tab-pane wizard-container" id="apply-coupon" role="tabpanel" ariarequired-labelledby="apply-coupon-tab">    
    <div class="js-message">
    
    </div>
    @csrf
    @if(!empty($coupon))
        <div class="form-group form-show-validation">
            <label for="name">Coupon Name :&nbsp</label><span>{{$coupon->name}}</span>,&nbsp&nbsp<label for="name">Coupon Code :&nbsp</label><span>{{$coupon->coupon_code}}</span>,&nbsp&nbsp<label for="name">Coupon Value :&nbsp</label><span>{{$coupon->value}}</span>
        </div>
    
        @if($coupon->coupon_available_on==1)
            @include('admin.DiscountCoupon.form-for-treecategory')
        @endif
        @if($coupon->coupon_available_on==2)
            @include('admin.DiscountCoupon.form-for-product')
        @endif 
        @if($coupon->coupon_available_on==0)    
            <div class="container">
                <div class="form-group form-show-validation form-control">
                    <h6>This Coupon is applicable for all products and categories.</h6>
                </div>
                @if(!empty($onlyView))
                    <div class="form-group form-show-validation">
                        <a href="{{ url('/admin/discount-coupons/edit/'.$coupon->id.'?nextTab=1') }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                        <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                    </div>  
                @elseif($saveTab=='save')
                    <div class="form-group form-show-validation">
                        <a href="javascript:void(0)" class="apply_button_save btn btn-primary text-white"><span class="btn-label"><i class="fas fa-save"></i></span>Save & Continue</a>
                        <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                    </div>
                @else
                    <div class="form-group form-show-validation">
                        <a href="javascript:void(0)" class="apply_button_update btn btn-primary text-white"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span>Update & Continue</a>
                        <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                    </div>
                @endif
            </div>
        @endif            
    @else
        <div class="form-group form-show-validation">
            <span class="required-label">*</span><span>Please create coupon then you can able to apply coupon for products or categories.</span>
        </div>
    @endif
</div>