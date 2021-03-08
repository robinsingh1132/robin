@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-auto title--col">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Blogs</li>
                    </ol>
                    <h2 class="title">Blogs</h2>
                </div>
            </div>
            <div class=""><a href="{{route('blog-list')}}" class="btn btn-primary mb-0">Blog
                    List</a></div>
        </div>
    </div>
</section>


<section class="middle-section">
    <div class="container">
        <div class="row no-gutters-mbl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        @if(session()->get('danger'))
                        <div class="alert alert-danger text-center">
                            {{ session()->get('danger') }}
                        </div>
                        @endif
                        <form class="p-3" id="create_blog" method="POST" action="{{route('save-blog')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <input placeholder="Title" id="title" type="text"
                                            class="floating-input @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title') }}" required autocomplete="title" autofocus>
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
                                            name="description" value="{{ old('description') }}"
                                            autocomplete="description" autofocus required></textarea>
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
                                            name="publication_date" value="{{ old('publication_date') }}"
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
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection