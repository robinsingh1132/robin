@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"> Message Details</h4>
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
                        <a href="javascript:void(0);">View Message</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-edit text-success"></i> View Message
                                <span class="float-right"><a href="{{ route('list-messages') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name"> Title </label>
                                        <input type="text" class="form-control coupon_name" value="{{ @$message->title}}" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name"> Message </label>
                                        <input type="text" class="form-control coupon_name" value="{{ @$message->message}}" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name"> Product </label>
                                        <a href="{{route('view-product',@$message->product->id)}}" class="form-control">{{ @$message->product->name}}</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name"> Quantity </label>
                                        <input type="text" class="form-control coupon_name" value="{{ @$message->quantity}}" autocomplete="off" disabled>
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
