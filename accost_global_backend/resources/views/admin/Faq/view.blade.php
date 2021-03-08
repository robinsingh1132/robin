@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Faqs</h4>
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
                        <a href="javascript:void(0);">View FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">View FAQ</div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="frm-faq-question" method="POST" action="{{ route('post-edit-view-faq-pages',[$faq->id]) }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $faq->id }}">
                                        <div class="form-group form-show-validation">
                                            <label for="question" class="">Question <span class="required-label">*</span></label>
                                            <input readonly type="text" class="form-control" id="question" value="{{ $faq->question }}" name="question" placeholder="Enter question" autofocus>
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="answer" class="">Answer <span class="required-label">*</span></label>
                                            <textarea readonly name="answer" id="answer" cols="30" rows="6" class="form-control">{{ $faq->answer }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('edit-view-faq-pages', $faq->id) }}" class="btn btn-primary text-white"><span class="btn-label"><i class="fas fa-edit"></i></span> Edit</a>
                                            <a href="{{ route('list-faq-pages') }}" class="btn btn-danger text-white"><span class="btn-label"><i class="fas fa-list"></i></span> Back to List</a>
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
@endsection