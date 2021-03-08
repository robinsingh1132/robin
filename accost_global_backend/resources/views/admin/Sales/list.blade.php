@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Sales</h4>
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
                        <a href="javascript:void(0);">Sales</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">                                
                                <i class="fas fa-list-alt text-success"></i> Sales                               
                                <label class="btn btn-file btn-warning mr-5 float-right">
                                    <i class="fa fa-download"></i>
                                    <a class="text-white" href="{{ route('export-sales') }}"> Export Sales </a>
                                </label>
                                <span class="float-right mr-3"><span class="text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#filterSales" title="Filter Sales"><i class="fas fa-filter"></i></span></span>
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
                                                <!-- <th>Product</th>
                                                <th>Category</th> -->
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
    @include('admin.Sales.filter-popup')
    @endsection
@section('script')
    @include('admin.Sales.form-validate')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            var t= $('#dt-order-list').DataTable({
                processing: true,
                serverSide: true,
                format: 'DD/MM/YYYY',
                ajax: '{!! route('sales-data') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id'},  
                    { data: 'order_date', name: 'order_date' },
                    { data: 'invoice_id', name: 'invoice_id'},
                   /* { data: 'product', name: 'product'},
                    { data: 'category', name: 'category'},*/
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
/*
        t.row.add( [
           { data: 'sum_total_amount', name: 'sum_total_amount' },
        ] ).draw( false );*/
    </script>
@endsection