@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-auto title--col">
                <div>
                    <h2 class="title">Products</h2>
                </div>
                <form action="{{route('search-product')}}" method="get">
                    <div class="dropdown--search d-lg-none">
                        <a class="btn dropdown--search_btn" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <img src="{{ asset('images/search-icn.svg') }}">
                        </a>
                    </div>
            </div>
            <div class="col-xl-8 col-lg-9 ml-auto d-flex align-items-center title-elems">
                <input type="search" name="search" placeholder="Search Blog"
                    class="form-control d-none d-lg-block mr-1">
                </form>
                <a href="" class="btn text-link d-none d-lg-block"><img src="{{ asset('images/ic_plus-circle.svg') }}">
                    Import Products</a>

                <a href="{{route('create-product')}}" class="btn btn-primary mb-0">Create Products</a>
            </div>

        </div>
    </div>
</section>

<section class="middle-section">
    <div class="container">
        <div class="row no-gutters-mbl">
            <div class="col-12">
                <div class="main-card">
                    <div class="card">
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
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-lg table-striped contacts--table smart-table">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Product</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr class="text-center">
                                            <td><a href="{{route('show-product', $product->slug) }}">
                                                    <img src="{{ asset('uploads/images/' .$product->image) }}"
                                                        class="card-img-top w-100" alt="Image Icon"></a></td>
                                            <td>
                                                <a href="{{route('show-product', $product->slug) }}">{{ @$product->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <h5>&#8377 {{ @$product->price }}</h5>
                                            </td>
                                            <td>
                                                <p class="card-text">{{ @$product->description }}</p>
                                            </td>
                                            <td>
                                                <a class="btn btn-success m-0 p-2"
                                                    href="{{ route('view-product', $product->id) }}">View</a>

                                                <a class="btn btn-primary m-0 p-2"
                                                    href="{{ route('edit-product', $product->id) }}">Edit</a>

                                                <a class="btn btn-danger m-0 p-2"
                                                    onclick="return confirm('Are you sure you want to delete this?')"
                                                    href="{{ route('delete-product', $product->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mt-4"> Showing 1 to {{$products->count()}} of {{$products->total()}} entries
                                </div>
                                <div>{{ $products->links('vendor.pagination.custom') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection