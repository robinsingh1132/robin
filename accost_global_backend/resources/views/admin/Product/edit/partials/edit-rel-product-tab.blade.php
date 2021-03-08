<div class="tab-pane" id="rel-products" role="tabpanel" aria-required="rel-products-tab" aria-labelledby="rel-products-tab">
    <h4 style="margin: 10px;" class="text-danger text-center"> <b>Add Related Product</b> </h4>
    <div class="container">
        <div class="col-md-12 col-sm-10">
            @include('admin.Product.edit.related-product')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-show-validation">
                <form id="product_tag" method="POST" action="{{route('save-products-tag',$product->id)}}">
                    @csrf
                    <div class="form-group form-control">
                        <div class="form-group form-show-validation">
                            <label for="tag"> Tags <span class="required-label">*</span></label>
                            <label><span class="help-label">(Press Comma after enter text to making tags.)</span></label>
                            <div class="form-group form-show-validation">
                                <input  class="form-control" type="text" id="tag-name" data-role="tagsinput" name="tag_name" placeholder="Enter multiple tags." autocomplete="off" value="{{$tag_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary other_tabs" ><span class="btnrequired-label"><i class="fas fa-arrow-alt-circle-up" ></i></span> Update & Continue</button>
                        <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>