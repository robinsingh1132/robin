@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Settings</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Change Password</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="frm-change-pass" method="POST" action="{{ route('change-password') }}">
                                        @csrf
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">Current Password <span class="required-label">*</span></label>
                                            <input type="text" class="form-control" id="current" name="current" placeholder="Current Password" autofocus>
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">New Password <span class="required-label">*</span></label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="New Password">
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">Password Confirmation <span class="required-label">*</span></label>
                                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </div>
                                    </form>
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
        $("#frm-change-pass").validate({
            validClass: "success",
            rules: {
                current: {
                    required: !0,
                    minlength: 8,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
                },
                password: {
                    required: !0,
                    minlength: 8,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
                },
                password_confirmation: {
                    required: !0,
                    normalizer: function(value) {
                        return $.trim(value)
                    },
                    equalTo: "#password"
                }
            },
            messages: {
                current: {
                    required: 'Please enter current password.'
                },
                password: {
                    required: 'Please enter a new password.'
                },
                password_confirmation: {
                    required: 'Please enter new password.',
                    equalTo: 'New password and confirm password do not match.'
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            }
        });
    </script>
@endsection