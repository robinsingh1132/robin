@extends('layouts.admin')
@section('content')
@php 
    if($route_name=='sales-items-details'){
        $display_name='Sales Items Details';
        $sales_items=$sales_items_details;
    }elseif($route_name=='sales-address-details'){
        $display_name='Sales Address Details';
        $sales_adds=$sales_address_details;
    }elseif($route_name=='sales-payment-details'){
        $display_name='Sales Payment Details';
        $sales_payments=$sales_payment_details;
    }else{
        $display_name='Sales Shipping Details';
        $sales_shippings=$sales_shipping_details;
    }
    if(empty($sales_items))
        $sales_items='';
    if(empty($sales_adds))
        $sales_adds='';
    if(empty($sales_payments))
        $sales_payments='';
    if(empty($sales_shippings))
        $sales_shippings='';
    if(empty($address_type))
        $address_type='';
@endphp
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{$display_name}} </h4>
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
                        <a href="javascript:void(0);">{{$display_name}} </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="{{ route('list-sales') }}">
                                <i class="fas fa-arrow-circle-left text-success" title="back to list"></i>
                                 {{$display_name}} </a>                 
                                <label class="btn btn-file btn-warning mr-5 float-right">
                                    <i class="fa fa-download"></i>
                                    <a class="text-white" href="{{ route('export-sales') }}"> {{$display_name}} </a>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                        @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-order-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            @if(!empty($sales_items))
                                            <tr>
                                                <th>#</th>
                                                <th>Invoice Id</th>
                                                <th>Item Id</th>
                                                <th>Item Name</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sales_items as $item)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$item->invoice_id}}</td>
                                                <td>{{($item->product_id)}}</td>
                                                <td>{{$item->product->name}}</td>
                                                <td>{{$item->size}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->total_amount}}</td>
                                            </tr>
                                            @endforeach
                                            @elseif(!empty($sales_adds))
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th>Address Id</th>
                                                <th>Address</th>
                                                <th>Address Type</th>
                                                <th>City/District/Town</th>
                                                <th>State</th>
                                                <th>Landmark</th>
                                                <th>Contact Number</th>
                                                <th>Pincode</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sales_adds as $address)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$address->user->first_name}}</td>
                                                <td>{{$address->id}}</td>
                                                <td>{{$address->address}}</td>
                                                @php
                                                    if($address->address_type==0){
                                                        $address_type='home';
                                                    }else{
                                                        $address_type='office';
                                                    }
                                                @endphp
                                                <td>{{$address_type}}</td>
                                                <td>{{$address->city_district_town}}</td>
                                                <td>{{$address->state}}</td>
                                                <td>{{$address->landmark}}</td>
                                                <td>{{$address->contact_number}}</td>
                                                <td>{{$address->pincode}}</td>
                                            </tr>
                                            @endforeach 
                                            @elseif(!empty($sales_payments))
                                            <tr>
                                                <th>#</th>
                                                <th>Payment Id</th>
                                                <th>User Name</th>
                                                <th>Order Id</th>
                                                <th>Transaction Id</th>
                                                <th>Payment Mode</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                @if($sales->payment_mode=="cod")
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sales_payments as $payment)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$payment->id}}</td>
                                                <td>{{$payment->user->first_name}}</td>
                                                <td>{{$payment->order_id}}</td>
                                                <td>{{$payment->transaction_id}}</td>
                                                <td>{{$payment->payment_mode}}</td>
                                                <td>{{$payment->amount}}</td>
                                                @php
                                                    if($payment->payment_status==0){
                                                        $payment_status='cancel';
                                                    }elseif($payment->payment_status==1){
                                                        $payment_status='done';
                                                    }else{
                                                        $payment_status='pending';
                                                    }
                                                @endphp 
                                                <td>{{$payment_status}}</td>
                                               <!--  @if($sales->payment_mode=="cod")
                                                <td><a href="{{route('edit-payment-status',$order->id)}}" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a></td>
                                                @endif -->
                                            </tr>
                                            @endforeach
                                            @elseif(!empty($sales_shippings))
                                            <tr>
                                                <th>#</th>
                                                <th>Invoice Id</th>
                                                <th>Item Id</th>
                                                <th>Item Name</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>total_amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sales_shippings as $shipping)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$item->invoice_id}}</td>
                                                <td>{{$item->product_id}}</td>
                                                <td>{{$item->invoice_id}}</td>
                                                <td>{{$item->size}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->total_amount}}</td>
                                            </tr>
                                            @endforeach
                                            @endif
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
@endsection