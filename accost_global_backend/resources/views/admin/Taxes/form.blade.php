@csrf
<div class="form-group">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <div class="select2-input select2-warning">
                <label for="product_type"> Product Type <span class="required-label">*</span></label>
                <select id="prod-type" name="product_type" class="form-control verifyTax prodAttr">
                    <option value="">Select Product Type</option>
                    @if(@$productType)
                        @foreach(@$productType as $val)
                            @if($val->id == @$tax->tax_product_type_id)
                                @php $selected = 'selected'; @endphp
                            @else
                                @php $selected = '';    @endphp
                            @endif
                            <option {{$selected}} value="{{ $val->id }}">{{ $val->type }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <div class="select2-input select2-warning">
                <label for="country"> Country <span class="required-label">*</span></label>
                <select id="tax-country" name="country" class="form-control verifyTax prodAttr" data-action="{{ route('get-related-states') }}">
                    <option value="">Select Country</option>
                    @if(@$countries)
                        @foreach(@$countries as $val)
                            @if($val->id == @$tax->country_id)
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
    </div>
    <a name="country"  data-toggle="modal" data-target="#addCountry" id="add_country" href="javascript:void(0)">Add Country</a>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <div class="select2-input select2-warning">
                <label for="state"> State <span class="required-label">*</span></label>
                <select id="tax-state" name="state" class="form-control verifyTax prodAttr" >
                    <option value="">Select State</option>
                </select>
            </div>
        </div>
    </div>
    <a name="state" data-toggle="modal" data-target="#addState" id="add_state" data-action="{{ route('add-state') }}" href="javascript:void(0)">Add State</a>
</div>

<div class="form-group form-show-validation">
    <label for="tax"> Tax (Percentage) <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$tax->tax ?? old('tax') }}" name="tax" placeholder="Enter tax"  autocomplete="off" >
</div>

<!-- Country Modal -->
<div class="modal fade" id="addCountry" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Country</h4><span class="required-label">*</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group form-show-validation countrySuccessMsg">
                    <label for="addcountry"> Country <span class="required-label">*</span></label>
                    <input type="text" class="form-control" id="country" name="addcountry" placeholder="Enter country"  autocomplete="off" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fas fa-times"></i></span>Close</button>
                <a class="btn btn-xs btn-primary text-white" data-action="{{ route('add-country') }}" id="save-country"><span class="btn-label"><i class="fas fa-save"></i></span>Save</a>
            </div>
        </div>
    </div>
</div>

<!-- State Modal -->
<div class="modal fade" id="addState" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add State</h4><span class="required-label">*</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group form-show-validation contSuccessMsg">
                    <div class="select2-input select2-warning">
                        <label for="country_id"> Country <span class="required-label">*</span></label>
                        <select id="popup-country" name="country_id" class="form-control prodAttr">
                            <option value="">Select Country</option>
                            @if(@$countries)
                                @foreach(@$countries as $val)
                                    @if($val->id == @$tax->country_id)
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
                <div class="form-group form-show-validation stateSuccessMsg">
                    <label for="addstate"> State <span class="required-label">*</span></label>
                    <input type="text" class="form-control" id="state" name="addstate" placeholder="Enter state"  autocomplete="off" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fas fa-times"></i></span>Close</button>
                <a class="btn btn-xs btn-primary text-white" data-action="{{ route('add-state') }}" id="save-state"><span class="btn-label"><i class="fas fa-save"></i></span>Save</a>
            </div>
        </div>
    </div>
</div>
