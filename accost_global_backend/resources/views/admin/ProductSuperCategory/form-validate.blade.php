<script>
    //add "-" symbol in slug value
    $(document).ready(function(){
        $('#slug').on('keyup', function(){
           $(this).val($(this).val().split(" ").join("-").toLowerCase());
        });
    });
    /*product super category form validation */
    $("#frm-pro-cate").validate({
        validClass: "success",
        rules: {
            name: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                alphaNumericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            slug: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                //alphaNumericWithHyphenRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            page_title: {
                maxlength: 100
            },
            seo_keywords: {
                maxlength: 100
            },
            seo_description: {
                maxlength: 200
            },
            is_featured: {
                required: !0,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            status: {
                required: !0,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            }
        },
        messages: {
            name: {
                required: 'Enter product category name.'
            },
            slug: {
                required: 'Enter slug for category name'
            },
            is_featured: {
                required: 'Choose the option.'
            },
            status: {
                required: 'Choose the option.'
            }
        },
        /*highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },*/
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*additional validation perform via add method on product supercategory form */
    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
    /*fillup slug value via key up supercategory name*/
    $('.super_category').keyup(function() {
        let super_cat_name= $(this).val();
        $('#slug').val($(this).val().split(" ").join("-").toLowerCase());
        $('#page_title').val(super_cat_name);
    });
</script>