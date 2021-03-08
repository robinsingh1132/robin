@csrf
<div class="form-group">
    <label for="pro_super_category">Brand Super Category <span class="required-label">*</span></label>
    <select class="form-control" id="super_category_id" name="super_category_id">
        <option value="">Choose Category</option>
        @foreach($pro_super_categories as $supCategory)
            @php $selected = ''; @endphp
            @if(@$supCategory->id == @$brand->super_category_id)
                @php $selected = 'selected'; @endphp
            @endif
            <option {{ $selected }} value="{{ $supCategory->id }}">{{ $supCategory->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group form-show-validation">
    <label for="brand_name">Brand Name <span class="required-label">*</span></label>
    <input type="text" class="brand_name form-control" value="{{ @$brand->brand_name ?? old('brand_name') }}" name="brand_name" placeholder="Brand Name">
</div>
<div class="form-group form-show-validation">
    <label for="slug">Slug <span class="required-label">*</span></label>
    <input type="text" id="slug" class="form-control" name="slug" value="{{ @$brand->slug ?? old('slug') }}" placeholder="Brand Slug">
</div>
<div class="form-check">
    <label>Status <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="status" value="1" @if(@$brand->status) checked="" @endif>
        <span class="form-radio-sign">Active</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="status" value="0" @if(!@$brand->status) checked="" @endif>
        <span class="form-radio-sign">Inactive</span>
    </label>
</div>
<div class="form-group form-show-validation">
    <label for="icon">Icon </label>
    <div class="col-lg-12">
        <!-- image upload section -->
        <div class="small-12 medium-2 large-2 columns">
            <div class="circle">
                <img class="img-upload" src="{{ @$brand->icon ? asset('/images/brand/'.@$brand->icon) : asset('admin/img/no-image.png') }}" height="100" width="50">
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