@csrf
<div class="form-group form-show-validation">
    <label for="first_name"> First Name <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$dealer->first_name ?? old('first_name') }}" name="first_name" placeholder="First Name"  autocomplete="off">
</div>
<div class="form-group form-show-validation">
    <label for="last_name"> Last Name <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$dealer->last_name ?? old('last_name') }}" name="last_name" placeholder="Last Name"  autocomplete="off">
</div>
<div class="form-group form-show-validation">
    <label for="email"> Email <span class="required-label">*</span></label>
    <input type="email" class="form-control" value="{{ @$dealer->email ?? old('email') }}" name="email" placeholder="Email"  autocomplete="off">
</div>
<div class="form-group form-show-validation">
    <label for="contact_number"> Contact Number<span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$dealer->contact_number?? old('contact_number') }}" name="contact_number" placeholder="Contact Number should be 10 to 15 digits only."  autocomplete="off">
</div>
<div class="form-group form-show-validation">
    <label for="address"> Address <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$dealer->address ?? old('address') }}" name="address" placeholder="Address"  autocomplete="off">
</div>