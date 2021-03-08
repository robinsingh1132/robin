@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Highlight</h4>
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
                        <a href="javascript:void(0);">View Highlight</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-eye text-success"></i> Highlight Details
                                <span class="float-right">
                                    <a href="{{ route('list-highlight') }}" class="btn btn-info btn-xs text-white" data-toggle="tooltip" title="Highlight List"><i class="fas fa-list-alt"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-show-validation">
                                        <label for="name">Highlight Label <span class="required-label">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$highlight->name ?? old('name') }}" name="name" placeholder="Highlight Label"autocomplete="off" disabled >
                                    </div>
                                    <div class="form-group form-show-validation">
                                        <label for="name">Highlight belongs to following Subcategories</label>
                                        @if(!empty($highlight_subcategories))
                                            <ul>
                                                @foreach($highlight_subcategories as $highlight_subcat)
                                                    <li>{{$highlight_subcat->productSubCategory->name}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">           
                                        <a href="{{ route('edit-highlight',$highlight->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                        <a href="{{ route('list-highlight') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List </a>
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
