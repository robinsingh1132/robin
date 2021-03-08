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
                        <a href="javascript:void(0);">Edit FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit FAQ</div>
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
                                            <input type="text" class="form-control" id="question" value="{{ $faq->question }}" name="question" placeholder="Enter question" autofocus>
                                        </div>
                                        <div class="form-group form-show-validation">
                                            <label for="answer" class="">Answer <span class="required-label">*</span></label>
                                            <textarea name="answer" id="answer" cols="30" rows="6" class="form-control">{{ $faq->answer }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Faq</button>
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
        $("#frm-faq-question").validate({
            validClass: "success",
            rules: {
                question: {
                    required: !0,
                    minlength: 8,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
                },
                answer: {
                    required: !0,
                    minlength: 8,
                    normalizer: function(value) {
                        return $.trim(value)
                    }
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