@csrf
<div class="form-group form-show-validation">
    <label for="type">Product Type <span class="required-label">*</span></label>
    <input type="text" id="type" class="product_type form-control" value="{{ @$productType->type ?? old('type') }}" name="type" placeholder="Enter Product Type"
           >
</div>
<div class="form-group form-show-validation">
    <label for="default_tax">Default Tax (Percentage) <span class="required-label">*</span></label>
    <input type="text" class="form-control" max="100" value="{{ @$productType->default_tax ?? old('default_tax') }}" name="default_tax" placeholder="Enter Default Tax"
           >
</div>