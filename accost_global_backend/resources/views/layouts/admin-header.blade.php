<?php
    if(empty($count)){
        $count='';
    }
?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="{{ route('admin-dashboard') }}" class="logo text-white">
            {{--<img src="https://via.placeholder.com/108x35" alt="navbar brand" class="navbar-brand">--}}
            Accost Global
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon">
				<i class="icon-menu"></i>
			</span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <div class="collapse" id="search-nav">
                <form class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret submenu">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if($msg_notification_count1>0)
                        <span class="notification notification_count">{{$msg_notification_count1}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        @if(count($msg_notification1)>0)
                        <li>
                            <div class="dropdown-title">You have <span class="notification_count"> {{$msg_notification_count1}} </span> new notifications.<!-- &nbsp| <span><a href="{{route('clear-all')}}">Clear All</a></span> --></div>
                        </li>
                        <li>
                            <div class="notif-center header_notification_html">
                                @foreach($msg_notification1->slice(0, 5) as $notification) <!--  slice the data count 5 -->
                                <a href="javascript:void(0)"  class="all_msg_notification" sender_id="{{$notification->sender_id}}" product_id="{{$notification->product_id}}">
                                    <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                        You have received a message from {{ucfirst($notification->user->user_profile->first_name)}}.
                                        </span>
                                        @if(!empty($notification->title))
                                        <span class="block">
                                            <b>Title:  {{$notification->title}}</b>
                                        </span>
                                        @endif
                                        <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                    </div>
                                </a>
                                <a id="is_read_btn" href="{{route('toggle-status',['model'=>'Message','column'=>'is_read','id'=>$notification->id])}}" ></a>
                                @endforeach                     
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="{{route('messages-notification')}}">See all notifications<i class="fa fa-angle-right"></i> </a>
                        </li>
                        @else
                            <p style="text-align: center;padding-top: 13px">No Notifications Found. </p>
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm" style="color: #fff!important">
                            <i class="fa fa-user fa-2x text"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><i class="fa fa-user-astronaut fa-3x text-primary"></i></div>
                                    <div class="u-text">
                                        <h4>Admin</h4>
                                        <p class="text-muted">{{ \Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>                            
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('edit-admin-profile') }}">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin-settings') }}">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <span class="link-collapse text-danger">Logout</span>
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

