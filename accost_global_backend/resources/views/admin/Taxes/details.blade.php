@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Taxes</h4>
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
                        <a href="javascript:void(0);">Taxes</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Tax Details</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-10">
                                                <div class="select2-input select2-warning">
                                                    <label for="product_type"> Product Type <span class="required-label">*</span></label>
                                                    <select id="prod-type" name="tax_product_type_id" class="form-control prodAttr" disabled>
                                                        <option value="">Select Product Type</option>
                                                        @if(@$productType)
                                                            @foreach(@$productType as $val)
                                                                @if($val->id == @$tax->tax_product_type_id)
                                                                    @php $selected = 'selected'; @endphp
                                                                @else
                                                                    @php $selected = '';    @endphp
                                                                @endif
                                                                <option {{$selected}} value="{{ $val->id }}">{{ $val->type }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-10">
                                                <div class="select2-input select2-warning">
                                                    <label for="country"> Country <span class="required-label">*</span></label>
                                                    <select id="tax-country" name="country" class="form-control prodAttr" disabled>
                                                        <option value="">Select Country</option>
                                                        @if(@$countries)
                                                            @foreach(@$countries as $val)
                                                                @if($val->id == @$tax->country_id)
                                                                    @php $selected = 'selected'; @endphp
                                                                @else
                                                                    @php $selected = '';    @endphp
                                                                @endif
                                                                <option {{$selected}} value="{{ $val->id }}">{{ $val->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-10">
                                                <div class="select2-input select2-warning">
                                                    <label for="state"> State <span class="required-label">*</span></label>
                                                    <select id="tax-state" name="state" class="form-control prodAttr" disabled>
                                                        <option value="">Select State</option>
                                                        @if(@$states)
                                                            @foreach(@$states as $val)
                                                                @if($val->id == @$tax->state_id)
                                                                    @php $selected = 'selected'; @endphp
                                                                @else
                                                                    @php $selected = '';    @endphp
                                                                @endif
                                                                <option {{$selected}} value="{{ $val->id }}">{{ $val->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="form-group form-show-validation">
                                        <label for="tax"> Tax (Percentage) <span class="required-label">*</span></label>
                                        <input type="number" class="form-control" value="{{ @$tax->tax ?? old('tax') }}" name="tax" placeholder="Enter tax" disabled autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('edit-taxes', $tax->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                <a href="{{ route('list-taxes') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection