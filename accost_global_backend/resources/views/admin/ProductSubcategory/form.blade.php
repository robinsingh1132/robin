@csrf
<div class="form-group">
    <label for="pro_category">Product Category <span class="required-label">*</span></label>
    <select class="form-control" id="pro_category" name="product_category_id">
        <option value="">Choose Category</option>
        @foreach(@$pro_categories as $category)
            @php $selected = ''; @endphp
            @if($category->id == @$product_subcategory->product_category_id)
                @php $selected = 'selected'; @endphp
            @endif
            <option {{ $selected }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group form-show-validation">
    <label for="name">Name <span class="required-label">*</span></label>
    <input type="text" class="product_subcat form-control" value="{{ @$product_subcategory->name ?? old('name') }}" name="name" placeholder="Enter product Subcategory Name"
           >
</div>
<div class="form-group form-show-validation">
    <label for="slug">Slug <span class="required-label">*</span></label>
    <input type="text" id="slug" class="form-control" name="slug" value="{{ @$product_subcategory->slug }}" placeholder="Enter slug">
</div>
<div class="form-group form-show-validation">
    <label for="page_title">Page Title </label>
    <input type="text" id="page_title" class="form-control" name="page_title" value="{{ @$product_subcategory->page_title ?? old('page_title') }}" placeholder="Enter page title">
</div>
<div class="form-group form-show-validation">
    <label for="seo_keywords">Seo Keywords</label>
    <input type="text" class="form-control" name="seo_keywords" value="{{ @$product_subcategory->seo_keywords ?? old('seo_keywords') }}" placeholder="Enter keywords">
</div>
<div class="form-group form-show-validation">
    <label for="seo_description">Seo Description</label>
    <textarea rows="5" type="text" class="form-control" id="seo_description" name="seo_description" placeholder="Enter seo description">{{ @$product_subcategory->seo_description ?? old('seo_description') }}</textarea>
</div>
<div class="form-check" style="display: none">
    <label>Featured Subcategory <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="is_featured" value="1" @if(@$product_subcategory->is_featured) checked="" @endif>
        <span class="form-radio-sign">Yes</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="is_featured" value="0" @if(!@$product_subcategory->is_featured) checked="" @endif>
        <span class="form-radio-sign">No</span>
    </label>
</div>
<div class="form-check">
    <label>Status <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="status" value="1" @if(@$product_subcategory->status) checked="" @endif>
        <span class="form-radio-sign">Active</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="status" value="0" @if(!@$product_subcategory->status) checked="" @endif>
        <span class="form-radio-sign">Inactive</span>
    </label>
</div>
<div class="form-group form-show-validation">
    <label for="icon">Icon </label>
    <div class="col-lg-12">
        <!-- image upload section -->
        <div class="small-12 medium-2 large-2 columns">
            <div class="circle">
                <img class="img-upload" src="{{ @$product_subcategory->icon ? asset('/images/sub-category/'.@$product_subcategory->icon) : asset('admin/img/no-image.png') }}" height="100" width="50">
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
