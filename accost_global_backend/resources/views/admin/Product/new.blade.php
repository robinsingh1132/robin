@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">New Product</h4>
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
                        <a href="javascript:void(0);">New Product</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-plus-circle text-success"></i> New Product
                                <span class="float-right">        
                                    <a href="{{ route('product-list') }}" class="btn btn-info btn-xs text-white" data-toggle="tooltip" title="List Product"><i class="fas fa-list-alt"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="new_product_id" name="product_id" value="">
                                    @include('admin.Product.form')
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
        var priceCheck=true;
        var uniqueSize=true;
        var obj_pro_size = {};
        var arr_pro_size = [];
    </script>
    @include('admin.Product.form-validate')
    <script src="{{ asset('admin/js/pages/product/add.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        $(document).ready(function(){
            $('#dt-product-list').dataTable();
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            console.log('event', event);
                            $($.parseHTML('<img>')).attr('src', event.target.result).css('height', '150px').css('width', '150px').appendTo(placeToInsertImagePreview);
                        };
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#product-image').on('change', function() {
                $('.div-img-upload').html('');
                imagesPreview(this, 'div.div-img-upload');
            });
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                    reader.onload = function (e) {
                        $('.img-upload').attr('src', e.target.result);
                        $('.img-upload').css('height', '150px');
                        $('.img-upload').css('width', '150px');
                        var file_size = input.files[0].size;
                        var file_type=input.files[0].type;
                        file_type=file_type.split('/');
                        file_type=file_type[0];
                        if(file_type!='image'){
                            $('.file-upload').addClass('has-error');
                            $('.p-image').addClass('has-error');
                            $('.img-upload').attr("src","data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
                            $('.img-upload').css('height', '0px');
                            $('.img-upload').css('width', '0px');
                            $('.img-upload').after('<strong id="file-upload-error" class="help-block text-danger">Only image file allowed.</strong>');
                        }else{
                            $('.file-upload').removeClass('has-error');
                            $('.p-image').removeClass('has-error');
                            $('#file-upload-error').remove();
                        }
                    };
                }
            };
            /*$(".file-upload").on('change', function(){
                readURL(this);
            });*/
            $(".upload-button, .img-upload").on('click', function() {
                //alert();
                $(".file-upload").click();
            });
            $('#summernote').summernote({
                placeholder: 'Enter Description',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                maxTextLength: 500
            });
            $('#summernote2').summernote({
                placeholder: 'Enter Description',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                maxTextLength: 500
            });
            $('#summernote3').summernote({
                placeholder: 'Enter Description',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300,
                maxTextLength: 500
            });
            $( "#new_product_size" ).click(function() {
                let html='';
                let rowCount = $('.size_table tr').length;
                html+='<tr data-raw="'+rowCount+'" class="col-md-12">' +
                            /* '   <td>'+rowCount+'</td>\n' +*/
                        '   <td class="size_td_1"><input class="size_cls form-control" type=\'text\' name="size_'+rowCount+'" autocomplete="off" maxlength="50" /></td>\n' +
                        '   <td class="size_td_2"><input class="size_price_cls form-control" type=\'text\' class="positiveNumber" name="size_price_'+rowCount+'" autocomplete="off" min="0" maxlength="50"/></td>\n' +
                        '   <td class="setOne size_td_2"><input class="setOne_cls setOne_change form-control" type=\'text\' class="positiveNumber" name="set_1_price_'+rowCount+'" autocomplete="off" min="0" maxlength="50"/></td>\n' +
                        '   <td class="setTwo size_td_2"><input class="setTwo_cls setTwo_change form-control" type=\'text\' class="positiveNumber" name="set_2_price_'+rowCount+'" autocomplete="off" min="0" maxlength="50"/></td>\n' +
                        '   <td class="setThree size_td_2"><input class="setThree_cls setThree_change form-control" type=\'text\' class="positiveNumber" name="set_3_price_'+rowCount+'" autocomplete="off" min="0" maxlength="50"/></td>\n' +
                        '   <td class="size_td_2"><input class="size_stock_cls form-control" type=\'text\' class="positiveNumber" name="size_stock_'+rowCount+'" autocomplete="off" min="0" maxlength="50"/></td>\n' +
                        '   <td class="size_td_3"><a class="form-control delete_size" delete-raw="'+rowCount+'" ><i class="fas fa fa-trash"></i></a></td>\n' +
                        ' </tr>';
                $('.size_table').append(html);
                $('.checkNumber3').trigger('change');
                $('.checkNumber2').trigger('change');
            });
            $('.size_table').on('click','.delete_size',function(e){
                e.preventDefault();
                let rowCount = $('.size_table tr').length;
                if(rowCount=='2'){
                    alert("Can't delete this row. Atleast 1 row need to be exist.");
                    return false;
                }
                $(this).parents('tr').remove();
            });
            $('.positiveNumber').keyup(function(event) {
                if($(this).val()<0){
                    return false;
                }
                if($(this).val().length>10){
                    return false;
                }
                if(isNaN($(this).val())){
                    return false;
                }
            });
            $('#product_validate').on('change','#prod-sup-cat',function(){
                var prod_super_cat_id=$(this).val();
                $.ajax({
                    type:'GET',
                    url:"{{route('get-product-category')}}",
                    data:{'prod_super_cat_id' : prod_super_cat_id ,"_token": "{{ csrf_token() }}"},
                    success:function(response) {
                        var categories= response;
                        var html='';
                        html+=' <option value="">Please select categories</option>';
                        $.each(categories, function(index, value){
                            html+=' <option value="'+value.id+'">'+value.name+'</option>';
                        });
                        $('#prod-cat').empty();
                        $('#prod-cat').append(html);
                    }
                });
                /*for get Brands*/
                $.ajax({
                    type:'GET',
                    url:"{{route('get-brand')}}",
                    data:{'prod_super_cat_id' : prod_super_cat_id ,"_token": "{{ csrf_token() }}"},
                    success:function(response) {
                        var brands= response;
                        var html='';
                        html+=' <option value="">Please select brands</option>';
                        $.each(brands, function(index, value){
                            html+=' <option value="'+value.id+'">'+value.brand_name+'</option>';
                        });
                        $('#prod-brand').empty();
                        $('#prod-brand').append(html);
                    }
                });
            });

            $('#product_validate').on('change','#prod-cat',function(){
                var prod_cat_id=$(this).val();
                $.ajax({
                    type:'GET',
                    url:"{{route('get-product-subcategory')}}",
                    data:{'prod_cat_id' : prod_cat_id ,"_token": "{{ csrf_token() }}"},
                    success:function(response) {
                        var subcategories= response;
                        var html='';
                        html+=' <option value="">Please select subcategories</option>';
                        $.each(subcategories, function(index, value){
                            html+=' <option value="'+value.id+'">'+value.name+'</option>';
                        });
                        $('#prod-sub-cat').empty();
                        $('#prod-sub-cat').append(html);
                    }
                });
            });
            $('#highlight-tab').on('click', function () {
                let  product_id = $('#new_product_id').val();
                if(product_id!=''){
                    $('.no_highlight').css("display","none");
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('product-highlights')}}",
                    data:{'product_id' : product_id ,"_token": "{{ csrf_token() }}"},
                    success: function(data)
                    {
                        // console.log(data);
                        $('#highlight_html').empty();
                        $('#highlight_html').append(data);
                        let url = "{{ url('admin/catalog/product/save-highlight')}}";
                        $('#product_highlight').attr("action",url+'/'+product_id);
                    },
                    error: function(data){
                        //console.log(data.responseJSON.error);
                        if(data.error){
                            $('.no_highlight').css("display","block");
                        }

                    }
                });
            });
            $("#product_highlight").submit(function(e) {
                // for saving product highlight
                e.preventDefault();
                $('#ajax-loader').show();
                var form = $(this);
                var url = form.attr('action');
                console.log(url);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $('#ajax-loader').hide();
                        let prod_id=data;
                        $('#rel-products-tab').click();
                        let url = "{{ url('admin/catalog/product/save-tag')}}";
                        $('#product_tag').attr("action",url+'/'+prod_id);
                    },
                    error: function(data){
                        $('#ajax-loader').hide();
                        console.log(data);
                    }
                });
            });
            $(document).on( 'click', '.rel_product',function () {
                let related_product_id = $(this).val();
                let product_id=$('#new_product_id').val();
                $('#ajax-loader').show();
                if(product_id!=''){
                    $.ajax({
                        type: "POST",
                        url: "{!! route('save-related-products') !!}",
                        data: {'product_id' : product_id,'related_product_id':related_product_id,"_token": "{{csrf_token() }}"},
                        dataType: "text",
                        success: function(response){
                            $('#ajax-loader').hide();
                        },
                        error: function(response){
                            $('#ajax-loader').hide();
                            console.log(data);
                        }
                    });
                }

            });
            $(document).on('click','.delete_images', function (e) {
                let url = $(this).attr('data-link');
                $('#ajax-loader').show();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        $('#ajax-loader').hide();
                        $('#show_product_images').empty();
                        $('#show_product_images').append(data);
                    },
                    error: function(data){
                        $('#ajax-loader').hide();
                    }
                });
            });
            $(document).on('click','.set_primary_image', function (e) {
                let url = $(this).attr('data-link');
                $('#ajax-loader').show();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        $('#ajax-loader').hide();
                        $('#show_product_images').empty();
                        $('#show_product_images').append(data);
                    },
                    error: function(data){
                        $('#ajax-loader').hide();
                    }
                });
            });
            $(document).ready(function() {
                let  pId = $('#new_product_id').val();
                //console.log(pId);
                $.ajax({
                    type: "POST",
                    url: "{{ route('product-images-get')}}",
                    data:{'pId' : pId ,"_token": "{{ csrf_token() }}"},
                    success: function(data)
                    {
                        $('#show_product_images').empty();
                        $('#show_product_images').append(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                if(pId==''){
                    $('.no_highlight').css("display","block");
                }else{
                    $('.no_highlight').css("display","none");
                }
            });
            /* check unique product name*/
            $('.product_name').on('change',function(){
                var product_name=$(this).val();
                        @if(!empty($product))
                let prev_prod_id='{{$product->id}}';
                        @else
                let prev_prod_id='';
                @endif
                $.ajax({
                            url: "{{route('unique-product-name')}}",
                            type: 'POST',
                            data: {prev_prod_id:prev_prod_id,product_name:product_name,"_token": "{{ csrf_token() }}" },
                        })
                        .done(function(res) {
                            //console.log(res.message);
                            if(res.status=='error'){
                                //var html='<p id="name-error-duplicate" class="has-error">Product name already exist.</p>';
                                $('.product_name').addClass('has-error');
                                $('.product_name').parent().addClass('has-error');
                                $('#name-error').text('Product name already exist.');
                            }else{
                                $('.product_name').removeClass('has-error');
                                $('.product_name').parent().removeClass('has-error');
                                $('#name-error').text();
                            }
                            if(res.status=='success'){
                                $('.product_name').removeClass('has-error');
                                $('.product_name').parent().removeClass('has-error');
                                $('#name-error').text();
                            }

                        })
                        .fail(function() {
                            console.log("error");
                        })
            });
            /* product sizes */
            $('#t-form-size').validate({
                errorElement: 'p',
                errorClass: 'error',
                rules: {
                    pro_size: {
                        alphaNumericRegex:true,
                        uniqueSize:true,
                        required: true
                    },
                    o_price: {
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000,
                    }
                },
                messages: {
                    pro_size: {
                        required: 'Size name is required'
                    },
                    o_price: {
                        required: 'Price is required'
                    }
                },
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parent().addClass('has-error');
                    $(element).on('keyup keypres', function () {
                        var resp = $(this).valid();
                        if (resp === false) {
                            $(element).parent().addClass('has-error');
                        } else {
                            $(element).parent().removeClass('has-error');
                        }
                    });
                    if ($(element).next().hasClass('help-block')) {
                        $(element).next().remove();
                    }
                    $(element).after(error);
                },
                success: function success(element) {
                    $(element).parent().removeClass('has-error');
                },
                submitHandler: function submitHandler(form) {
                    let size_name = $(form).find('input[name="pro_size"]').val();
                    let o_price = $(form).find('input[name="o_price"]').val();
                    /*update original price*/
                    $.each(arr_pro_size, function (index, values){
                        if(size_name == values._size_name){
                            values._o_price = o_price;
                        }
                    });
                    refreshTableSizes(arr_pro_size);
                    $('#s-form-set').find('input[name="size_name"]').val(size_name);
                    $('#s-form-set').find('input[name="o_price"]').val(o_price);
                    $('#f-pro-set').show();
                    $('#f-pro-size').hide();
                    $(form).find('input[name="pro_size"]').val('');
                    $(form).find('input[name="o_price"]').val('');
                    $('#s-form-set').find('input[name="min_qty"]').val('').focus();
                    $('#s-form-set').find('input[name="max_qty"]').val('');
                    $('#s-form-set').find('input[name="s_price"]').val('');
                }
            });
            $('#s-form-set').validate({
                errorElement: 'p',
                errorClass: 'error',
                rules: {
                    size_name: {
                        required: true,
                    },
                    o_price: {
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000
                    },
                    max_qty: {
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000
                    },
                    min_qty: {
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000
                    },
                    s_price: {
                        priceCheck:true,
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000
                    }
                },
                messages: {
                    size_name: {
                        required: ' '
                    },
                    o_price: {
                        required: ' '
                    },
                    max_qty: {
                        required: 'Max Qty is required'
                    },
                    min_qty: {
                        required: 'Min Qty is required'
                    },
                    s_price: {
                        required: 'Price is required'
                    }
                },
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parent().addClass('has-error');
                    $(element).on('keyup keypres', function () {
                        var resp = $(this).valid();
                        if (resp === false) {
                            $(element).parent().addClass('has-error');
                        } else {
                            $(element).parent().removeClass('has-error');
                        }
                    });
                    if ($(element).next().hasClass('help-block')) {
                        $(element).next().remove();
                    }
                    $(element).after(error);
                },
                success: function success(element) {
                    $(element).parent().removeClass('has-error');
                },
                submitHandler: function submitHandler(form) {
                    let size_name = $(form).find('input[name="size_name"]').val();
                    let o_price = $(form).find('input[name="o_price"]').val();
                    let min_qty = $(form).find('input[name="min_qty"]').val();
                    let max_qty = $(form).find('input[name="max_qty"]').val();
                    let s_price = $(form).find('input[name="s_price"]').val();
                    let flag = true;
                    $('#p-set-error').html('').show();
                    if(parseInt(max_qty) < parseInt(min_qty)){
                        $('#p-set-error').html('Max values must be equal or greater than Min value').delay(3000).fadeOut('slow');
                        return false;
                    }
                    /*check if min-max range already exists*/
                    $.each(arr_pro_size, function (index, values){
                        if(size_name == values._size_name){
                            if(parseInt(min_qty) >= parseInt(values._min_qty) && parseInt(min_qty) <= parseInt(values._max_qty)) {
                                $('#p-set-error').html('This min-max range already added for this size').delay(3000).fadeOut('slow');
                                flag = false;
                            }
                            if(parseInt(max_qty) >= parseInt(values._min_qty) && parseInt(max_qty) <= parseInt(values._max_qty)) {
                                $('#p-set-error').html('This min-max range already added for this size').delay(3000).fadeOut('slow');
                                flag = false;
                            }
                        }
                    });
                    if(flag) {
                        obj_pro_size = {
                            _size_name: size_name,
                            _o_price: o_price,
                            _min_qty: min_qty,
                            _max_qty: max_qty,
                            _s_price: s_price
                        };
                        arr_pro_size.push(obj_pro_size);
                        refreshTableSizes(arr_pro_size);
                        $(form).find('input[name="min_qty"]').val('').focus();
                        $(form).find('input[name="max_qty"]').val('');
                        $(form).find('input[name="s_price"]').val('');
                    }
                }
            });
            $('#u-form-size').validate({
                errorElement: 'p',
                errorClass: 'error',
                rules: {
                    old_size_name: {
                        required: true,
                    },
                    pro_size: {
                        alphaNumericRegex:true,
                        uniqueSize:true,
                        required: true,
                    },
                    o_price: {
                        required: true,
                        numericRegex:true,
                        min:1,
                        max:100000,
                    }
                },
                messages: {
                    pro_size: {
                        required: 'Size name is required'
                    },
                    o_price: {
                        required: 'Price is required'
                    }
                },
                errorPlacement: function errorPlacement(error, element) {
                    $(element).parent().addClass('has-error');
                    $(element).on('keyup keypres', function () {
                        var resp = $(this).valid();
                        if (resp === false) {
                            $(element).parent().addClass('has-error');
                        } else {
                            $(element).parent().removeClass('has-error');
                        }
                    });
                    if ($(element).next().hasClass('help-block')) {
                        $(element).next().remove();
                    }
                    $(element).after(error);
                },
                success: function success(element) {
                    $(element).parent().removeClass('has-error');
                },
                submitHandler: function submitHandler(form) {
                    let old_size_name = $(form).find('input[name="old_size_name"]').val();
                    let size_name = $(form).find('input[name="pro_size"]').val();
                    let o_price = $(form).find('input[name="o_price"]').val();
                    /*update original price*/
                    $.each(arr_pro_size, function (index, values){
                        if(old_size_name == values._size_name){
                            values._size_name = size_name;
                            values._o_price = o_price;
                        }
                    });
                    refreshTableSizes(arr_pro_size);
                    $('#s-form-set').find('input[name="size_name"]').val(size_name);
                    $('#s-form-set').find('input[name="o_price"]').val(o_price);
                    $('#f-pro-set').show();
                    $('#f-pro-size').hide();
                    $('#s-form-set').find('input[name="min_qty"]').val('').focus();
                    $('#s-form-set').find('input[name="max_qty"]').val('');
                    $('#s-form-set').find('input[name="s_price"]').val('');
                    $(form).find('input[name="old_size_name"]').val('');
                    $(form).find('input[name="pro_size"]').val('');
                    $(form).find('input[name="o_price"]').val('');
                    $('#u-size-form').hide();
                }
            });
            $(document).on('click','#f-more-size', function(){
                $('#f-pro-set').hide();
                $('#u-size-form').hide();
                $('#f-pro-size').show();
            });
            $(document).on('click','.del-pro-sizes', function(){
                let index_value = $(this).attr('data-index-value');
                if(arr_pro_size.length==0){
                    alert('can not delete  this size. At least one size should be present here.');
                    return false;
                }
                arr_pro_size.splice(index_value,1);
                refreshTableSizes(arr_pro_size);
            });
            $(document).on('click','.b-add-set', function(){
                $('#f-pro-size').css('display','none');
                $('#f-pro-set').css('display','block'); 
                let size_name = $(this).attr('data-size-name');
                let o_price = $(this).attr('data-original-price');
                let ele = $('#s-form-set');
                ele.find('input[name="size_name"]').val(size_name);
                ele.find('input[name="o_price"]').val(o_price);
                ele.find('input[name="min_qty"]').val('').focus();
                ele.find('input[name="max_qty"]').val('');
                ele.find('input[name="s_price"]').val('');
                $('#p-set-info').html('').show();
                $('#p-set-info').html('Size name updated! use below form to add new sets.').delay(3000).fadeOut('slow');
            });
            $(document).on('click','.b-edit-size', function(){
                let size_name = $(this).attr('data-size-name');
                let o_price = $(this).attr('data-original-price');
                let ele = $('#u-form-size');
                ele.find('input[name="old_size_name"]').val(size_name);
                ele.find('input[name="pro_size"]').val(size_name);
                ele.find('input[name="o_price"]').val(o_price);
                $('#f-pro-size').hide();
                $('#f-pro-set').hide();
                $('#u-size-form').show();
            });
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
                let table_body = '<span class="required-label" style="margin:left;">*</span>(If you need to update sets please delete old set and create a new one.)<br>'+
                        '<div class="table-responsive mt-4 pd-3"><h5 class="font-weight-bold"><span class="text-primary">Size:</span> ' + size + ', <span class="text-primary">Original Price:</span> ' + temp_price + ' <span class="required-label" style="margin-left:15px;">*</span>(If you need to update sets please delete old set and create a new one.)<br>' +
                        '<button class="btn btn-xs btn-primary float-right ml-1 b-add-set" data-size-name="'+size+'" data-original-price="'+temp_price+'"><i class="fa fa-plus-circle"></i>Add New Set</button>' +
                        '<button class="btn btn-xs btn-primary float-right b-edit-size" data-size-name="'+size+'" data-original-price="'+temp_price+'"><i class="fa fa-edit"></i>Edit Size</button>' +
                        '</h5>' +
                        '<table class="display table table-sm"><thead><tr><th>#Set No.</th><th>Min Qty</th><th>Max Qty</th><th>Offered Price</th><th>Action</th></tr></thead><tbody>';
                let nw_index = parseInt(1);
                $.each(arr_pro_size, function (index, values){
                    if(size == values._size_name){
                        table_body +='<tr>';
                        table_body +='<td>'+nw_index+'</td><td>'+values._min_qty+'</td><td>'+values._max_qty+'</td><td>'+values._s_price+'</td><td><a class="del-pro-sizes" data-index-value="'+index+'"><i class="fa fa-trash"></i></a></td>';
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
        /*size original price and offer price validation*/
        $.validator.addMethod("priceCheck", function (value, element, param) {
            return priceCheck;
        },"Offer price should be minimum from original price.");
        $.validator.addMethod("uniqueSize", function (value, element, param) {
            return uniqueSize;
        },"Size name is already exist.");
        $(document).on('change', '#s-price', function(event) {
            var offer_price=$('#s-o-price').val();
            var special_price=$('#s-price').val();
            if(parseInt(offer_price)){
                if(parseInt(offer_price) < parseInt(special_price)){
                    priceCheck=false;
                }else{
                    priceCheck=true;
                    $('#s-price').parent().removeClass('has-error');
                    $('#s-price').parent().removeClass('has-error');
                    $('#s-price-error').text('');
                } 
            }                                   
        });
        /*search the duplicate size name with in the size array*/
        $(document).on('change', '#t-prod-size', function(event) {
            var size_name =$(this).val();
            var size_name_array=arr_pro_size;
            uniqueSize=searchFor_size_name(size_name,size_name_array);
            return uniqueSize;
        });
        $(document).on('change', '#u-prod-size', function(event) {
            var size_name =$(this).val();
            var size_name_array=arr_pro_size;
            uniqueSize=searchFor_size_name(size_name,size_name_array);
            return uniqueSize;
        });
        function searchFor_size_name(size_name,array) {
            $.each(array, function(index, el) {
                //alert(el['_size_name']);
                if (el['_size_name'] == size_name) {
                    uniqueSize=false;
                    return false;
                }else{
                    uniqueSize=true;
                }
            });
            return uniqueSize;
        }
    </script>
@endsection
