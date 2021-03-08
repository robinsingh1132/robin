<script>
    var verifyBrandUnique = true;
    $("#frm-brand").validate({
        validClass: "success",
        rules: {
            super_category_id: {
                required: !0,
            },
            brand_name: {
                required: !0,
                minlength: 2,
                verifyBrandUnique:true,
                alphaNumericRegex: true,
            },           
            status: {
                required: !0,
            }
        },
        messages: {
            super_category_id: {
                required: 'Choose Brand super category name.'
            },
            brand_name: {
                required: 'Enter Brand name.'
            },            
            status: {
                required: 'Choose the option.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });

/*additional validation via add method */

    jQuery.validator.addMethod("alphaNumericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+(?:-[a-z]+)+$/gim.test(value);
    }, "This field must contain only letters ,numbers with hyphen.");

    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[^\s][a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters,numbers & blank space is not allowed.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");

    jQuery.validator.addMethod("verifyBrandUnique", function(value, element) {
        return verifyBrandUnique;
    },  "Brand name already exist.");
    
/* check unique brand name*/   
    $(document).on('change', '.brand_name', function(event) {
        event.preventDefault();
        verify_brand_uniqueness();
    });
    
    /*fill up slug value with '-' symbol on key up brand name*/
    $('.brand_name').keyup(function() {
        let brand_name= $(this).val();
        $('#slug').val($(this).val().split(" ").join("-").toLowerCase());
    });
    function verify_brand_uniqueness(){
        let brand_name=$('.brand_name').val(); 
        @if(!empty($brand))
            let prev_brand_id='{{$brand->id}}';
        @else
            let prev_brand_id='';
        @endif
        $.ajax({
            url: "{{route('unique-brand')}}",
            type: 'POST',
            data: {prev_brand_id:prev_brand_id,brand_name:brand_name,"_token": "{{ csrf_token() }}" },
        })
        .done(function(res) {
            if(res.status==1){
               verifyBrandUnique=false;
                $('#brand_name-error').remove();
                $('input[name=brand_name]').closest('.form-group').removeClass('has-error').addClass('has-success');
                $('input[name=brand_name]').after('<label id="brand_name-error" class="error" for="brand_name">Brand name already exist.</label>');
                $('input[name=brand_name]').closest('.form-group').addClass('has-error');
            }else{
                if(verifyBrandUnique==false){
                    if($('#brand_name-error').text()=='Brand name already exist.'){
                        $('#brand_name-error').remove();
                        $('input[name=brand_name]').closest('.form-group').removeClass('has-error');
                    }
                }
                verifyBrandUnique=true;
            }
        })
    }

</script>