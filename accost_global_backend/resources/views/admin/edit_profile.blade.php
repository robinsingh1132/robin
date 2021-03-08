@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Profile</h4>
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
                        <a href="javascript:void(0);">Profile</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Profile</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="frm-edit-profile" method="POST" action="{{ route('update-admin-profile') }}">
                                        @csrf
                                        <div class="form-group form-show-validation">
                                            <label for="first_name" class="">First Name <span class="required-label">*</span></label>
                                            <input type="text" class="form-control"name="first_name" placeholder="First Name" value="{{$user_profile->first_name}}" autocomplete="off">
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">last Name <span class="required-label">*</span></label>
                                            <input type="text" class="form-control"name="last_name" placeholder="Last Name" value="{{$user_profile->last_name}}" autocomplete="off">
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">Contact Number<span class="required-label">*</span></label>
                                            <input type="text" class="form-control"name="contact_number" placeholder="Contact Number" value="{{$user_profile->contact_number}}" autocomplete="off">
                                        </div>
                                        <!-- <div class="form-check">
                                            <label>Gender <span class="required-label">*</span></label><br>
                                            <label for="male"class="form-radio-label">
                                                <input class="form-radio-input" type="radio" id="male" name="gender" value="Male" @if(@$user_profile->gender=="Male") checked="true" @else  checked="" @endif>
                                                <span class="form-radio-sign">Male</span>
                                            </label>
                                            <label for="female" class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" id="female" name="gender" value="Female" @if(!@$user_profile->gender=="Female") checked="true" @else checked="" @endif>
                                                <span class="form-radio-sign">Female</span>
                                            </label>
                                        </div> -->
                                        <div class="form-group form-show-validation">
                                            <label for="name" class="">Gender<span class="required-label">*</span></label>
                                            <input type="text" class="form-control"name="gender" placeholder="Gender" value="{{$user_profile->gender}}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
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
        $("#frm-edit-profile").validate({
            validClass: "success",
            rules: {
                first_name: {
                    required: !0,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
                },
                last_name: {
                    required: !0,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
                },
                contact_number: {
                    required: !0,
                    minlength:10,
                    maxlength:15,
                },
                gender: {
                    required: !0,
                    minlength:4,
                    maxlength:6,
                }

            },
            messages: {
                first_name: {
                    required: 'Please enter First Name.'
                },
                last_name: {
                    required: 'Please enter Last Name.'
                },
                contact_number: {
                    required: 'Please enter Contact Number.',
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