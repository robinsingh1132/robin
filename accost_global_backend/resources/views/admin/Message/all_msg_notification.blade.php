@extends('layouts.admin')
@section('style')
    <style>
        .notif-center .form-control  {
            box-shadow: 1px 3px 10px rgba(0,0,0,.08);
        }

    </style>
@endsection
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
                            <div class="animated fadeIn all_msg_html" style="list-style: none">
                                <ul class="notif-center pl-0">
                                    @foreach($msg_notification_all as $notification)
                                    @if($notification->is_read==1)
                                    <li class="form-control" style="margin-top: 5px">
                                        <div class="notif-content">
                                            <a href="javascript:void(0)"  class="msg_notification" sender_id="{{$notification->sender_id}}" product_id="{{$notification->product_id}}" msg_id="{{$notification->id}}" style="text-decoration: none;">
                                            <span>
                                            You have received a message from {{ucfirst($notification->user->user_profile->first_name)}}.
                                            </span><br>
                                            </a>
                                            @if(!empty($notification->title))
                                            <b>Title: {{$notification->title}}</b><br>
                                            @endif<!-- <a href="{{route('toggle-status',['model'=>'Message',
                                                'column'=>'is_read','id'=>$notification->id,'msg'=>'Notification delete successfully.','redirect_page'=>'messages-notification'])}}" onclick="return confirm('Are you sure to delete this notification?')"><i class="icon-close" style="margin-left: 98%;"></i></a>-->
                                            <span class="time"> {{$notification->created_at->timezone(env('DISPLAY_TIMEZONE'))->format('d/m/Y h:i A')}}</span>
                                        </div>
                                    </li>
                                    @else
                                    <li class="form-control" style="margin-top: 5px;border-color: grey;">

                                        <div class="notif-content">
                                            <a href="javascript:void(0)"  class="msg_notification" sender_id="{{$notification->sender_id}}" product_id="{{$notification->product_id}}" msg_id="{{$notification->id}}" style="text-decoration: none;">
                                            <span>
                                             You have received a message from {{ucfirst($notification->user->user_profile->first_name)}}.
                                            </span><br>
                                            </a>
                                            @if(!empty($notification->title))
                                            <b>Title: {{$notification->title}}</b><br>
                                            @endif<!-- <a href="{{route('toggle-status',['model'=>'Message',
                                                'column'=>'is_read','id'=>$notification->id,'msg'=>'Notification delete successfully.','redirect_page'=>'messages-notification'])}}" onclick="return confirm('Are you sure to delete this notification?')"><i class="icon-close" style="margin-left: 98%;"></i></a> -->
                                            <span class="time">
                                            {{$notification->created_at->timezone(env('DISPLAY_TIMEZONE'))->format('d/m/Y h:i A')}}</span>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @else
                                <p style="text-align: center;">No Notifications Found. </p>
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
    <script >
        $(document).on('click', '.msg_notification', function(event) {
            var msg_id=$(this).attr('msg_id');
            var sender_id=$(this).attr('sender_id');
            var product_id=$(this).attr('product_id');
            $.ajax({
                url: '{{route('notification-status')}}',
                type: 'post',
                data: {"msg_id": msg_id,"sender_id": sender_id,"product_id":product_id,"_token": "{{ csrf_token() }}"},
            })
            .done(function(res) {
                //console.log(res.url);
                window.location.href = res.url;
            })

        });
        
    </script>
@endsection
