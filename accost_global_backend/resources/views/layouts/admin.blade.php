<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Accost Global</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="https://via.placeholder.com/32x32" type="image/x-icon"/>
    <script src="{{ asset('admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('admin/css/fonts.min.css') }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('admin/css/bootstraptree.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-treeview.css') }}">
    @yield('style')
</head>
<body>
<div class="ajax-loader" id="ajax-loader" style="display: none;">
    <img src="{{ url('/admin/img/small_loader.gif') }}" class="img-responsive"/>
</div>
<div class="wrapper">
    @include('layouts.admin-header')
    <!-- Sidebar -->
    @include('layouts.admin-sidebar-menu')
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);">
                                Accost Global
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);">
                                Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('admin/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/js/atlantis.min.js') }}"></script>
<script src="{{ asset('admin/js/dropzone.js') }}"></script>
<script src="{{ asset('admin/js/plugin/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.alert-success').delay(3000).fadeOut('slow');
    $('.alert-warning').delay(3000).fadeOut('slow');
    $('.alert-danger').delay(3000).fadeOut('slow');
    $(document).ready(function(){
        @foreach($arr_navigation as $item)
            $('#{{$item}}').click();
        @endforeach
    });
    /*notification js*/
    $(document).on('click', '.all_msg_notification', function(event) {
        var sender_id=$(this).attr('sender_id');
        var product_id=$(this).attr('product_id');
        var url=$('#is_read_btn').attr('href');
        $.ajax({
          url: url,
        })
        .done(function() {
            let new_url="{{ url('admin/messages/conversation')}}";
            window.location.href=new_url+'/'+sender_id+'/'+product_id;
        })
    });
    /*automation notification*/
    setInterval(function(){
        notification();
    }, 3000);
    function notification() {
        $.ajax({
            url: "{{route('notification_automation')}}",
            type: 'GET',
        })
        .done(function(res) {
            $('.notification_count').text('');
            $('.notification_count').text(res.auto_msg_notification_count);
            if(res.auto_msg_notification){
            var html='';
            html+='<div class="notif-center header_notification_html">';
                $('.header_notification_html').empty();
                $.each(res.auto_msg_notification, function(index, val) {
                    var user_name=val.user.user_profile.first_name;
                    user_name=user_name.charAt(0).toUpperCase() + user_name.slice(1);
                    html+='    <a href="javascript:void(0)"  class="all_msg_notification" sender_id="'+val.sender_id+'" product_id="'+val.product_id+'">';
                    html+='<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>';
                    html+='     <div class="notif-content">';
                    html+='       <span class="block">';
                    html+=  'You have received a message from '+ user_name +'.';
                    html+='       </span>';
                    if((val.title !== null) && (val.title !='')){
                        html+='       <span class="block"><b>';
                        html+=        'Title :'+val.title;
                        html+='       </b></span>';
                    }
                    html+='<span class="time">';
                    html+= val.diffForHumans+'</span>';
                    html+='</div>';
                    var url="{{url('admin/toggle-status/Message/is_read')}}";
                    html+='<a id="is_read_btn" href="'+url+'/'+val.id+'"></a>';
                });
                html+='</div>';
                $('.header_notification_html').append(html);
            }
        })
    }
</script>
@yield('script')
</body>
</html>
