@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Taxes</h4>
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
                        <a href="javascript:void(0);">Product Type</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Product Type Details</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-show-validation">
                                        <label for="type">Product Type <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$productType->type ?? old('type') }}" name="type" placeholder="Enter Product Type"
                                               disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="default_tax">Default Tax (Percentage) <span class="required-label">*</span></label>
                                        <input type="number" class="form-control" value="{{ @$productType->default_tax ?? old('default_tax') }}" name="default_tax" placeholder="Enter Default Tax"
                                               disabled>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('edit-product-type', @$productType->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-product-type') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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