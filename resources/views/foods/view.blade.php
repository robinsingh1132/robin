@extends('layouts.admin')

@section('content')

<section class="middle-section">
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class=""><a href="{{route('view-order')}}" class="btn btn-primary mr-3 mb-2">View Orders</a></div>
        </div>
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
                            <form action="{{route('order', $orders->id)}}" method='POST'>
                                @csrf
                                <div class="table-responsive">
                                    <table class="w-100 table-sm my-3 table-bordered table-light">
                                        <thead class="">
                                            <tr>
                                                <th class="p-2" scope="col">ID</th>
                                                <th class="py-2" scope="col">Price</th>
                                                <th class="py-2" scope="col">Quantity</th>
                                                <th class="py-2" scope="col">Total </th>

                                            </tr>
                                            <tr>

                                                <td class="contact--id">{{ $orders->id }}</td>
                                                <input type='hidden' name='f_id'
                                                        value='{{$id}}'>
                                                <td class="contact--name"><label name='price'
                                                        id='lbl_product_price'>{{@$orders->price}}</label>
                                                    <input type='hidden' name='hdn_product_price'
                                                        value='{{@$orders->price}}'>
                                                </td>
                                                <td class="contact--id"><input type='number' min="1" max="10"
                                                        name='quantity' id='txt_quantity' onchange='CalculatePrice()'>
                                                </td>

                                                <td class="contact--no"><label name='total_price'
                                                        id='lbl_total_price'></label><input type='hidden'
                                                        name='hdn_total_price' id='hdn_total_price'> <a href=""><img
                                                            src="images/ic_call.svg"></a></td>
                                            </tr>

                                        </thead>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary mr-3 mb-2">Add Order</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection