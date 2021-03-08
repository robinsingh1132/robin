<div class="container">
	<div class="form-control">
		<h6>Please select below categories for apply coupon.</h6>	
		<div class="row">		
			<div class="col-md-12" id="treeview-category">
			</div>
		</div>
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