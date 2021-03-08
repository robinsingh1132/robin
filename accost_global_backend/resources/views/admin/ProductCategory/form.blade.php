@csrf
<div class="form-group">
    <label for="pro_super_category">Product Super Category <span class="required-label">*</span></label>
    <select class="form-control" id="pro_super_category" name="product_super_category_id">
        <option value="">Choose Category</option>
        @foreach($pro_super_categories as $supCategory)
            @php $selected = ''; @endphp
            @if(@$supCategory->id == @$product_category->product_super_category_id)
                @php $selected = 'selected'; @endphp
            @endif
            <option {{ $selected }} value="{{ $supCategory->id }}">{{ $supCategory->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group form-show-validation">
    <label for="name">Name <span class="required-label">*</span></label>
    <input type="text" class="product_category form-control" value="{{ @$product_category->name ?? old('name') }}" name="name" placeholder="Product Category Name"
           >
</div>
<div class="form-group form-show-validation">
    <label for="slug">Slug <span class="required-label">*</span></label>
    <input type="text" id="slug" class="form-control" name="slug" value="{{ @$product_category->slug ?? old('slug') }}" placeholder="Product Category Slug">
</div>
<div class="form-group form-show-validation">
    <label for="page_title">Page Title </label>
    <input type="text" id="page_title" class="form-control" name="page_title" value="{{ @$product_category->page_title ?? old('page_title') }}" placeholder="Page Title">
</div>
<div class="form-group form-show-validation">
    <label for="seo_keywords">Seo Keywords</label>
    <input type="text" class="form-control" name="seo_keywords" value="{{ @$product_category->seo_keywords ?? old('seo_keywords') }}" placeholder="Keywords">
</div>
<div class="form-group form-show-validation">
    <label for="seo_description">Seo Description</label>
    <textarea rows="5" type="text" class="form-control" id="seo_description" name="seo_description">{{ @$product_category->seo_description ?? old('seo_description') }}</textarea>
</div>
<div class="form-check" style="display: none">
    <label>Featured Category <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="is_featured" value="1" @if(@$product_category->is_featured) checked="" @endif>
        <span class="form-radio-sign">Yes</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="is_featured" value="0" @if(!@$product_category->is_featured) checked="" @endif>
        <span class="form-radio-sign">No</span>
    </label>
</div>
<div class="form-check">
    <label>Status <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="status" value="1" @if(@$product_category->status) checked="" @endif>
        <span class="form-radio-sign">Active</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="status" value="0" @if(!@$product_category->status) checked="" @endif>
        <span class="form-radio-sign">Inactive</span>
    </label>
</div>
<div class="form-group form-show-validation">
    <label for="icon">Icon </label>
    <div class="col-lg-12">
        <!-- image upload section -->
        <div class="small-12 medium-2 large-2 columns">
            <div class="circle">
                <img class="img-upload" src="{{ @$product_category->icon ? asset('/images/category/'.@$product_category->icon) : asset('admin/img/no-image.png') }}" height="100" width="50">
            </div>
            <div class="p-image form-group">
                <i class="fa fa-camera upload-button"></i>
                <input name="icon" id="file-upload" class="file-upload" type="file" accept=".jpeg, .jpg, .png"/>
                @if ($errors->has('icon'))
                    <span class="help-block text-danger image-val choose-image">
                        <strong>{{ $errors->first('icon') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div id="icon-error" style="margin-top: 140px;" class="text-danger"></div>
</div>
