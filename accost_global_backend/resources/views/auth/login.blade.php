
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login : Accost Global</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="https://via.placeholder.com/32x32" type="image/x-icon"/>

    <!-- Fonts and icons -->
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

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>
<body class="login">
<div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">
        <h3 class="text-center">Sign In To Admin</h3>
        <form id="frm-login" class="login-form" method="POST" action="{{ url('/login') }}">
            @csrf
            @if($errors->any())
                @foreach($errors->getMessages() as $this_error)
                    <p class="text-center text-danger">{{$this_error[0]}}</p>
                @endforeach
            @endif
            @if(!empty(session('status')))
                <p class="text-center text-success">{{session('status')}}</p>
            @endif
            <div class="form-group">
                <label for="email" class="placeholder"><b>Email</b></label>
                <input id="email" name="email" type="email" class="form-control" required autocomplete="email" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="placeholder"><b>Password</b></label>
                <a href="{{ url('/password/reset') }}" class="link float-right">Forgot Password ?</a>
                <div class="position-relative">
                    <input id="password" name="password" type="password" class="form-control" required>
                    <div class="show-password">
                        <i class="icon-eye"></i>
                    </div>
                </div>
            </div>
            <div class="form-group form-action-d-flex mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme">
                    <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('admin/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/atlantis.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>
<script>
    $("#frm-login").validate({
        validClass: "success",
        rules: {
            email: {
                required: !0,
                email : true,
                validEmailCheck: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            password: {
                required: !0,
                minlength: 2,
                normalizer: function(value) {
                    return $.trim(value)
                }
            }
        },
        messages: {
            email: {
                required: 'Please enter email.'
            },
            password: {
                required: 'Please enter your password.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });

    $.validator.addMethod("validEmailCheck", function (value, element) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        if (value !== '') {
            return pattern.test(value);
        }
        return true;
    }, 'Please enter a valid email address.');
</script>
</body>
</html>