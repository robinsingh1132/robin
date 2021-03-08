@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Faqs</h4>
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
                        <a href="javascript:void(0);">Faqs</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Faq List
                                <span class="float-right"><a href="{{ route('add-faq-pages') }}" class="text-info" data-toggle="tooltip" title="Add New"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-tax-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
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
            $('#dt-tax-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('data-faq-pages') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'question', name: 'question' },
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order":[['1','desc']]
            });
        });
    </script>
@endsection