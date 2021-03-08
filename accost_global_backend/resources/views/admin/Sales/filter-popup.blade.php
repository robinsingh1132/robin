{{--Modal Sales Filter start--}}
<div class="modal fade" id="filterSales" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="filter-sales" method="GET" action="{{ route('filter-sales') }}">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sales Filter</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group form-show-validation">
                        <div class="select2-input select2-warning">
                            <span>Product List</span>
                            <select id="prod-id" name="product_id" class="form-control">
                                <option value="">Select Products</option>
                                @if(@$products)
                                    @foreach(@$products as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group form-show-validation">
                        <span>Date: From</span>
                        <input type="text" id="from_date" class="form-control fromDate" name="from_date" value="" placeholder="Enter From date" autocomplete="off">
                    </div>
                    <div class="form-group form-show-validation">
                        <span>Date: To</span>
                        <input type="text" id="to_date" class="form-control toDate" name="to_date" value="" placeholder="Enter To date" autocomplete="off">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fas fa-times"></i></span>Close</button>
                        <button type="submit" class="btn btn-xs btn-primary text-white" ><span class="btn-label"><i class="fas fa-filter"></i></span>Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>