@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-auto title--col">
                <div>
                    <h2 class="title">View Product</h2>
                </div>
                <form action="" method="get">
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

                <a href="{{route('shopping-cart')}}" class="btn btn-primary mb-0">Cart</a>
            </div>

        </div>
    </div>
</section>

<section class="middle-section">
    <div class="container">
        <div class="row no-gutters-mbl">
            <div class="col-lg-9">
                <div class="card my-4" style="width: 16rem;">
                    <a href="" class="ml-4">
                    <img
                        src="{{ asset('uploads/images/' .$product->image) }}" class="card-img-top img-fluid w-50 ml-5 mt-4"
                        alt="Image Icon"></a>
                    <div class="card-body text-center">
                        <h3 class="card-title">{{ @$product->name }}</h3>

                        <h4>&#8377 {{ @$product->price }}</h4>

                        <p class="card-text">{{ @$product->description }}</p>

                        <form action="{{route('shopping-cart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button class="btn btn-primary">Add to Cart</button> 
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection