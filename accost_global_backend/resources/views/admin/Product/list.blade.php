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
                            <div class="card-title"><i class="fas fa-list-alt text-success"></i> Products List
                                <span class="float-right  mr-3"><a href="{{ route('new-product') }}" class="text-info" data-toggle="tooltip" title="Add New Product"><i class="fas fa-plus-circle"></i></a></span>
                                <span class="float-right  mr-3"><a href="{{ route('trash') }}" class="text-info" data-toggle="tooltip" title="trash"><i class="fas fa-trash-alt"></i></a></span>
                                <span class="float-right mr-3"><span class="text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#filterProduct" title="Filter Products Category wise"><i class="fas fa-filter"></i></span></span>


                            </div>
                            <form id="delSelectedForm" method="POST" action="{{route('delete-selected-product')}}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="selectedProduct[]" id="selectedProduct">
                            </form>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">                               

                                <div class="col-md-12">

                                <!-- <span class=""><a href="javascript:void(0)" id="delSelected" class="text-info" data-toggle="tooltip" title="Delete Selected Products" style="position: relative;left:190px;top:36px;width:100px;display:none"><i class="fas fa-minus-circle"></i></a></span> -->
                                    <span class="btnrequired-label" title="Delete Selected Products"><a href="javascript:void(0)" id="delSelected" class="btn btn-danger text-white" style="position: relative;left:190px;top:36px;width:100px;z-index: 999;display:none"><i class="fas fa-trash"></i> Delete 
                                    </a> </span>
                                    <div class="table-responsive">
                                        <table id="dt-product-list" class="display table table-striped table-hover
                                        table-sm">
                                            <thead>
                                            <tr>
                                                <th style="min-width: 100px"><input type="checkbox" class="all_prd">&nbsp &nbsp Check All</th>
                                                <th>Sr.No. </th>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>SKU</th>
                                                <th>Sub Category</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>URL</th>
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
</div>

@include('admin.Product.filter-popup')
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            $('#dt-product-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('product-data') !!}',
                columnDefs: [
                    { width: '130px', targets: 4 }
                ],
                columns: [
                    { data: 'prpductCheckbox', name: 'prpductCheckbox', "orderable": false, "searchable": false } ,
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', "orderable": false, "searchable": false},
                    { data: 'id', name: 'id' ,"visible":false},
                    { data: 'image', name: 'image', "orderable": false, "searchable": false },
                    { data: 'name', name: 'name' },
                    { data: 'sku', name: 'sku' },
                    { data: 'subCategory', name: 'subCategory', "orderable": false },
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }, "orderable": false, "searchable": false},
                    { data: 'is_featured', name: 'is_featured',render: function ( data, type, full, meta ) {
                        return data ? "Yes" : "No" ;
                    }, orderable: false, searchable: false},
                    { data: 'url', name: 'url',render: function ( data, type, full, meta ) {
                        if(data == null){
                            return '';
                        }
                        data = '<a target="_blank" href="{{ env('FRONTEND_URL') }}product-detail/' + data + '">{{ env('FRONTEND_URL') }}' + data + '</a>';
                        return data;
                    }, orderable: false, searchable: false},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}

                ],
                "order": [[ 2, 'desc' ]]
                 
            });
            $('.all_prd').click(function(event) {
               if($('input.all_prd').is(':checked')) {
                $('#delSelected').css("display", "block");
                $('.productCheck').prop('checked', 'checked');
               }else{
                $('#delSelected').css("display", "none");
                $('.productCheck').prop('checked', false);
               }
            });
            $('body').on('change', '.productCheck', function(event) {
                //alert();
                if($(this).is(':checked')){
                    $('#delSelected').css("display", "block"); 
                }else{
                    $('#delSelected').css("display", "none"); 
                }
               
            });
            $('body').on('click', '.paginate_button.page-item ', function(event) {
                event.preventDefault();
                if($(this).hasClass('active')){
                    return false;
                }else{
                    $('#delSelected').css("display", "none");
                    $('input.all_prd').prop('checked', false);

                }
            });
            /*$(document).on('click', '#delSelected', function(){ 
                 alert();
            });*/
            /*$('body').on('click', '#delSelected', function(event) {
                alert();
            });*/
            $('#delSelected').on('click',function(event) {
                //alert();
                if(!confirm('Are you sure to delete selected product.')){
                    return false;
                }                
                var productChecked =[];
                $(".productCheck:checked").each(function(){
                    productChecked.push($(this).val());
                });
                if(productChecked.length==0){
                    alert("you didn't selected any product.");
                    return false;
                }
                $.ajax({
                    url: "{{route('delete-selected-product')}}",
                    type: 'DELETE',
                    data: {productSelected: productChecked,"_token": "{{ csrf_token() }}"},
                })
                .done(function(res) {
                    location.reload();
                })
                .fail(function() {
                    alert("network error");
                })                                              

            });
        });
    </script>
    <script src="{{ asset('admin/js/pages/product/list.js') }}"></script>
@endsection
