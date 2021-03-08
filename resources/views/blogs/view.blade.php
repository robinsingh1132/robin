@extends('layouts.admin')

@section('content')

<section class="middle-section">
    <div class="container">
    <div class="row">
    <div class="col"></div>
    <div class=""><a href="{{route('blog-list')}}" class="btn btn-primary mr-3 mb-2">Blog List</a></div>
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
                                            <td class="contact--id">{{ $blogs->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Title</th>
                                            <td class="contact--name">
                                                {{ $blogs->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Description</th>
                                            <td class="contact--id">{{ $blogs->description }} </td>
                                        </tr>
                                        <tr>
                                            <th class="py-2" scope="col">Publish On</th>
                                            <td class="contact--no"><span>{{ $blogs->publication_date }}</span> <a
                                                    href=""><img src="images/ic_call.svg"></a></td>
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