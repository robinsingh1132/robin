@extends('layouts.admin')
@section('content')

<section class="page-title">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-auto title--col">
                <div>
                    <h2 class="title">Order List</h2>
                </div>
            </div>
            <div>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Food Item</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($orders) > 0)
                                        @foreach ($orders->all() as $order)
                                        <tr class="text-center">
                                            <td class="biz--name"><a class="text-link"
                                                    href=""> {{ @$order->id }}</a></td>
                                                 
                                            <td class="contact--name">{{ @$order->food->name }} </td>

                                            <td class="biz--name">&#8377 {{ @$order->price }}</td>

                                            <td class="lead--name">{{ @$order->quantity }}</td>

                                            <td class="lead--name">&#8377 {{ @$order->total }}
                                            </td>
                                             

                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mt-4"> Showing 1 to {{$orders->count()}} of {{$orders->total()}} entries
                                </div>
                                <div>{{ $orders->links('vendor.pagination.custom') }}</div>
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