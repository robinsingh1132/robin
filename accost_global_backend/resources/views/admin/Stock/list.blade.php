@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Product Stocks</h4>
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
                        <a href="javascript:void(0);">Product Stocks</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-list-alt text-success"></i> Products List
                                <span class="float-right  mr-3"><a href="{{ route('new-product') }}" class="text-info" data-toggle="tooltip" title="Add New Product"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-control" style="    margin-bottom: 20px;">
                                        <label>Representation of stock:</label>
                                        <span><i class="fas fa-arrow-alt-circle-down text-danger"></i> stock below then 500 units. </span>
                                        <span><i class="fas fa-dot-circle text-warning"></i> stock range between 501-1000 units. </span>
                                        <span><i class="fas fa-arrow-alt-circle-up text-success"></i> stock above then 1000 units. </span>
                                    </div>
                                    <div class="table-responsive">          
                                        <table id="dt-product-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <th>SKU</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($all_products as $product)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->sku }}</td>
                                                    <td>
                                                        @if(!empty($product->productStock))
                                                            @foreach($product->productStock as $stock)                         
                                                                @if(!empty($stock->size))
                                                                    @if($stock->stock <=$lowestStock)
                                                                        <a href="javascript:void(0)" title="{{$stock->size->size.':'.$stock->stock}}">
                                                                            <i class="fas fa-arrow-alt-circle-down text-danger" ></i>
                                                                        </a>
                                                                    @elseif(($stock->stock >$mediumStock))
                                                                        <a href="javascript:void(0)" title="{{$stock->size->size.':'.$stock->stock}}">
                                                                            <i class="fas fa-arrow-alt-circle-up text-success" ></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)" title="{{$stock->size->size.':'.$stock->stock}}">
                                                                            <i class="fas fa-dot-circle text-warning"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>@if($product->status == 1) Active @else Inactive @endif</td>
                                                    <td>
                                                        <a href="{{ url('admin/catalog/product/stocks-view/'.$product->id) }}">
                                                            <i class="fa fa-edit text-primary"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
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
@endsection
@section('script')
<script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#dt-product-list').DataTable({
            "columnDefs": [ {
                "targets": 'no-sort',
                "orderable": false,
            } ]
        });
    });
</script>
<script src="{{ asset('admin/js/pages/product/list.js') }}"></script>
@endsection
