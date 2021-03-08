@extends('layouts.admin')

@section('content')

<section class="middle-section">
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class=""><a href="{{route('product-list')}}" class="btn btn-primary mr-3 mb-2">Product List</a></div>
        </div>
        <div class="row no-gutters-mbl">
            <div class="col-12">
                <div class="main-card">
                    <div class="card">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="w-100 table-sm my-3 table-bordered table-light">
                                    <thead class="">
                                        <tr>
                                            <th class="p-2" scope="col">ID</th>
                                            <td class="contact--id">{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Name</th>
                                            <td class="contact--name">
                                                {{ $product->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Slug</th>
                                            <td class="contact--name">
                                                {{ $product->slug }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Details</th>
                                            <td class="contact--name">
                                                {{ $product->details }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Price</th>
                                            <td class="contact--name">
                                                {{ $product->price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Description</th>
                                            <td class="contact--id">{{ $product->description }} </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection