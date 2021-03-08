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
                       {{-- {{dd($product)}}--}}
                        @if(!empty($allproducts))
                           {{-- {{ dd($allproducts) }}--}}
                            @foreach($allproducts as $single_product)
                                <?php $check = $curr_prod_rel_product_ids->where('related_product_id', $single_product->id)->count(); ?>
                                        <tr>
                                            <td>
                                               @if($check)

                                                <input type="checkbox" class="rel_product" name="related_product_id"
                                                       value="{{$single_product->id}}" checked>
                                                @else

                                                <input type="checkbox" class="rel_product" name="related_product_id"
                                                       value="{{$single_product->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                {{$single_product->name}}
                                            </td>
                                        </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>