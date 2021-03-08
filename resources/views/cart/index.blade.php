@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Cart</h1>

            @if (session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session()->get('success')}}
            </div>
            @endif

            @if (Cart::count() >0)

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <!-- <th scope="col" class="text-center">Total</th> -->
                            
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $item)

                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>{{ @$item->model->name }}</td>

                            <td>{{ @$item->model->description }}</td>

                            <td><label name='price' id='lbl_product_price'>
                            &#8377 {{ @$item->model->price }}</label>
                                <input type='hidden' name='hdn_product_price' value='{{@$item->model->price}}'>
                            </td>

                           <td><input type="number" min="1" max="10" class="form-control" name="quantity"
                                    id='txt_quantity' onchange='CalculatePrice()' /></td>
                            
                            <!-- <td class="text-center"><label name='total_price' id='lbl_total_price'></label>
                            <input type='hidden' name='hdn_total_price' id='hdn_total_price'></td> -->
                            <td class="text-right">
                                <div class="row justify-content-around">
                                    <div class="col">
                                        <form action="{{route('save-later-item', $item->rowId)}}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-save"></i></button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form action="{{route('delete-item', $item->rowId)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                       
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">&#8377 {{ Cart::subtotal() }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tax</td>
                            <td class="text-right">&#8377 {{ Cart::tax() }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>&#8377 {{ Cart::total() }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="{{route('product-list')}}" class="btn btn-block btn-light">Continue Shopping</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <a href="{{route('checkout')}}"
                            class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                    </div>
                </div>
            </div>
            @else
            <h3>No items in Cart!</h3>
            @endif
            <br><br>
            <h1>Save for Later</h1>

            @if (Cart::instance('saveForLater')->count() > 0)

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::instance('saveForLater')->content() as $item)

                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td>{{ @$item->model->name }}</td>
                            <td>{{ @$item->model->description }}</td>
                            <td><input class="form-control" type="text" value="1" /></td>
                            <td class="text-right">&#8377 {{ @$item->model->price }}</td>
                            <td class="text-right">
                                <div class="row justify-content-around">
                                    <div class="col">
                                        <form action="{{route('move-cart-item', $item->rowId)}}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i
                                                    class="fa fa-cart-arrow-down"></i></button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form action="{{route('delete-later-item', $item->rowId)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            @else
            <h3>You have no items Saved For Later!</h3>
            @endif
        </div>
    </div>
</div>

@endsection