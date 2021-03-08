@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Product Stocks</h4>
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
                        <a href="javascript:void(0);">Add Product Stocks</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-plus-circle text-success"></i> Add Product Stocks
                                <span class="float-right">
                                    <a href="{{ url('admin/catalog/product/stocks') }}" class="btn btn-info btn-xs text-white" data-toggle="tooltip" title="Product List"><i class="fas fa-list-alt"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    @if($sizes->count())
                                    <form id="stock-validate" method="POST" action="{{ url('admin/catalog/product/stocks-view/'.$product->id) }}">
                                        @csrf
                                        @foreach($sizes as $size)
                                            <div class="form-group form-show-validation">
                                                <label>{{ $size->size }}<span class="required-label">*</span></label>
                                                <input type="number" required class="form-control" min="1" maxlength="9" value="@if(isset($size->productStock->stock)){{ $size->productStock->stock }}@endif" name="{{ $size->id }}" placeholder="Stock of {{ $size->size }}"  autocomplete="off">
                                            </div>
                                        @endforeach
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><span class="btn-label"><i class="fas fa-save"></i></span> Update</button>
                                            <a href="{{ url('/admin/catalog/product/stocks') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List </a>
                                        </div>
                                    </form>
                                    @else
                                    <h5>There are no sizes defined for this product. To add sizes, click <a class="text-primary" href="{{ url('admin/catalog/product/edit/'.$product->id) }}">here</a> </h5>
                                    @endif
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
    <script>
        $("#stock-validate").validate();
    </script>
@endsection