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
                        <a href="javascript:void(0);">Static Pages List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-list-alt text-success"></i> Static Pages List</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-manage-pages" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Page Title</th>
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
            $('#dt-manage-pages').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [
                    { width: '50px', targets: 4 }
                ],
                ajax: '{!! route('static-pages-data') !!}',
                columns: [
                    { data: 'id', name: 'id',"visible":false },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    {data: 'page_title', name: 'page_title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection