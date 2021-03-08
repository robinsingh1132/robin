<script>
    var qtyCheck1=true;
    var qtyCheck2=true;
    var qtyCheck3=true;
    var set1Fill=true;
    var set2Fill=true;
    var set3Fill=true;
    jQuery.validator.addMethod("alphaNumericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+(?:-[a-z]+)+$/gim.test(value);
    }, "This field contain letters,numbers with hyphen.");

    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^\S[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field contain letters,numbers not space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^\S[a-z\ \s]+$/i.test(value);
    }, "This field contain only letters not space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\^\S]+$/i.test(value);
    }, "This field contain numbers not space.");
    jQuery.validator.addMethod("numericValue", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "This field contain numbers not comma,space,decimal.");
    jQuery.validator.addMethod("positiveNumber", function(value) {
        if(Number(value)>0){
           return Number(value) > 0;  
        }
        if(isNaN(value)){
            return true;
        }
        //return Number(value) > 0;        
    }, "This field contain only positive numbers.");
    $.validator.addMethod("qtyCheck1", function (value, element, param) {
        return qtyCheck1;
    },"Maximum quantity should be greater than minimum quantity.");
    $.validator.addMethod("qtyCheck2", function (value, element, param) {
        return qtyCheck2;
    },"Maximum quantity should be greater than minimum quantity.");
    $.validator.addMethod("qtyCheck3", function (value, element, param) {
        return qtyCheck3;
    },"Maximum quantity should be greater than minimum quantity.");
    $.validator.addMethod("set1Fill", function (value, element, param) {
        return set1Fill;
    },"Please fill up this field.");
    $.validator.addMethod("set2Fill", function (value, element, param) {
        return set2Fill;
    },"Please fill up this field.");
    $.validator.addMethod("set3Fill", function (value, element, param) {
        return set3Fill;
    },"Please fill up this field.");    

</script>
<script>
    $(document).ready(function(){
        $('.product_name').on('keyup', function(){
        $('#page_title').val($(this).val());
        $('#slug').val($(this).val().split(" ").join("-").toLowerCase());
       });
        $('#slug').on('keyup', function(){
            $('#slug').val($(this).val().split(" ").join("-").toLowerCase());
        });
    });
    $.validator.addMethod("lessThan", function (value, element, param) {
        var $otherElement = $(param);
        return parseInt(value, 10) <= parseInt($otherElement.val(), 10);
    });
    $.validator.addMethod("greaterThan", function (value, element, param) {
        var $otherElement = $(param);
        return parseInt(value, 10) >= parseInt($otherElement.val(), 10);
    });
</script>
<script>
    /*product validate-form*/
    $('#product_validate').validate({
        errorElement: 'p',
        errorClass: 'has-error',
        rules:{
            product_type:{
                required:true,
            },
            super_category_id:{
                required:!0,
            },
            category_id:{
                required:!0,
            },
            subcategory_id:{
                required:!0,
            },
            brand_id:{
                required:!0,
            },
            name: {
                required: true,
            },
            sku:{
                required:true,
            },
            product_details:{
                required:true,
            },
            additional_details:{
                required:true,
            },
            term_and_condition:{
                required:true,
            }
        },
        messages:{
            product_type:{
                required:'Please Select Product type.',
            },
            super_category_id:{
                required:'Please select Super category.',
            },
            category_id:{
                required:'Please select category.',
            },
            subcategory_id:{
                required:'Please select subcategroy.',
            },
            name: {
                required: 'Please Enter name.',
            },
            sku:{
                required:'Please Enter SKU.',
            },
            product_details:{
                required:'Please enter product details.',
            },
            additional_details:{
                required:'Please enter additional details.',
            },
            term_and_condition:{
                required:'Please enter term and condition.',
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
            if ($('#summernote').summernote('isEmpty')) {
                $("#summernote-1-error").html('Please enter Specification. Maximum 500 characters');
                return false;
            }else{
                $("#summernote-1-error").append('');
            }
            var url = $('#product_validate').attr('action');
            $('#ajax-loader').show();
            $.ajax({
                type: "POST",
                url: url,
                data: $(form).serialize(), // serializes the form's elements.
                success: function(data)
                {
                   //console.log(data);
                    $('#ajax-loader').hide();
                    let prod_id=data;
                    $('#size-tab').click();
                    $( ".other_tabs" ).prop( "disabled", false );
                    $('#new_product_id').attr("value",prod_id);
                    let url = "{{ url('admin/catalog/product/save-size')}}";
                    $('#product_size').attr("action",url+'/'+prod_id);
                    /*pass all tab url*/
                    let url_highlight="{{ url('admin/catalog/product/save-highlight/')}}";
                    $('#product_highlight').attr("action",url_highlight+'/'+prod_id);
                    let url_image="{{ url('admin/catalog/product/image/upload/store/')}}";
                    $('#product_image').attr("action",url_image+'/'+prod_id);
                    let url_tag="{{ url('admin/catalog/product/save-tag/')}}";
                    $('#product_tag').attr("action",url_tag+'/'+prod_id);
                    let url_seo="{{ url('admin/catalog/product/save-seo/')}}";
                    $('#product_seo').attr("action",url_seo+'/'+prod_id);
                    let url_size="{{ url('/catalog/product/save-size/')}}";
                    $('#t-form-size').attr("action",url_size+'/'+prod_id);
                    let productName = $('#general-product-name').val();
                    $('#page_title').val(productName);
                    $('#slug').val(productName.split(" ").join("-").toLowerCase());
                },
                error: function(data){
                    $('#ajax-loader').hide();
                    if(typeof(data.responseJSON.errors.name[0])!="undefined"){
                        if( data.responseJSON.errors.name[0]=="The name has already been taken."){
                           alert('product name alredy taken.'); 
                        }                         
                    }
                }
            });
            return  false;
        }
    });
    /*product size-form*/
    $('#product_size').validate({
        errorElement: 'p',
        errorClass: 'error',
        rules: {},
        messages: {},
        errorPlacement: function errorPlacement(error, element) {},
        success: function success(element) {},
        submitHandler: function submitHandler(form) {
            var url = $(form).attr('action');
            console.log(arr_pro_size);
            $('#ajax-loader').show();
            $.ajax({
                type: "POST",
                url: url,
                data: {arr_product_size: arr_pro_size, _token: $('#product_size').find('input[name="_token"]').val()}, // serializes the form's elements.
                success: function(data)
                {
                    $('#ajax-loader').hide();
                    let prod_id=data;
                    //console.log('CCC', prod_id);
                    $('#highlight-tab').click();
                },
                error: function(data){
                    $('#ajax-loader').hide();
                }
            });
            return false;
        }
    });
    jQuery.validator.addClassRules('size_cls', {
        required: true,
    });
    jQuery.validator.addClassRules('size_price_cls', {
        required: true,
        numericRegex:true,
    });
    jQuery.validator.addClassRules('setOne_cls', {
        required: true,
        numericRegex:true,
        max:1000000000,
    });
    jQuery.validator.addClassRules('setTwo_cls', {
        required: true,
        numericRegex:true,
        max:1000000000,
        set2Fill:true,
    });
    jQuery.validator.addClassRules('setThree_cls', {
        required: true,
        numericRegex:true,
        max:1000000000,
        set3Fill:true,
    });
    jQuery.validator.addClassRules('size_stock_cls', {
        required: true,
    });
    /*product tag form*/
    $('#product_tag').validate({
        errorElement: 'p',
        errorClass: 'error',
        rules: {
            tag_name: {
                required: true,
            }
        },
        messages: {
            tag_name: {
                required: 'Please enter tag names.',
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
            //console.log('aaaaa');
            var url = $(form).attr('action');
            $('#ajax-loader').show();
            $.ajax({
                type: "POST",
                url: url,
                data: $(form).serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $('#ajax-loader').hide();
                    let prod_id=data;
                    $('#seo-tab').click();
                    let url = "{{ url('admin/catalog/product/save-seo')}}";
                    $('#product_seo').attr("action",url+'/'+prod_id);

                },
                error: function(data){
                    $('#ajax-loader').hide();
                }
            });
            return false;
        }
    });
    /*product seo form*/
    $('#product_seo').validate({
        errorElement: 'p',
        errorClass: 'error',
        rules: {
            page_title: {
                required: true,
            },
            seo_keywords: {
                required: true
            },
            seo_description: {
                required: true
            },
            product_page_slug: {
                required: true
            }
        },
        messages: {
            page_title: {
                required: 'Please enter page title.',
            },
            seo_keywords: {
                required: 'Please enter seo keywords.',
            },
            seo_description: {
                required: 'Please enter description.',
            },
            product_page_slug: {
                required: 'Please enter slug .',
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
            var url = $(form).attr('action');
            $('#ajax-loader').show();
            $.ajax({
                type: "POST",
                url: url,
                data: $(form).serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $('#ajax-loader').hide();
                    let prod_id=data;
                    $('#images-tab').click();
                    let url = "{{ url('admin/catalog/product/image/upload/store')}}";
                    $('#product_image').attr("action",url+'/'+prod_id+'?');
                },
                error: function(data){
                    $('#ajax-loader').hide();
                }
            });
            return false;
        }
    });
    /*product image form*/
    $('#product_image').validate({
        errorElement: 'p',
        errorClass: 'error',
        rules: {
            product_image: {
                required: true,
            }
        },
        messages: {
            product_image: {
                required: 'Please upload image.',
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
            var url = $(form).attr('action');
            var formData = new FormData(form);
            $('#ajax-loader').show();
            $.ajax({
                type:'POST',
                url: url,
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $('#ajax-loader').hide();
                    /*$('.img-upload').attr("src","{{ asset('admin/img/no-image.png') }}");*/
                    $('.img-upload').attr("src","data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
                    $('.img-upload').css('height', '0px');
                    $('.img-upload').css('width', '0px');
                    $('#product_image')[0].reset();
                    $('.div-img-upload').html('');
                    let  pId = $('#new_product_id').val();
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
                },
                error: function(data){
                    $('#ajax-loader').hide();
                }
            });
            return false;
        }
    });
    /*product set validation with set price hide and show */
    $(document).ready(function($) {
        $('.setTwo').css('display','none');
        $('.setThree').css('display','none');
    });
    $('.checkNumber1').change(function(event) {
        var maxQty=  parseInt($('#maximum_quantity_1').val());
        var minQty=  parseInt($('#minimum_quantity_1').val());
        if(typeof(maxQty)!='undefined'){
            if(minQty > maxQty){
            qtyCheck1=false;
            //$('.setOne').css('display','none');
            //set1Fill=false;
            }else{
                qtyCheck1=true;
               // $('.setOne').css('display','block');
                $('#maximum_quantity_1').parent().removeClass('has-error');
                $('#maximum_quantity_1').parent().removeClass('has-error');
                $('#maximum_quantity_1-error').text(' ');
            }
            if(!isNaN(maxQty)){
                $('#minimum_quantity_2').val(parseInt(maxQty)+1).attr('readonly','true');
            }
        }else{
            $('#minimum_quantity_2').val('');
            $('#minimum_quantity_3').val('').attr('placeholder','Minimum Units').attr('readonly','true');
            $('#maximum_quantity_2').val('').attr('placeholder','Maximum Units').attr('readonly','true');
            $('#maximum_quantity_3').val('').attr('placeholder','Maximum Units').attr('readonly','true');
            $('.setOne_change').val('');
            $('.setTwo').css('display','none');
            $('.setTwo_change').val('');
            $('.setThree').css('display','none');          
            $('.setThree_change').val('');
        }          
        if(minQty<=maxQty){
            qtyCheck1=true;
            $('#minimum_quantity_1').parent().removeClass('has-error');
            $('#minimum_quantity_1').parent().removeClass('has-error');
            $('#minimum_quantity_1-error').text('');
        }               
    });
    $('.checkNumber2').change(function(event) {
        var maxQty=  parseInt($('#maximum_quantity_2').val());
        var minQty=  parseInt($('#minimum_quantity_2').val());
        var maxQty3=  parseInt($('#maximum_quantity_3').val());
        var minQty3=  parseInt($('#minimum_quantity_3').val());
        if(typeof maxQty=='undefined'){
            qtyCheck2=true;
            return false;
        }
        if((typeof maxQty !='undefined')&&(!isNaN(maxQty))){
            if(minQty > maxQty){
                qtyCheck2=false;
                $('.setTwo').css('display','none');
            }else{
                qtyCheck2=true;
                $('.setTwo').css('display','table-cell');
                $('#maximum_quantity_2').parent().removeClass('has-error');
                $('#maximum_quantity_2-error').text('');
            }
            if($('#minimum_quantity_3').val()!=parseInt(maxQty)+1){
               $('#minimum_quantity_3').val(parseInt(maxQty)+1).attr('readonly','true'); 
               $('#maximum_quantity_3').val('').attr('placeholder','Maximum Units').removeAttr('readonly','true'); 
            }
             
        }else{
            qtyCheck2=true;
            $('.setTwo').css('display','none');
            $('.setTwo_change').val(' ');
            $('#minimum_quantity_3').val(' ').attr('placeholder','Minimum Units').attr('readonly','true'); 
            $('#maximum_quantity_3').val(' ').attr('placeholder','Maximum Units');
            $('.setThree').css('display','none');
            $('.setThree_change').val(' ');
        }
        if(minQty<=maxQty){
            qtyCheck2=true;
            $('.setTwo').css('display','table-cell');           
            $('#minimum_quantity_2').parent().removeClass('has-error');
            $('#minimum_quantity_2-error').text('');
        }
        if((minQty && maxQty) == ''){
            $('.setTwo').css('display','none');
        }       

    });
    $('.checkNumber3').change(function(event) {
        var maxQty=  parseInt($('#maximum_quantity_3').val());
        var minQty=  parseInt($('#minimum_quantity_3').val());
        if(typeof maxQty=='undefined'){
            qtyCheck3=true;
        }
        if((typeof maxQty !='undefined')&&(!isNaN(maxQty))){
            if(minQty > maxQty){
                qtyCheck3=false;
                $('.setThree').css('display','none');
            }else{
                qtyCheck3=true;
                $('.setThree').css('display','table-cell');
                $('#maximum_quantity_3').parent().removeClass('has-error');
                $('#maximum_quantity_3-error').text('');
            }
        }else{
            qtyCheck3=true;
            $('.setThree').css('display','none');           
            $('#minimum_quantity_3').attr('readonly','true'); 
            $('#maximum_quantity_3').val(' ').attr('placeholder','Maximum Units');
            $('.setThree').css('display','none');
            $('.setThree_change').val(' ');
        }
        if(minQty<=maxQty){
            qtyCheck3=true;
            $('.setThree').css('display','table-cell');
            /*$('#minimum_quantity_3').parent().removeClass('has-error');
            $('#minimum_quantity_3').parent().removeClass('has-error');
            $('#minimum_quantity_3-error').text('');*/
        }
        if((minQty && maxQty) == ''){
            $('.setThree').css('display','none');
            $('.setThree_change').val(' ');
        }        
    });
    $(document).on('change', '.setTwo_change', function(event) {
        event.preventDefault();       
        let setTwo=$(this).val();
        if((setTwo !='')&&(typeof(setTwo)!="undefined")){
            set2Fill=true; 
        }else{
            set2Fill=false;
        }
    }); 
    $(document).on('change', '.setThree_change', function(event) {
        event.preventDefault();
        let setThree=$(this).val();
        if((setThree !='')&&(typeof(setThree)!="undefined")){
           set3Fill=true; 
        }else{
            set3Fill=false;
        }
    });
</script>