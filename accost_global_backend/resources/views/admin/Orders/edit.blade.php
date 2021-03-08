@extends('layouts.admin')
@section('content')
@php
    if(empty($form))
        $form='';
    if(empty($display_name))
        $display_name='';
    if($route_name=='edit-payment-status'){
        $display_name='Edit Payment Status';
        $form="payment_form";
    }else{
        $display_name='edit Order Details';
        $form="form";
    }
@endphp
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$display_name}}</h4>
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
                        <a href="javascript:void(0);">{{$display_name}}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-edit text-success"></i> {{$display_name}}
                                <span class="float-right"><a href="{{ route('list-order') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    @include('admin.Orders.'.$form)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection