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
                        <a href="javascript:void(0);">Static Page Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Static Page Details
                                <span class="float-right"><a href="{{ route('list-pages') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name">Name <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$static_page->name }}" name="name" placeholder="Page Name" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="slug">Slug <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" name="slug" value="{{ @$static_page->slug }}" placeholder="Page Slug" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="page_title">Page Title <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" name="page_title" value="{{ @$static_page->page_title }}" placeholder="Page Title" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="description">Page Description</label>
                                        <textarea rows="5" type="text" class="form-control" id="description" name="description" disabled>{{ @$static_page->description }}</textarea>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords" value="{{ @$static_page->meta_keywords }}" placeholder="Keywords" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea rows="5" type="text" class="form-control" id="meta_description" name="meta_description" disabled>{{ @$static_page->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="page_content">Page Content</label>
                                        {!! @$static_page->page_content !!}
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('edit-static-pages', $static_page->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-pages') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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