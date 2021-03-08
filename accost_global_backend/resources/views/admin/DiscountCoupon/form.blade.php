<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active " id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">Coupon Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="apply-coupon-tab" data-toggle="tab" href="#apply-coupon" role="tab" aria-controls="apply-coupon" aria-selected="false">Apply Coupon</a>
    </li>
</ul>
<div class="tab-content">
    @include('admin.DiscountCoupon.coupon_form')
    @include('admin.DiscountCoupon.apply_coupon_form')
</div>