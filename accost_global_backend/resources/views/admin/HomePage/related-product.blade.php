<div class="card col-md-12">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-edit text-success"></i> Check products below to add to related products.
            </div>
        </div>
        <div class="card-body">
            @include('flash::message')
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table id="dt-product-list" class="display table table-striped table-hover table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)

                            <tr>
                                <td><input type="checkbox" class="rel_product" name="related_product_id"
                                           value="{{$product->id}}"></td>
                                <td>{{$product->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
