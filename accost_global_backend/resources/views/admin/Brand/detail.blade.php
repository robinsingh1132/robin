@extends('layouts.admin')
@section('content')
<div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Brand</h4>
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
                        <a href="javascript:void(0);">View Brand</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i>Brand Details
                                <span class="float-right"><a href="{{ route('list-brand') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                        @csrf
                                        <div class="form-group">
                                            <label for="pro_super_category">Product Super Category <span class="required-label">*</span></label>
                                            <select class="form-control" id="super_category_id" name="super_category_id" disabled="true">
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
                                            <input type="text" class="brand_name form-control" value="{{ @$brand->brand_name ?? old('brand_name') }}" name="brand_name" placeholder="Brand Name" disabled="true">
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="slug">Slug <span class="required-label">*</span></label>
                                            <input type="text" id="slug" class="form-control" name="slug" value="{{ @$brand->slug ?? old('slug') }}" placeholder="Brand Slug" disabled="true">
                                        </div>
                                        <div class="form-check">
                                            <label>Status <span class="required-label">*</span></label><br>
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="status" disabled="true" value="1" @if(@$brand->status) checked="" @endif>
                                                <span class="form-radio-sign">Active</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" disabled="true"  name="status" value="0" @if(!@$brand->status) checked="" @endif>
                                                <span class="form-radio-sign">Inactive</span>
                                            </label>
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="icon">Icon </label>
                                            <div class="col-lg-12">
                                                <!-- image upload section -->
                                                <div class="small-12 medium-2 large-2 columns">
                                                    <div class="circle">
                                                        <img class="img-upload" src="{{ @$brand->icon ? asset('/images/brand/'.@$brand->icon) : asset('admin/img/no-image.png') }}" height="100" width="50" disabled="true">
                                                    </div>
                                                    <div class="p-image form-group">
                                                        <i class="fa fa-camera upload-button"></i>
                                                        <input name="icon" id="file-upload" class="file-upload" disabled="true"  type="file" accept=".jpeg, .jpg, .png"/>
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
                                        <div class="form-group">
                                            <a href="{{route('edit-brand',$brand->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                            <a href="{{ route('list-brand') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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
@section('script')
    @include('admin.Brand.form-validate')
    <script src="{{ asset('admin/js/custom.js') }}"></script>
@endsection
