@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"> Message Notifications</h4>
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
                        <a href="javascript:void(0);">View Message Notifications</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fa fa-comment text-success"></i> View All Notifications
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            @if(count($msg_notification_all)>0)
                            <ul class="animated fadeIn all_msg_html" style="list-style: none">
                                <div class="notif-center">
                                    @foreach($msg_notification_all as $notification)
                                    <li class="form-control" style="margin-top 5 px">
                                        <a href="javascript:void(0)"  class="all_msg_notification" sender_id="{{$notification->sender_id}}" product_id="{{$notification->product_id}}" style="text-decoration: none;">
                                        <div class="notif-content">
                                            <span>
                                            {{$notification->user->user_profile->first_name}} commented on Admin
                                            </span><a href="{{route('toggle-status',['model'=>'Message',
                                                'column'=>'is_read','id'=>$notification->id,'msg'=>'Notification delete successfully.','redirect_page'=>'messages-notification'])}}" onclick="return confirm('Are you sure to delete this notification?')"><i class="icon-close" style="margin-left: 98%;"></i></a>
                                            <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                        </div>
                                        </a>
                                        <a id="is_read_btn" href="{{route('toggle-status',['model'=>'Message','column'=>'is_read','id'=>$notification->id])}}"></a>
                                    </li>
                                    @endforeach
                                </div>
                            </ul>
                            @else
                                <p style="text-align: center;">No Notification Found. </p>
                            @endif
                            <div class="row">
                                <div class="col-md-12" style="margin-left:27pc;">
                                    {!! $msg_notification_all->links() !!}
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
    @include('admin.Message.form_validate')
@endsection
