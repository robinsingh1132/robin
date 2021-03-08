@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Pages</h4>
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
                        <a href="javascript:void(0);">Edit Static Page</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-edit text-success"></i> Edit Static Page
                                <span class="float-right"><a href="{{ route('list-pages') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="frm-static-page" method="POST" action="{{ route('update-static-pages',$static_page->id) }}">
                                        @include('admin.Pages.form')
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><span class="btn-label"><i class="fas fa-arrow-alt-circle-up"></i></span> Update</button>
                                            <a href="{{ route('list-pages') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
                                        </div>
                                    </form>
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace( 'page_content',{allowedContent: true} );</script>
    @include('admin.Pages.form-validate')
@endsection