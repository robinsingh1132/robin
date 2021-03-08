@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Discount & Promotion</h4>
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
                        <a href="javascript:void(0);">Coupon List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Coupon List
                                <span class="float-right"><a href="{{ route('new-coupons') }}" class="text-info" data-toggle="tooltip" title="Add New"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">            
                                    <div class="table-responsive">
                                        <table id="dt-coupon-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>        
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Available For</th>
                                                <th>Type</th>
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
            $('#dt-coupon-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('coupons-data') !!}',
                columnDefs: [
                    { "width": "120px", "targets": 5 }
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false},
                    { data: 'name', name: 'name' },
                    { data: 'coupon_code', name: 'coupon_code' },
                    { data: 'coupon_available_on', name: 'coupon_available_on', render: function( data){
                        if(data == 0){
                            return "All";
                        }if(data == 1){
                            return "Category";
                        }if(data == 2){
                            return "Product";
                        }
                    } },
                    { data: 'coupon_type', name: 'coupon_type', render: function( data){
                        return data ? "Percentage" : "Amount";
                    } },
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order":[['1','desc']]
            });
        });
        $(document).on('click', '.apply_coupon', function(event) {
            event.preventDefault();
            var route=$(this).attr('href');
            if(route ==''){
                alert('No need to apply this coupon for product or category.Its applicable for all products and categories.');
            }else{
                window.location.href=route;
            }
        });
    </script>
@endsection