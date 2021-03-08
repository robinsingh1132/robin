@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Home Banner</h4>
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
                        <a href="javascript:void(0);">Home Banner Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Home Banner Details
                                <span class="float-right"><a href="{{ route('list-home-banner') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-show-validation">
                                        <label for="name">Name <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" value="{{ @$home_banner->name ?? old('name') }}" name="name" placeholder="Banner name">
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="image_alt">Image Alt <span class="required-label">*</span></label>
                                        <input disabled type="text" class="form-control" name="image_alt" value="{{ @$home_banner->image_alt ?? old('image_alt') }}" placeholder="Image alt">
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="url">Image Link</label>
                                        <input disabled type="text" class="form-control" name="url" value="{{ @$home_banner->url ?? old('url') }}" placeholder="Banner link url">
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="position">Banner Position </label>
                                        <input disabled type="text" class="form-control" name="position" value="{{ @$home_banner->position ?? old('position') }}" placeholder="Banner Position">
                                    </div>
                                    <div class="form-check">
                                        <label>Status <span class="required-label">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input disabled class="form-radio-input" type="radio" name="status" value="1" @if(@$home_banner->status) checked="" @endif>
                                            <span class="form-radio-sign">Active</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input disabled class="form-radio-input" type="radio" name="status" value="0" @if(!@$home_banner->status) checked="" @endif>
                                            <span class="form-radio-sign">Inactive</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('edit-home-banner', $home_banner->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-home-banner') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="w-25">
                                            <img width="100" height="100" src="{{ asset('/banner/'.$home_banner->image_link) }}" alt="{{ $home_banner->image_alt }}">
                                        </div>
                                        <div class="w-25">
                                            <img width="100" height="100" src="{{ asset('/banner/'.$home_banner->mobile_image_link) }}" alt="{{ $home_banner->image_alt }}">
                                        </div>
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