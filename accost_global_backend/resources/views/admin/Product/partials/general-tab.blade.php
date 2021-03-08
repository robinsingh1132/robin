<div class="tab-pane active wizard-container" id="general" role="tabpanel" ariarequired-labelledby="general-tab">
    <h3 style="margin: 10px;" class="text-left"><b>Product General Details:</b></h3>
    <form id="product_validate" method="POST" action="{{ route('product-save') }}">
        @csrf
        <div class="form-group form-show-validation">
            <label for="name"> Product Name <span class="required-label">*</span></label>
            <input type="text" id="general-product-name" class="form-control product_name" value="{{ @$product->name ?? old('name') }}" name="name" placeholder="Product Name" autocomplete="off" >
        </div>
        <div class="form-group form-show-validation">
            <label> Super Category<span class="required-label">*</span></label>
            <div class="row">
                <div class="col-md-12 col-sm-10">
                    <div class="">
                        <select id="prod-sup-cat" name="super_category_id" class="form-control"
                                data-action="{{ route('get-product-category') }}" >
                            @if(@$superCategories)
                                <option value=""> Select Super Category</option>
                                @foreach(@$superCategories as $val)
                                    @if(@$product_super_cat && in_array($val->id, @$product_super_cat))
                                        @php $selected = 'selected'; @endphp
                                    @else
                                        @php $selected = '';    @endphp
                                    @endif
                                    <option {{$selected}} value="{{ $val->id}}">{{ $val->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label> Category<span class="required-label">*</span></label>
            <div class="row">
                <div class="col-md-12 col-sm-10">
                    <div class="select2-input select2-warning">
                        <select id="prod-cat" name="category_id" class="form-control" >
                            <option value=""> Category</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label> Subcategory<span class="required-label">*</span></label>
            <div class="row">
                <div class="col-md-12 col-sm-10">
                    <div class="select2-input select2-warning">
                        <select id="prod-sub-cat" name="subcategory_id" class="form-control" >
                            <option value=""> Subcategory</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label> Brands<span class="required-label">*</span></label>
            <div class="row">
                <div class="col-md-12 col-sm-10">
                    <div class="select2-input select2-warning">
                        <select id="prod-brand" name="brand_id" class="form-control" >
                            <option value=""> Brand</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label for="product_type">Taxable Product Type <span class="required-label">*</span></label>
            <div class="row">
                <div class="col-md-12 col-sm-10">
                    <div class="select2-input select2-warning">
                        <select id="product-type" name="product_type" class="form-control">
                            <option value="">Select Taxable Product Type</option>
                            @if(@$productType)
                                @foreach(@$productType as $val)
                                    @if($val->id == @$product->tax_product_type_id)
                                        @php $selected = 'selected'; @endphp
                                    @else
                                        @php $selected = '';    @endphp
                                    @endif
                                    <option {{$selected}} value="{{ $val->id }}">{{ $val->type }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-show-validation">
            <label for="sku"> SKU <span class="required-label">*</span></label>
            <input type="text" id="sku" class="form-control" value="{{ @$product->sku ?? old('sku') }}" name="sku" placeholder="Enter SKU"  autocomplete="off" >
        </div>
        <div class="form-group form-show-validation">
            <label for="product_details"> Specifications 1<span class="required-label">*</span></label>
            <textarea required class="form-control" id="summernote" name="product_details" placeholder="Product Specification 1" >{{ @$product->product_details ?? old('product_details') }}</textarea>
            <label class="error" id="summernote-1-error"></label>
        </div>
        <div class="form-group form-show-validation">
            <label for="additional_details"> Specifications 2 </label>
                <textarea class="form-control" id="summernote2" name="additional_details" placeholder="Product
                Specification 2">{{ @$product->additional_details ?? old('additional_details') }}</textarea>
        </div>
        <div class="form-group form-show-validation">
            <label for="term_and_condition"> Terms and Conditions </label>
            <textarea class="form-control" id="summernote3" name="term_and_condition" placeholder="Terms and Condition" >{{ @$product->additional_details ?? old('additional_details') }}</textarea>
        </div>
        <div class="form-check">
            <label>Is Featured <span class="required-label">*</span></label><br>
            <label class="form-radiorequired-label">
                <input class="form-radio-input" type="radio" name="is_featured" value="1" {{ @$product->is_featured == 1 ? 'checked' : '' }}>
                <span class="form-radio-sign">Yes</span>
            </label>
            <label class="form-radiorequired-label ml-3">
                <input class="form-radio-input" type="radio" name="is_featured" value="0" {{ @$product->is_featured == 0 ? 'checked' : '' }}>
                <span class="form-radio-sign">No</span>
            </label>
        </div>
        <div class="form-check">
            <label>Is Free Shipping <span class="required-label">*</span></label><br>
            <label class="form-radiorequired-label">
                <input class="form-radio-input" type="radio" name="is_free_shipping" value="1" {{ @$product->is_free_shipping == 1 ? 'checked' : '' }}>
                <span class="form-radio-sign">Yes</span>
            </label>
            <label class="form-radiorequired-label ml-3">
                <input class="form-radio-input" type="radio" name="is_free_shipping" value="0" {{ @$product->is_free_shipping == 0 ? 'checked' : '' }}>
                <span class="form-radio-sign">No</span>
            </label>
        </div>
        <div class="form-check">
            <label>Is Review Allowed <span class="required-label">*</span></label><br>
            <label class="form-radiorequired-label">
                <input class="form-radio-input" type="radio" name="is_review_allowed" value="1" {{ @$product->is_review_allowed == 1 ? 'checked' : '' }}>
                <span class="form-radio-sign">Yes</span>
            </label>
            <label class="form-radiorequired-label ml-3">
                <input class="form-radio-input" type="radio" name="is_review_allowed" value="0" {{ @$product->is_review_allowed == 0 ? 'checked' : '' }}>
                <span class="form-radio-sign">No</span>
            </label>
        </div>
        @if(@$product->id)
            <div class="form-check">
                <label>Status <span class="required-label">*</span></label><br>
                <label class="form-radiorequired-label">
                    <input class="form-radio-input" type="radio" name="status" value="1" {{ @$product->status == 1 ? 'checked' : '' }}>
                    <span class="form-radio-sign">Activate</span>
                </label>
                <label class="form-radiorequired-label ml-3">
                    <input class="form-radio-input" type="radio" name="status" value="0" {{ @$product->status == 0 ? 'checked' : '' }}>
                    <span class="form-radio-sign">Inactivate</span>
                </label>
            </div>
        @endif
        <div class="form-group form-show-validation">
            <button type="submit" {{--id="general-details"--}} class="btn btn-primary"><span class="btnrequired-label"><i
                            class="fas fa-save" ></i></span> Save & Continue</button>
            <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
        </div>
    </form>
</div>