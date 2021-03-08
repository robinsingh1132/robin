@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-auto title--col">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                    <h2 class="title">Update Product</h2>
                </div>
            </div>
            <div class=""><a href="{{route('product-list')}}" class="btn btn-primary mb-0">Products
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
                        <form class="p-3" id="create_product" method="POST" action="{{route('update-product', $products->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12 mb-lg-4">
                                    <div class="floating-label">
                                        <input placeholder="Name" id="name" type="text"
                                            class="floating-input @error('name') is-invalid @enderror" name="name"
                                            value="{{ @$products->name }}" required autocomplete="name" autofocus>
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
                                        <input placeholder="Slug" id="slug" type="text"
                                            class="floating-input @error('slug') is-invalid @enderror" name="slug"
                                            value="{{ @$products->slug }}" required autocomplete="slug" autofocus>
                                        <label>Slug</label>

                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-lg-5">
                                    <div class="floating-label">
                                        <input placeholder="Details" id="details" type="text"
                                            class="floating-input @error('details') is-invalid @enderror" name="details"
                                            value="{{ @$products->details }}" required autocomplete="details" autofocus>
                                        <label>Details</label>

                                        @error('details')
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
                                            value="{{ @$products->price }}" required autocomplete="price" autofocus>
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
                                            name="description" value="{{ @$products->description }}"
                                            autocomplete="description" autofocus required>{{ @$products->description }}</textarea>
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
                                            name="image" value="{{ @$products->image }}"
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
                                    <button type="submit" class="btn btn-primary">{{ __('Update Product') }}</button>
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