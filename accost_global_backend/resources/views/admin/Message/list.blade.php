@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Messages List</h4>
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
                        <a href="javascript:void(0);">Messages List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Messages List
                                <span class="float-right mr-3"><span class="text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#filterMessage" title="Filter Messages"><i class="fas fa-filter"></i></span></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="js-message">
                            </div>
                            <div class="row">
                                <div class="col-md-12">            
                                    <div class="table-responsive">
                                        <table id="dt-message-list" class="display table-striped table-hover" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Sender</th> 
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>unit</th>
                                                <th>Title</th>
                                                <th>Message</th>
                                                <th>Date</th>
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
    @include('admin.Message.filter_popup')
@endsection
@section('script')
    @include('admin.Message.form_validate')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            $('#dt-message-list').DataTable({
                processing: true,
                serverSide: true,
                format: 'DD/MM/YYYY',
                ajax: '{!! route('messages-data') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id',visible: false,},
                    { data: 'sender', name: 'sender'},
                    /*{ 
                        "data": "weblink",
                        "render": function(data, type, row, meta){
                                data =data.split('@#@');
                                var url='{{url("/admin/catalog/product/view")}}'+'/'+data[1];
                                data = '<a href="'+url+'">'+ data[0] + '</a>';
                            return data;
                        }
                    },*/
                    { data: 'product', name: 'product'},
                    { data: 'quantity', name: 'quantity'},
                    { data: 'unit', name: 'unit'},
                    { data: 'title', name: 'title' },
                    { data: 'message', name: 'message'},                    
                    { data: 'diffForHumans', name: 'diffForHumans'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order":[['1','desc']]
            });
        });
    </script>
@endsection