@extends('layouts.admin')
@section('content')
@php
    if(empty($superCatArr)){
        $superCatArr='';
    }
    if(empty($coupon_id)){
        $coupon_id='';
    }
@endphp
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">New Coupon</h4>
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
                        <a href="javascript:void(0);">New Coupon</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-plus-circle text-success"></i> New Coupon
                                <span class="float-right">        
                                    <a href="{{ route('list-coupons') }}" class="btn btn-info btn-xs text-white" data-toggle="tooltip" title="List Coupon"><i class="fas fa-list-alt"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty($coupon))
                                    @endif
                                   @include('admin.DiscountCoupon.form')
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
    @include('admin.DiscountCoupon.form-validate')
    @include('admin.DiscountCoupon.js.discount_coupon_js')
    <script>
        $(document).ready(function($) {
            $('.startDate').val('');
            $('.endDate').val('');
        });
    </script>
@endsection
