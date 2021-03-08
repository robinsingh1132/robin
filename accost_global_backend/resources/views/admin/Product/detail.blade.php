@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Manage Product</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="flaticon-home text-primary"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);">Product Details</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-eye text-success"></i> Product Details
                                <span class="float-right"><a href="{{ route('product-list') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">General</a>
                                        </li>                                        
                                        <li class="nav-item">
                                            @if(@$product->id)
                                            <a class="nav-link  " id="size-tab" data-toggle="tab" href="#size" role="tab" aria-controls="size" aria-selected="false">Size</a>  
                                            @else 
                                                <a class="nav-link disabled" id="size-tab" data-toggle="tooltip" title="Add General Info to enable" href="#size" role="tab" aria-controls="size" aria-selected="false">Size</a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(@$product->id)                                                
                                                <a class="nav-link" id="highlight-tab" data-toggle="tab" href="#highlight" aria-controls="highlight-tab" aria-selected="false">Highlights</a>
                                            @else
                                                <a class="nav-link disabled" id="highlight-tab" data-toggle="tooltip" title="Add General Info to enable" href="#highlight" role="tab" aria-controls="highlight-tab" aria-selected="false">Highlights</a> 
                                            @endif
                                        </li>                                        
                                        <li class="nav-item">
                                            @if(@$product->id)
                                                <a class="nav-link" id="rel-products-tab" data-toggle="tab" href="#rel-products" role="tab" aria-controls="rel-products" aria-selected="false">Related Products</a>
                                            @else
                                                <a class="nav-link disabled" id="rel-products-tab" data-toggle="tooltip" title="Add General Info to enable" href="#rel-products" role="tab" aria-controls="rel-products" aria-selected="false">Related Products</a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(@$product->id)
                                                <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO</a>
                                            @else
                                                <a class="nav-link disabled" id="seo-tab" data-toggle="tooltip" title="Add General Info to enable" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO</a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(@$product->id)
                                                <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                                            @else
                                                <a class="nav-link disabled" id="images-tab" data-toggle="tooltip" title="Add General Info to enable" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                                            @endif
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active wizard-container" id="general" role="tabpanel" ariarequired-labelledby="general-tab">
                                            <h4 style="margin: 10px;" class="text-danger text-center"> <b>Product Details</b> </h4>
                                            <input type="hidden" id="new_product_id" name="product_id" value="{{$product->id}}">
                                            <div class="form-group form-show-validation">
                                                <label for="name"> Product Name <span class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ @$product->name ?? old('name') }}" name="name" placeholder="Product Name"  autocomplete="off" disabled>
                                            </div>                                      
                                            <div class="form-group">
                                                <label>Select Super Category<span class="required-label">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-10">
                                                        <div class="select2-input select2-warning">
                                                            <select id="prod-sup-cat" name="product_super_category" class="form-control" data-action="{{ route('get-product-category') }}" disabled>
                                                                <option disabled>Select Super Category</option>
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
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Category<span class="required-label">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-10">
                                                        <div class="select2-input select2-warning">
                                                            <select id="prod-cat" name="product_category" class="form-control" data-action="{{ route('get-product-subcategory') }}" disabled>
                                                                <option disabled>Select Category</option>
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
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Subcategory<span class="required-label">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-10">
                                                        <div class="select2-input select2-warning">
                                                            <select id="prod-sub-cat" name="product_sub_category" class="form-control" disabled>
                                                                <option disabled>Select Subcategory</option>
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
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Brand<span class="required-label">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-10">
                                                        <div class="select2-input select2-warning">
                                                            <select id="prod-brand" name="brand_id" class="form-control" disabled>
                                                                <option disabled>Select Brand</option>
                                                                @foreach($brands as $brand)
                                                                    @if($product->brand_id==$brand->id)

                                                                        <option value="{{$brand->id }}" selected>{{$brand->brand_name }}</option>
                                                                    @else
                                                                        <option value="{{$brand->id }}">{{$brand->brand_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_type"> Product Type <span class="required-label">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-10">
                                                        <div class="select2-input select2-warning">
                                                            <select id="product-type" name="product_type" class="form-control" disabled>
                                                                <option>Select Product Type</option>
                                                                @if(@$productType)
                                                                    @foreach(@$productType as $val)
                                                                        @if($val->id == @$product->tax_product_type_id)
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
                                            <div class="form-group form-show-validation">
                                                <label for="sku"> SKU <span class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ @$product->sku ?? old('sku') }}" name="sku" placeholder="Enter SKU"  autocomplete="off" disabled>
                                            </div>
                                            <div class="form-group form-show-validation">
                                                <label for="product_details"> Product Details <span class="required-label">*</span></label>
                                                <textarea class="form-control" id="summernote" name="product_details" placeholder="Product Details" disabled>{{ @$product->product_details ?? old('product_details') }}</textarea>
                                            </div>
                                            <div class="form-group form-show-validation">
                                                <label for="additional_details"> Additional Details <span class="required-label">*</span></label>
                                                <textarea class="form-control" id="summernote2" name="additional_details" placeholder="Additional Details" disabled>{{ @$product->additional_details ?? old('additional_details') }}</textarea>
                                            </div>
                                            <div class="form-group form-show-validation">
                                                <label for="term_and_condition"> Term and Conditions <span class="required-label">*</span></label>
                                                <textarea class="form-control" id="summernote3" name="term_and_condition" placeholder="term and condition" disabled>{{ @$product->term_and_condition}}</textarea>
                                            </div>
                                            <div class="form-check">
                                                <label>Is Featured <span class="required-label">*</span></label><br>
                                                <label class="form-radiorequired-label">
                                                    <input class="form-radio-input" type="radio" name="is_featured" value="1" {{ @$product->is_featured == 1 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">Yes</span>
                                                </label>
                                                <label class="form-radiorequired-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="is_featured" value="0" {{ @$product->is_featured == 0 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">No</span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>Is Free Shipping <span class="required-label">*</span></label><br>
                                                <label class="form-radiorequired-label">
                                                    <input class="form-radio-input" type="radio" name="is_free_shipping" value="1" {{ @$product->is_free_shipping == 1 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">Yes</span>
                                                </label>
                                                <label class="form-radiorequired-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="is_free_shipping" value="0" {{ @$product->is_free_shipping == 0 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">No</span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>Is Review Allowed <span class="required-label">*</span></label><br>
                                                <label class="form-radiorequired-label">
                                                    <input class="form-radio-input" type="radio" name="is_review_allowed" value="1" {{ @$product->is_review_allowed == 1 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">Yes</span>
                                                </label>
                                                <label class="form-radiorequired-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="is_review_allowed" value="0" {{ @$product->is_review_allowed == 0 ? 'checked' : '' }} disabled>
                                                    <span class="form-radio-sign">No</span>
                                                </label>
                                            </div>
                                            @if(@$product->id)
                                                <div class="form-check">
                                                    <label>Status <span class="required-label">*</span></label><br>
                                                    <label class="form-radiorequired-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="1" {{ @$product->status == 1 ? 'checked' : '' }} disabled>
                                                        <span class="form-radio-sign">Activate</span>
                                                    </label>
                                                    <label class="form-radiorequired-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status" value="0" {{ @$product->status == 0 ? 'checked' : '' }} disabled>
                                                        <span class="form-radio-sign">Inactivate</span>
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                                                <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane wizard-container" id="size" role="tabpanel" ariarequired-labelledby="size-tab">
                                            <h3 class="text-left ml-3"><b>Product Sizes and Sets:</b></h3>
                                            <div class="row pd-3">
                                                <div class="col-md-12 mt-1" id="t-table-size">
                                                    {{--to be filled by JS--}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-4">
                                                    <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                                                    <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="highlight" role="tabpanel" ariarequired-labelledby="highlight-tab">
                                        <h4 style="margin: 10px;" class="text-danger text-center"> <b>Product highlights with its Values</b> </h4>
                                        <form id="product_highlight" method="POST" action="{{route('product-save-highlight',$product->id)}}">
                                            @csrf
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <label>Highlights</label>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-10" id="highlight_html">
                                                                    @if(!empty($product->productHighlight))
                                                                        @foreach($product->productHighlight as $highlight)
                                                                            <div class="form-group form-show-validation">
                                                                                <label for="name"> {{$highlight->highlight_name}}</label>
                                                                                <input type="text" class="form-control" name="highlight_{{$highlight->highlight_id}}" placeholder="Enter {{$highlight->highlight_name}}" autocomplete="off" value="{{$highlight->highlight_value}}" disabled>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="form-group form-show-validation">
                                                                            <label for="name">No result found. </label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">    
                                                    <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                     
                                                    <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                                </div>
                                        </form>
                                        </div>
                                        <div class="tab-pane" id="rel-products" role="tabpanel" aria-required="rel-products-tab" aria-labelledby="rel-products-tab">
                                            <h4 style="margin: 10px;" class="text-danger text-center"> <b> Related Product</b> </h4>
                                            {{--<input type="hidden" value="{{ @$product->id }}" name="product_id">--}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-10">
                                                        <label for="name">Related Products</label>
                                                        @if(!empty($rel_product_ids))
                                                            <ul>
                                                                @foreach($rel_product_ids as $rel_product)
                                                                    <li>{{@$rel_product->product->name}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group form-show-validation">
                                                        <form id="product_tag" method="POST" action="{{route('save-products-tag',$product->id)}}">
                                                            @csrf
                                                            <div class="form-group form-control ">
                                                                <div class="form-group form-show-validation">
                                                                    <label for="tag"> Tags <span class="required-label">*</span></label>
                                                                    </label>
                                                                    <label><span class="help-label">(Press Comma after enter text to making tags.)</span></label>
                                                                    <div class="form-group form-show-validation">
                                                                        <input  class="form-control" type="text" id="tag-name" data-role="tagsinput" name="tag_name"
                                                                           placeholder="Enter multiple tags." autocomplete="off" value="{{$tag_name}}" disabled>
                                                                    </div>
                                                                </div>                
                                                            </div>
                                                            <div class="form-group">    
                                                                <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                                                                <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="tab-pane" id="seo" role="tabpanel" ariarequired-labelledby="attributes-tab">
                                            <h4 style="margin: 10px;" class="text-danger text-center"> <b>Add SEO Details</b> </h4>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group form-show-validation">
                                                        <label for="page_title"> Page Title <span class="required-label">*</span></label>
                                                        <input type="text" class="form-control" value="{{ @$product->page_title ?? old('page_title') }}" name="page_title" placeholder="Enter Page Title"  autocomplete="off" disabled>
                                                    </div>
                                                    <div class="form-group form-show-validation">
                                                        <label for="seo_keywords"> SEO Keyword <span class="required-label">*</span></label>
                                                        <input type="text" class="form-control" value="{{ @$product->seo_keywords ?? old('seo_keywords') }}" name="seo_keywords" placeholder="Enter SEO Keyword"  autocomplete="off" disabled>
                                                    </div>
                                                    <div class="form-group form-show-validation">
                                                        <label for="seo_description"> SEO Description <span class="required-label">*</span></label>
                                                        <input type="text" class="form-control" value="{{ @$product->seo_description ?? old('seo_description') }}" name="seo_description" placeholder="Enter SEO Description"  autocomplete="off" disabled>
                                                    </div>
                                                    <div class="form-group form-show-validation">
                                                        <label for="product_page_slug"> Product Page Slug <span class="required-label">*</span></label>
                                                        <input type="url" class="form-control" value="{{ @$product->product_page_slug ?? old('product_page_url') }}" name="product_page_slug" placeholder="Enter Product Page Slug"  autocomplete="off" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                                                <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="images" role="tabpanel" ariarequired-labelledby="images-tab">
                                        <h4 style="margin: 10px;" class="text-danger text-center"> <b>Product Images</b> </h4>
                                        <div class="row">
                                            <div class="col-md-12 ml-auto mr-auto">
                                                <div class="main-section">
                                                    <form method="post" id="product_image" action="{{route('product-image-upload',$product->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="form-group form-show-validation">
                                                                <label for="tag"> Choose Image <span class="required-label">*</span></label>
                                                                <input type="file" class="form-control" id="product-image" name="product_image"
                                                                       placeholder="Choose images" autocomplete="off" disabled>
                                                            </div>

                                                        </div>
                                                        <div class="form-group form-show-validation">
                                                            <label for="is_header"> Is Header Image &nbsp &nbsp &nbsp<input type="checkbox" name="is_header"  id="header_image" disabled></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary view_edit_button" data-action="{{route('edit-product',$product->id) }}"><span class="btnrequired-label"><i class="fas fa-edit"></i></span> Edit</button>
                                                            <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="main-section">
                                                    <div class="form-group" id="show_product_images">
                                                        <div class="column">
                                                        @foreach($product_images as $image)
                                                        @if($image->is_header==1) 
                                                            <img class="image_border" src="{{ asset('images/product/'.$image->image) }}" alt="{{$image->image}}" width="120px" height="120px">&nbsp &nbsp
                                                        @else
                                                            <img src="{{ asset('images/product/'.$image->image) }}" alt="{{$image->image}}" width="120px" height="120px">&nbsp &nbsp
                                                        @endif
                                                        @endforeach
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var obj_pro_size = {};
        var arr_pro_size = <?php echo json_encode($arr_product_sets); ?>;
    </script>
    <script src="{{ asset('admin/js/pages/product/details.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        $('.view_edit_button').on('click',function(){
            var tab_action= $(this).attr('data-action');
            $('.tab-pane').each(function(){
                if($(this).hasClass('active')){
                    var tab_id=$(this).attr('id');                   
                    tab_action=tab_action+'-'+encodeURI(tab_id);
                    //alert(tab_action);
                    window.location.href=tab_action;
                }
            });
            return false;
        });
    $(document).ready(function($) {
        var maxQty2=  $('#maximum_quantity_2').val();
        var minQty2=  $('#minimum_quantity_2').val();
        var maxQty3=  $('#maximum_quantity_3').val();
        var minQty3=  $('#minimum_quantity_3').val();
        if((minQty2 && maxQty2) == ''){
            $('.setTwo').css('display','none');
        }else{
            $('.setTwo').css('display','inline-flex');
        }
        if((minQty3 && maxQty3) == ''){
            $('.setThree').css('display','none');            
        }else{
            $('.setThree').css('display','inline-flex');
        }
        refreshTableSizes(arr_pro_size);
    });
        function refreshTableSizes(arr_pro_size) {
            arr_unique_size = [];
            $.each(arr_pro_size, function(index, values){
                arr_unique_size.push(values._size_name);
            });
            arr_unique_size = uniqueArray(arr_unique_size);
            let table_str = '';
            $.each(arr_unique_size, function(index, size) {
                let temp_price = '';
                $.each(arr_pro_size, function (index, values){
                    if(size == values._size_name){
                        temp_price = values._o_price;
                    }
                });
                let table_body = '<div class="table-responsive mt-4"><h5 class="font-weight-bold"><span class="text-primary">Size:</span> ' + size + ', <span class="text-primary">Original Price:</span> ' + temp_price + '' +
                        '</h5>' +
                        '<table class="display table table-sm"><thead><tr><th>#Set No.</th><th>Min Qty</th><th>Max Qty</th><th>Offered Price</th></tr></thead><tbody>';
                let nw_index = parseInt(1);
                $.each(arr_pro_size, function (index, values){
                    if(size == values._size_name){
                        table_body +='<tr>';
                        table_body +='<td>'+nw_index+'</td><td>'+values._min_qty+'</td><td>'+values._max_qty+'</td><td>'+values._s_price+'</td>';
                        table_body += '</tr>';
                        nw_index++;
                    }
                });
                table_body += '</tbody></table>';
                table_str += table_body;
            });
            $('#t-table-size').html(table_str);
        }
        function uniqueArray(array) {
            return $.grep(array, function(el, index) {
                return index === $.inArray(el, array);
            });
        }
    </script>
@endsection