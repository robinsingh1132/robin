<script>
    var verifyTax = true;
    $("#frm-taxes").validate({
        validClass: "success",
        rules: {
            country: {
                required: !0,
                maxlength : 150,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            state: {
                required: !0,
                maxlength : 150,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            product_type: {
                required: !0,
                maxlength : 150,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },            
            tax: {
                required: !0,
                max : 100,
                verifyTaxes:true,
            }
        },
        messages: {
            country: {
                required: 'Please select country.'
            },
            state: {
                required: 'Please select state.'
            },
            product_type: {
                required: 'Please select product type.'
            },            
            tax: {
                required: 'Please enter tax.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    jQuery.validator.addMethod("numericWithCommaRegex", function(value, element) {
        return this.optional(element) || /^[0-9]+(?:,[0-9]+)+$/gim.test(value);
    }, "This field must contain only numbers & comma separated Ex: 123451, 678902.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
    jQuery.validator.addMethod("verifyTaxes", function(value, element) {
        console.log(verifyTax);
        return verifyTax;
    }, "Tax already exist for selected product type,country and state.");

    /*$(document).ready(function(){
        $('#zipcode').on('keyup', function(){
            $(this).val($(this).val().split(" ").join(",").toLowerCase());
        });
    });*/
    $(document).on('change', '.verifyTax', function(event) {
        event.preventDefault();
        verify_tax();
    });
    
    function verify_tax(){
        let productType=$('#prod-type').val();
        let country=$('#tax-country').val();
        let state=$('#tax-state').val();
        @if(!empty($tax))
            let prev_tax_id='{{$tax->id}}';
        @else
            let prev_tax_id='';
        @endif
        $.ajax({
            url: "{{route('verify-taxes')}}",
            type: 'POST',
            data: {prev_tax_id:prev_tax_id,productType:productType,country:country,state:state ,"_token": "{{ csrf_token()}}" },
        })
        .done(function(res) {
            if(res.status==1){
               verifyTax=false;
                $('#tax-error').remove();
                $('input[name=tax]').closest('.form-group').removeClass('has-error').addClass('has-success');
               $('input[name=tax]').after('<label id="tax-error" class="error" for="tax">Tax already exist for selected product type,country and state.</label>');
               $('input[name=tax]').closest('.form-group').addClass('has-error');
            }else{
                if(verifyTax==false){
                    if($('#tax-error').text()=='Tax already exist for selected product type,country and state.'){
                        $('#tax-error').remove();
                        $('input[name=tax]').closest('.form-group').removeClass('has-error');
                    }
                    
                }
               verifyTax=true;
            }
        })
    }
    $("select[name='country']").change(function(){
        var country_id = $(this).val();
        var url = $(this).attr('data-action');
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            method: 'GET',
            data: {country_id : country_id, _token:token},
            success: function(data) {
                $("select[name='state']").empty();
                $("select[name='state']").append('<option value="">Select State</option>');
                $.each(data,function(key,value){
                    $("select[name='state']").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
                @if(!empty($tax))
                    $("select[name='state']").val('{{$tax->state_id}}');
                @endif
            },
            error: function (error) {
                alert(error.responseJSON);
                return false;
            }
        });
    });
    $("select[name='country']").trigger('change');
        
</script>