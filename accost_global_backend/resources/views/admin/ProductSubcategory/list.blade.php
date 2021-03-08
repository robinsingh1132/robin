@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Product Subcategory</h4>
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
                        <a href="javascript:void(0);">Product Subcategory List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Product Subcategory List                                
                                <span class="btnrequired-label float-right" title="Add Highlight"><a href="{{ route('new-highlight') }}" class="btn btn-info btn-xs text-white"style="position:relative;left: 5px;" ><i class="fas fas fa-plus-circle"></i>&nbsp Highlight</a> </span>
                                <span class="float-right"><a href="{{ route('new-pro-subcat') }}" class="text-info" data-toggle="tooltip" title="Add New"><i class="fas fa-plus-circle"></i></a></span> &nbsp &nbsp
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-md-3">
                                <label for="filter_pcat">Filter: Product Category</label>
                                <select name="product_category" id="filter_pcat" class="form-control form-control-sm">
                                    <option value="  @if(!isset($_GET['product_category'])) selected @endif ">Choose Category</option>
                                    @foreach($product_categories as $category)
                                        <option value="{{ $category->id }}" @if(isset($_GET['product_category']) && $_GET['product_category'] == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{--<button class="bt btn-sm btn-info">Reset</button>--}}
                            </div>
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
        $(document).ready(function(){
            $('#filter_pcat').on('change', function(){
                if($(this).val()){
                    window.location = '{{ route('list-pro-subcat') }}?product_category='+$(this).val();
                }else{
                    window.location = '{{ route('list-pro-subcat') }}';
                }
            });
        });
        $(function() {
            $('#dt-product-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('pro-subcat-data') !!}?<?php if(isset($_GET['product_category'])){echo 'product_category='.$_GET['product_category'];} ?>',
                columnDefs: [
                    { "width": "120px", "targets": 7 }
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false},
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    {data: 'product_category.name', name: 'productCategory.name'},
                    {data: 'product_category.id', name: 'productCategory.id', visible: false},
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