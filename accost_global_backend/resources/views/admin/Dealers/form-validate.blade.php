<script>
/*Dealer form validations*/
    $("#dealer-validate").validate({
        validClass: "success",
        rules: {
            first_name: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                alphaRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            last_name: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                alphaRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            contact_number: {
                required: !0,
                minlength:10,
                maxlength:15,             
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            email: {
                required: !0,
                email: true,
                validEmailCheck: true,
                maxlength: 100,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            address: {
                required: !0,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
        },
        messages: {
            first_name: {
                required: 'Enter first name.'
            },
            last_name: {
                required: 'Enter last name.'
            },
            contact_number: {
                required: 'Enter contact number.'
            },
            email: {
                required: 'Enter email.'
            },
            
            address: {
                required: 'Enter address.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
/*additional validation for form*/
    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");

    $.validator.addMethod("validEmailCheck", function (value, element) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        if (value !== '') {
            return pattern.test(value);
        }
        return true;
    }, 'Please enter a valid email address.');
</script>