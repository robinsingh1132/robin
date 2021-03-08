@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Dealer</h4>
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
                        <a href="javascript:void(0);">Dealer Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Dealer Details</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    @csrf
                                    <div class="form-group form-show-validation">
                                        <label for="first_name"> First Name <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$dealer->first_name ?? old('first_name') }}" name="first_name" placeholder="First Name"  autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="last_name"> Last Name <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$dealer->last_name ?? old('last_name') }}" name="last_name" placeholder="Last Name"  autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="email"> Email <span class="required-label">*</span></label>
                                        <input type="email" class="form-control" value="{{ @$dealer->email ?? old('email') }}" name="email" placeholder="Email"  autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="contact_number"> Contact Number<span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$dealer->contact_number?? old('contact_number') }}" name="contact_number" placeholder="Contact Number should be 10 to 15 digits only."  autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="address"> Address <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$dealer->address ?? old('address') }}" name="address" placeholder="Address"  autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{route('edit-dealer',$dealer->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-dealer') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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