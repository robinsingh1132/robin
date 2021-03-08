@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Orders List</h4>
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
                        <a href="javascript:void(0);">Orders List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Orders List                                
                                <label class="btn btn-file btn-warning mr-5 float-right">
                                    <i class="fa fa-download"></i>
                                    <a class="text-white" href="{{ route('export-order') }}"> Export Orders </a>
                                </label>
                                <!-- <label class="btn btn-file btn-warning mr-5 float-right">
                                    <i class="fas fa-eye"></i>
                                    <a class="text-white" href="{{ route('canceld-orders') }}"> Canceld Orders </a>
                                </label> -->
                            </div>
                        </div>
                        <div class="card-body">
                        @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-order-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Id</th>
                                                <th>Order Date</th>
                                                <th>Invoice Id</th>
                                                <th>Amount</th>
                                                <th>Shipping Date</th>
                                                <th>Status</th>
                                                <th>Order details</th>
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
            $('#dt-order-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('order-data') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id'},                    
                    { data: 'order_date', name: 'order_date' },
                    { data: 'invoice_id', name: 'invoice_id'},
                    { data: 'total_amount', name: 'total_amount'},
                    { data: 'shipped_date', name: 'shipped_date' },
                    { data: 'status', name: 'status', render: function( data){
                        if(data == 0){
                            return "Reject";
                        }if(data == 1){
                            return "Approved";
                        }if(data == 2){
                            return "Pending";
                        }
                    } },
                    {data: 'order_details', name: 'order_details', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable:false}
                ],
                "order":[['1','desc']]
            });
        });
    </script>
@endsection