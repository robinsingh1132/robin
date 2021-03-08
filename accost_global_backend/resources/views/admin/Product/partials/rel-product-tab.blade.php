<div class="tab-pane wizard-container" id="rel-products" role="tabpanel" aria-required="rel-products-tab" aria-labelledby="rel-products-tab">
    <h3 style="margin: 10px;" class="text-left"><b>Related Products:</b> </h3>
    <div class="row">
        <div class="col-md-12 col-sm-10">
            @include('admin.Product.related-product')
        </div>
    </div>
    <form id="product_tag" method="POST" action="">
        @csrf
        <div class="form-group form-control">
            <div class="form-group form-show-validation">
                <label for="tag"> Tags <span class="required-label">*</span></label>
                <label><span class="help-label">(Press Comma after enter text to making tags.)</span></label>
                <div class="form-group form-show-validation">
                    <input type="text" data-role="tagsinput" class="form-control" id="tag-name" name="tag_name" placeholder="Enter multiple tags using # and seprated with comma." autocomplete="off" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary other_tabs" disabled><span class="btnrequired-label"><i class="fas fa-save" ></i></span> Save & Continue</button>
            <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
        </div>
    </form>
</div>