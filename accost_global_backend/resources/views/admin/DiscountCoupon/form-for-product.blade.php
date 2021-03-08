<div class="card col-md-12">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-edit text-success"></i> Product List                
        </div>                            
    </div>                
    <div class="card-body">
        @include('flash::message')
        <div class="col-md-12">
            <div class="col-md-12 form-control" style="margin-bottom: 15px">
                <span><span class="required-label">*</span> Please choose product from below list if you need to apply coupon for product.</span>
                <span><span class="required-label">*</span> Coupon already applicable for selected product. If you uncheck the product from product list coupon not applicable for that product.</span>
            </div>
            <div class="table-responsive">
                <table id="dt-product-list" class="display table table-striped table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Check</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>            
            @if(!empty($onlyView))
                <div class="form-group form-show-validation">
                    <a href="{{ url('/admin/discount-coupons/edit/'.$coupon->id.'?nextTab=1') }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                    <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                </div>
            @elseif(!empty($saveTab))
                <div class="form-group form-show-validation">
                    <a href="javascript:void(0)" class="apply_button_save btn btn-primary text-white"><span class="btn-label"><i class="fas fa-save"></i></span> Save and Continue</a>
                    <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                </div>
            @else
                <div class="form-group form-show-validation">
                    <a href="javascript:void(0)" class="apply_button_update btn btn-primary text-white"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update and Continue</a>
                    <a href="{{ route('list-coupons') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                </div>
            @endif
        </div>
    </div>
</div>   