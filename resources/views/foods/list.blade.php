@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-auto title--col">
                <div>
                    <h2 class="title">Food Items</h2>
                </div>
                <form action="{{route('search-food')}}" method="get">
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
                    Import foods</a>

                <a href="{{route('create-food')}}" class="btn btn-primary mb-0">Create Food</a>
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
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($foods) > 0)
                                        @foreach ($foods->all() as $food)
                                        <tr class="text-center">
                                            <td class="contact--name"><a class="text-link"
                                                    href="">{{ @$food->name }}</a> </td>

                                            <td class="biz--name">&#8377 {{ @$food->price }}</td>

                                            <td class="lead--name">{{ @$food->description }}</td>

                                            <td class="lead--name"><img
                                                    src="{{ asset('uploads/images/' .@$food->image) }}" width="100px">
                                            </td>
                                            <td>
                                                <a class="btn btn-success m-0 p-2"
                                                    href="{{route('buy-food', $food->id)}}">Buy</a>

                                                <a class="btn btn-primary m-0 p-2" href="{{route('edit-food', $food->id)}}">Edit</a>
                                                
                                                <a class="btn btn-danger m-0 p-2"
                                                    onclick="return confirm('Are you sure you want to delete this?')"
                                                    href="{{route('delete-food', $food->id)}}">Delete</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mt-4"> Showing 1 to {{$foods->count()}} of {{$foods->total()}} entries</div>
                                <div>{{ $foods->links('vendor.pagination.custom') }}</div>
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