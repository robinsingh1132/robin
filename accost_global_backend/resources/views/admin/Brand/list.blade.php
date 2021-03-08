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
                        <a href="javascript:void(0);">Brand List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Brand List
                                <span class="float-right"><a href="{{ route('add-brand') }}" class="text-info" title="Add New Brand"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-brand-list" class="display table table-striped table-hover table-sm" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>   
                                                <th>Name</th>
                                                <th>Super Category id</th>
                                                <th>Super Category Name</th>
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
            $('#dt-brand-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('brand-data') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false},
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'super_category_id', name: 'superCategory.id',"visible":false},
                    {data: 'super_category.name', name: 'superCategory.name'},
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order":[['1','desc']]
            });
        });
    </script>
@endsection