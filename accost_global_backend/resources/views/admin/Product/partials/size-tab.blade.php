<div class="tab-pane wizard-container" id="size" role="tabpanel" ariarequired-labelledby="size-tab">
    <h3 class="text-left" style="margin: 10px"><b>Product Sizes and Sets:</b></h3>
    <div class="row pd-3" id="f-pro-size"> 
        <div class="col-md-12">
            <form class="form-inline" id="t-form-size">
                <h5 class="col-md-12 mt-1"><b>Add Product Size:</b></h5>
                <div class="form-group input-group-sm">
                    <label for="t-prod-size"></label>
                    <input type="text" class="form-control" name="pro_size" id="t-prod-size" placeholder="Size Name" autocomplete="off">
                </div>
                <div class="form-group input-group-sm">
                    <label for="t-prod-original-price"></label>
                    <input type="text" class="form-control" name="o_price" id="t-o-price" placeholder="Original Price/Unit" autocomplete="off">
                </div>
                <div class="form-group input-group-sm">
                    <button class="btn btn-primary btn-sm" id="t-add-size">Add Size</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row pd-3" style="display: none;" id="f-pro-set">
        <div class="col-md-12 ">
            <button class="btn btn-primary btn-xs" id="f-more-size"><i class="fa fa-plus-circle"></i> Add More Sizes</button>
            <h5 class="mt-1"><b>Add Product Set:</b></h5>
            <p class="text-left text-primary mt-1 font-weight-bold mb-0" id="p-set-info"></p>
            <form id="s-form-set">
                <div class="form-row align-items-end">
                    <div class="col form-group input-group-sm">
                        <label for="s-size-name" class="d-block">Size Name</label>
                        <input type="text" name="size_name" id="s-size-name" class="form-control" placeholder="Size Name" readonly style="background: transparent !important;font-weight: bold; color: black; border: none">
                    </div>
                    <div class="col form-group input-group-sm">
                        <label for="s-o-price" class="d-block">Original Price</label>
                        <input type="text" name="o_price" id="s-o-price" class="form-control" placeholder="Original Price/Unit" size="10" readonly style="background: transparent !important;font-weight: bold; color: black; border: none">
                    </div>
                    <div class="col form-group input-group-sm">
                        <label for="s-min-qty" class="d-block">Min Qty</label>
                        <input type="text" name="min_qty" id="s-min-qty" class="form-control" placeholder="Min Qty" size="8" autocomplete="off">
                    </div>
                    <div class="col form-group input-group-sm">
                        <label for="s-max-qty" class="d-block">Max Qty.</label>
                        <input type="text" name="max_qty" id="s-max-qty" class="form-control" placeholder="Max Qty" size="8" autocomplete="off">
                    </div>

                    <div class="col form-group input-group-sm">
                        <label for="s-price" class="d-block">Offered Price/Unit</label>
                        <input type="text" name="s_price" id="s-price" class="form-control" placeholder="Offered Price/Unit" size="10" autocomplete="off">
                    </div>
                    <div class="col form-group input-group-sm">
                        <label class="d-block"></label>
                        <button class="btn btn-primary btn-sm" id="s-add-set">Add Set</button>
                    </div>
                </div>
            </form>
            <p class="text-center text-danger mt-1" id="p-set-error"></p>
        </div>
    </div>
    <div class="row" style="display: none; margin-bottom: 23px" id="u-size-form">
        <div class="col-md-12">
            <form class="form-inline" id="u-form-size">
                <h5 class="col-md-12 mt-1"><b>Update Product Size:</b></h5>
                <input type="hidden" name="old_size_name">
                <div class="form-group input-group-sm">
                    <label for="u-prod-size"></label>
                    <input type="text" class="form-control" name="pro_size" id="u-prod-size" placeholder="Size Name" autocomplete="off">
                </div>
                <div class="form-group input-group-sm">
                    <label for="u-prod-original-price"></label>
                    <input type="text" class="form-control" name="o_price" id="u-o-price" placeholder="Original Price/Unit" autocomplete="off">
                </div>
                <div class="form-group input-group-sm">
                    <button class="btn btn-primary btn-sm" id="u-add-size">Update Size</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row pd-3">
        <div class="col-md-12 mt-1 pd-3" id="t-table-size">
            {{--to be filled by JS--}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 mt-2">
            <form id="product_size" method="POST" action="">
                @csrf
                <button type="submit" class="btn btn-primary other_tabs" disabled><span class="btnrequired-label">
                            <i class="fas fa-save" ></i></span> Save & Continue</button>
                <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
            </form>
        </div>
    </div>
</div>