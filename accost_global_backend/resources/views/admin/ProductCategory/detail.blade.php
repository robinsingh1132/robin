@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Product Category</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="flaticon-home text-primary"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);">Product Category Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Product Category Details</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="pro_super_category">Product Super Category <span class="required-label">*</span></label>
                                        <select class="form-control" id="pro_super_category" name="product_super_category_id" disabled>
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
                                        <input disabled type="text" class="form-control" value="{{ @$product_category->name ?? old('name') }}" name="name" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="slug">Slug <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" name="slug" value="{{ @$product_category->slug ?? old('slug') }}" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="page_title">Page Title </label>
                                        <input disabled type="text" class="form-control" name="page_title" value="{{ @$product_category->page_title ?? old('page_title') }}" placeholder="Page Title">
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="seo_keywords">Seo Keywords</label>
                                        <input disabled type="text" class="form-control" name="seo_keywords" value="{{ @$product_category->seo_keywords ?? old('seo_keywords') }}" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="seo_description">Seo Description</label>
                                        <textarea rows="5" disabled type="text" class="form-control" id="seo_description" name="seo_description">{{ @$product_category->seo_description ?? old('seo_description') }}</textarea>
                                    </div>
                                    <div class="form-check" style="display: none">
                                        <label>Featured Category <span class="required-label">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" disabled type="radio" name="is_featured" value="1" @if(@$product_category->is_featured) checked="" @endif>
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" disabled type="radio" name="is_featured" value="0" @if(!@$product_category->is_featured) checked="" @endif>
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label>Status <span class="required-label">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" disabled type="radio" name="status" value="1" @if(@$product_category->status) checked="" @endif>
                                            <span class="form-radio-sign">Active</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" disabled type="radio" name="status" value="0" @if(!@$product_category->status) checked="" @endif>
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
                                                    {{--<i class="fa fa-camera upload-button"></i>--}}
                                                    <input name="icon" id="file-upload" class="file-upload" type="file" accept=".jpeg, .jpg, .png"/>
                                                    @if ($errors->has('icon'))
                                                        <span class="help-block text-danger image-val choose-image">
                                                            <strong>{{ $errors->first('icon') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top: 150px">
                                        <a href="{{ route('edit-pro-category', $product_category->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('pro-category') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection