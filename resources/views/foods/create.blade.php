@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-auto title--col">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Foods</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Foods</li>
                    </ol>
                    <h2 class="title">Foods</h2>
                </div>
            </div>
            <div class=""><a href="{{route('food-list')}}" class="btn btn-primary mb-0">Food
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
                        <form class="p-3" id="create_blog" method="POST" action="{{route('save-food')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-lg-4">
                                    <div class="floating-label">
                                        <input placeholder="Name" id="name" type="text"
                                            class="floating-input @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label>Name</label>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <input placeholder="Price" id="price" type="text"
                                            class="floating-input @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price') }}" required autocomplete="price" autofocus>
                                        <label>Price</label>

                                        @error('price')
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
                                        <input placeholder="Image Path" id="image" type="file"
                                            class="floating-input @error('image') is-invalid @enderror"
                                            name="image" value="{{ old('image') }}"
                                            autocomplete="image" autofocus required>
                                        <label>{{ __('Image Path') }}</label>

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Item') }}</button>
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