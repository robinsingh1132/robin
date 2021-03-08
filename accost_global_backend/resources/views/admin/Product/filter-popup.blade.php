{{--Modal Product Filte start--}}
<div class="modal fade" id="filterProduct" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="filter-products" method="GET" action="{{ route('filter-products') }}">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Filter Products</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group form-show-validation">
                        <div class="select2-input select2-warning">
                            <select id="prod-sup-cat" name="product_super_category" class="form-control" data-action="{{ route('get-product-category') }}">
                                <option value="">Select Super Category</option>
                                @if(@$superCategories)
                                    @foreach(@$superCategories as $val)
                                        @if(@$product_super_cat && in_array($val->id, @$product_super_cat))
                                            @php $selected = 'selected'; @endphp
                                        @else
                                            @php $selected = '';    @endphp
                                        @endif
                                        <option {{$selected}} value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-show-validation">
                        <div class="select2-input select2-warning">
                            <select id="prod-cat" name="product_category" class="form-control" data-action="{{ route('get-product-subcategory') }}">
                                <option value="">Select Category</option>
                                @if(@$categories)
                                    @foreach(@$categories as $val)
                                        @if(@$product_cat && in_array($val->id, @$product_cat))
                                            @php $selected = 'selected'; @endphp
                                        @else
                                            @php $selected = '';    @endphp
                                        @endif
                                        <option {{$selected}} value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-show-validation">
                        <select id="prod-sub-cat" name="product_sub_category" class="form-control">
                            <option value="">Select Sub category</option>
                            @if(@$subCategories)
                                @foreach(@$subCategories as $val)
                                    @if(@$product_sub_cat && in_array($val->id, @$product_sub_cat))
                                        @php $selected = 'selected'; @endphp
                                    @else
                                        @php $selected = '';    @endphp
                                    @endif
                                    <option {{$selected}} value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fas fa-times"></i></span>Close</button>
                    <button type="submit" class="btn btn-xs btn-primary text-white" ><span class="btn-label"><i class="fas fa-filter"></i></span>Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>