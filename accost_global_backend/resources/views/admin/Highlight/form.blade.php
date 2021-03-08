@csrf
@php
    if(empty($highlight_subcat_hidden_ids)){
        $highlight_subcat_hidden_ids='';
    }
@endphp
<div class="form-group">
    <label for="name">Highlight Label <span class="required-label">*</span></label>
    <input type="text" class="form-control highlight_name" value="{{ @$highlight->name ?? old('name') }}" name="name" placeholder="Highlight Label"  autocomplete="off">
    <input type="hidden" class="form-control sel_sub_cat" name="selected_subcat" value="{{ $highlight_subcat_hidden_ids}}">
    @include('flash::message')
    <div class="card col-md-12">
    <div class="card-body">
        <div class="col-md-auto">
            <div class="table-responsive">
                <table id="dt-product-subcat-list" class="display table table-striped table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Check</th>
                        <th>Subcategory Name</th>
                        <th>Category Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($subcategories))
	                    	@foreach($subcategories as $subcat)
                                <?php
                                $checked = '';
                                    if(!empty($highlight_subcategories)){
                                        $check = $highlight_subcategories->where('product_subcategories_id', $subcat->id);
                                        if(count($check) > 0){
                                            $checked = 'checked';
                                        }
                                    }
                                ?>
	                    	<tr>
	                    		<td><input type="checkbox" class="pro_sub_cat_check" name="sub_cat_id[]" value="{{$subcat->id}}" {{ $checked }}></td>
	                    		<td>{{$subcat->name}}</td>
	                    		<td>{{$subcat->ProductCategory->name}}</td>
	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
