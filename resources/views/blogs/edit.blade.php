@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-auto title--col">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">update Blog</li>
                    </ol>
                    <h2 class="title">Blogs </h2>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="middle-section">
    <div class="container">
        <div class="row no-gutters-mbl">
            <div class="col-12">
                <div class="card">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body">

                        <form class="p-3" id="frm-cnt" method="POST"
                            action="{{ route('update-blog', $blogs->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <input placeholder="Title" id="title" type="text"
                                            class="floating-input @error('title') is-invalid @enderror" name="title"
                                            value="{{ @$blogs->title }}" required autocomplete="title" autofocus>
                                        <label>Title</label>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <textarea placeholder="Description" id="description" type="text" rows="5"
                                            class="floating-input @error('description') is-invalid @enderror"
                                            name="description" value="{{ @$blogs->description }}"
                                            autocomplete="description" autofocus required>{{ @$blogs->description }}</textarea>
                                        <label>{{ __('Description') }}</label>

                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <input placeholder="Publish on" id="publication_date" type="text"
                                            class="floating-input @error('publication_date') is-invalid @enderror"
                                            name="publication_date" value="{{ @$blogs->publication_date }}"
                                            autocomplete="publication_date" autofocus required>
                                        <label>{{ __('Publish on') }}</label>

                                        @error('publication_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!---->
    </div>
</section>


@endsection