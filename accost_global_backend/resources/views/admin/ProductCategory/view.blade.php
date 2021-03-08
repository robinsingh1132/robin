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
                        <a href="javascript:void(0);">Product Category List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Product Category List
                                <span class="float-right"><a href="{{ route('get-new-pro-category') }}" class="text-info" title="Add New Category"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-product-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>   
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Category</th>
                                                <th>Category_id</th>
                                                <th>Seo Keywords</th>
                                                <th>Featured</th>
                                                <th>Status</th>
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
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            $('#dt-product-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('pro-category-data') !!}',
                columnDefs: [
                    { "targets": 8 }
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false},
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    {data: 'super_category.name', name: 'superCategory.name'},
                    {data: 'super_category.id', name: 'superCategory.id', visible: false},
                    { data: 'seo_keywords', name: 'seo_keywords' },
                    { data: 'is_featured', name: 'is_featured',render: function ( data, type, full, meta ) {
                        return data ? "Yes" : "No" ;
                    }},
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "active" : "Inactive" ;
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order": [[1, 'desc' ]]

            });
        });
    </script>
@endsection