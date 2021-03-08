<script>
    //product type form validations
    var verifyProductType = true;
    $("#frm-pro-type").validate({
        validClass: "success",
        rules: {
            type: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                verifyProductUnique:true,
                //alphaRegex:true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            default_tax: {
                required: true,
                max: 100,
            }
        },
        messages: {
            type: {
                required: 'Enter product type.'
            },
            default_tax: {
                required: 'Enter default tax'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
/*additional validation via add method*/
    jQuery.validator.addMethod("alphaNumericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+(?:-[a-z]+)+$/gim.test(value);
    }, "This field must contain only letters & hyphen.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
    jQuery.validator.addMethod("verifyProductUnique", function(value, element) {
        //console.log(verifyProductType);
        return verifyProductType;
    }, "Product Type already exist.");

    $(document).ready(function(){
        $('#type').on('keyup', function(){
            $(this).val($(this).val().split(" ").join("-").toLowerCase());
        });
    });

    /* check unique product type*/
    $(document).on('change', '.product_type', function(event) {
        event.preventDefault();
        verify_product_type();
    });
    
    function verify_product_type(){
        let product_type=$('.product_type').val(); 
        @if(!empty($productType))
            let prev_type_id='{{$productType->id}}';
        @else
            let prev_type_id='';
        @endif
        $.ajax({
            url: "{{route('unique-product-type')}}",
            type: 'POST',
            data: {prev_type_id:prev_type_id,product_type:product_type,"_token": "{{ csrf_token() }}" },
        })
        .done(function(res) {
            if(res.status==1){
               verifyProductType=false;
                $('#type-error').remove();
                $('input[name=type]').closest('.form-group').removeClass('has-error').addClass('has-success');
               $('input[name=type]').after('<label id="type-error" class="error" for="type">Prodcut Type already exist.</label>');
               $('input[name=type]').closest('.form-group').addClass('has-error');
            }else{
                if(verifyProductType==false){
                    if($('#type-error').text()=='Prodcut Type already exist.'){
                        $('#type-error').remove();
                        $('input[name=type]').closest('.form-group').removeClass('has-error');
                    }
                }
               verifyProductType=true;
            }
        })
    }
</script>