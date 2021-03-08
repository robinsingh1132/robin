@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Product Subcategory</h4>
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
                        <a href="javascript:void(0);">Product Subcategory Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Product Subcategory Details</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-show-validation">
                                        <label for="name">Product Category <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" value="{{ @$product_subcategory->productCategory->name }}" name="name" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="name">Name <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" value="{{ @$product_subcategory->name }}" name="name" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="slug">Slug <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" name="slug" value="{{ @$product_subcategory->slug }}" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="page_title">Page Title </label>
                                        <input disabled type="text" class="form-control" name="page_title" value="{{ @$product_subcategory->page_title }}" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="seo_keywords">Seo Keywords</label>
                                        <input disabled type="text" class="form-control" name="seo_keywords" value="{{ @$product_subcategory->seo_keywords }}" >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="seo_description">Seo Description</label>
                                        <textarea rows="5" disabled type="text" class="form-control" id="seo_description" name="seo_description">{{ @$product_subcategory->seo_description }}</textarea>
                                    </div>
                                    <div class="form-check" style="display: none">
                                        <label>Featured Subcategory <span class="required-label">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" disabled type="radio" name="is_featured" value="1" @if(@$product_subcategory->is_featured) checked="" @endif>
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" disabled type="radio" name="is_featured" value="0" @if(!@$product_subcategory->is_featured) checked="" @endif>
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label>Status <span class="required-label">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" disabled type="radio" name="status" value="1" @if(@$product_subcategory->status) checked="" @endif>
                                            <span class="form-radio-sign">Active</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" disabled type="radio" name="status" value="0" @if(!@$product_subcategory->status) checked="" @endif>
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
                                        <a href="{{ route('edit-pro-subcat', $product_subcategory->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-pro-subcat') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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