<script>
    //add "-" symbol into product subcateogry slug
    $(document).ready(function(){
        $('#slug').on('keyup', function(){
            $(this).val($(this).val().split(" ").join("-").toLowerCase());
        });
    });
    /*subcategory form validations*/
    $("#frm-pro-subcate").validate({
        validClass: "success",
        rules: {
            product_category_id: {
                required: !0,
                numericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
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
            product_category_id: {
                required: 'Choose product category name.'
            },
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
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*additional validation on form via addmethod */
    jQuery.validator.addMethod("alphaNumericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+(?:-[a-z]+)+$/gim.test(value);
    }, "This field must contain only letters ,numbers & hyphen.");

    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
    /*fillup slug value via on key up of product subcategory name*/
    $('.product_subcat').keyup(function() {
        let subcat_name= $(this).val();
        $('#slug').val($(this).val().split(" ").join("-").toLowerCase());
        $('#page_title').val(subcat_name);
    });
</script>