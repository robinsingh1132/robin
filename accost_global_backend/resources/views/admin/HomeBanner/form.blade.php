@csrf
@php
if(empty($home_banner))
$home_banner='';
@endphp
<div class="form-group form-show-validation">
    <label for="name">Name <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$home_banner->name ?? old('name') }}" name="name" placeholder="Banner name">
</div>
<div class="form-group form-show-validation">
    <label for="image_link">Image <span class="required-label">*</span></label><span class="help-label" style="float:right;">(Containing image size should be 1600px X 400px.)</span>
    <input type="file" class="form-control" id="image_link" name="image_link" placeholder="Choose Image file">
</div>
<div class="form-group form-show-validation">
    <label for="mobile_image_link">Mobile Image <span class="required-label">*</span></label><span class="help-label" style="float:right;">(Containing image size should be 640 X 345px.)</span>
    <input type="file" class="form-control" id="mobile_image_link" name="mobile_image_link" placeholder="Choose Image file">
</div>
<div class="form-group form-show-validation">
    <label for="image_alt">Image Alt <span class="required-label">*</span></label>
    <input type="text" class="form-control" name="image_alt" value="{{ @$home_banner->image_alt ?? old('image_alt') }}" placeholder="Image alt">
</div>
<div class="form-group form-show-validation">
    <label for="url">Banner Link </label><span class="required-label">*</span><span class="help-label" style="float: right">(It's a related product link url for banner image.)</span>
    <input type="text" class="form-control" name="url" value="{{ @$home_banner->url ?? old('url') }}" placeholder="Banner link url">
</div>
<!-- <div class="form-group form-show-validation">
    <label for="position">Banner Position </label><span class="required-label">*</span><span class="help-label" style="float: right">(It's a sequence of banner image.Enter a numeric value here.)</span>
    <input type="text" class="form-control" name="position" value="{{ @$home_banner->position ?? old('position') }}" placeholder="Banner Position" required="true">
</div> -->
<div class="form-group form-show-validation" >
    <label for="position">Banner Position <span class="required-label">*</span></label><span class="help-label float-right" > ( Disable options showing already exist banner for disabled options.)</span>
    <select class="form-control" id="banner_position" name="position">
        <option value="">Choose Position</option>
        @for($i=1;$i<=5;$i++)
            <option 
                @if(!empty($home_banner))
                    @if($home_banner->position==$i)
                        selected='true'
                    @endif
                @endif
                value="{{$i}}"
                @if(in_array($i,$allPosition))
                    disabled="true" style="color: #00000040;" ; 
                @endif
            >{{$i}}</option>
            
        @endfor        
    </select>        
</div>
<div class="form-check">
    <label>Status <span class="required-label">*</span></label><br>
    <label class="form-radio-label">
        <input class="form-radio-input" type="radio" name="status" value="1" @if(@$home_banner->status) checked="" @endif>
        <span class="form-radio-sign">Active</span>
    </label>
    <label class="form-radio-label ml-3">
        <input class="form-radio-input" type="radio" name="status" value="0" @if(!@$home_banner->status) checked="" @endif>
        <span class="form-radio-sign">Inactive</span>
    </label>
</div>