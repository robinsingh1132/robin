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
                        <a href="javascript:void(0);">Edit Home Banner</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-edit text-success"></i> Edit Home Banner
                                <span class="float-right"><a href="{{ route('list-home-banner') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <form id="frm-edit-home-banner" method="POST" action="{{ route('edit-home-banner',$home_banner->id) }}" enctype="multipart/form-data">
                                        @include('admin.HomeBanner.form')
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update</button>
                                            <a href="{{ route('list-home-banner') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
                                        </div>
                                    </form>
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
@section('script')
    @include('admin.HomeBanner.form-validate')
@endsection