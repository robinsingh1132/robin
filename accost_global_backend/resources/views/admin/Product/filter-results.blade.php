@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Products</h4>
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
                        <a href="javascript:void(0);">Products</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-list-alt text-success"></i> Products Filters
                                <span class="float-right"><a href="{{ route('new-product') }}" class="text-info" data-toggle="tooltip" title="Add New Product"><i class="fas fa-plus-circle"></i></a></span>
                                 <span class="float-right  mr-3"><a href="{{ route('trash') }}" class="text-info" data-toggle="tooltip" title="trash"><i class="fas fa-trash-alt"></i></a></span>
                                <span class="float-right mr-3"><span class="text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#filterProduct" title="Filter Products Category wise"><i class="fas fa-filter"></i></span></span>
                            </div>
                        </div>
                        <div class="card-title"><small class="ml-3"> {{ @$superCategoryName->name }} &nbsp @if(@$categoryName->name)>>@endif &nbsp</small> <small class="mr-2"> {{ @$categoryName->name }} &nbsp @if(@$subCategoryName->name)>>@endif </small><small class="mr-2"> {{ @$subCategoryName->name }} </small>
                            <span><a href="{{ route('product-list') }}" class="text-danger" data-toggle="tooltip" title="Clear Filters"><i class="fas fa-times"></i></a></span>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-product-list" class="display table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>SKU</th>
                                                <th>Sub Category</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.Product.filter-popup')
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        // domain.com?q=value&w=value&r=value
        $(function() {
            $('#dt-product-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('filter-results') !!}?<?php if(isset($_GET['product_super_category'])){echo 'product_super_category='.$_GET['product_super_category'];} ?> &<?php if(isset($_GET['product_category'])){echo 'product_category='.$_GET['product_category'];} ?> &<?php if(isset($_GET['product_sub_category'])){echo 'product_sub_category='.$_GET['product_sub_category'];} ?>',
                columnDefs: [
                    { width: '130px', targets:5 }
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
//                    { "name": "product_image.image", "data": "product_image.image", "render": function (data, type, full, meta) {
//                            return "<img src=\"" + env('APP_URL') + '/images/'+ data + "\" height=\"30\" width=\"30\"/>";
//                            }, "title": "Image", "orderable": false, "searchable": false
//                    },
                    { data: 'image', name: 'image' , "orderable": false, "searchable": false },
                    { data: 'name', name: 'name' },
                    { data: 'sku', name: 'sku' },
                    { data: 'subCategory', name: 'subCategory' },
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }, orderable: false, searchable: false},
                    { data: 'is_featured', name: 'is_featured',render: function ( data, type, full, meta ) {
                        return data ? "Yes" : "No" ;
                    }, orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
    <script src="{{ asset('admin/js/pages/product/list.js') }}"></script>
@endsection
