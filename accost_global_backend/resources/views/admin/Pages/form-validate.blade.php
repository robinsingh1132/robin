<script>
    $("#frm-static-page").validate({
        validClass: "success",
        rules: {
            name: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                alphaRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            slug: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                /*alphaNumericWithHyphenRegex: true,*/
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            page_title: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                alphaRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            description: {
                maxlength: 200
            },
            page_content: {
                maxlength: 500
            },
            meta_keywords: {
                maxlength: 100
            },
            meta_description: {
                maxlength: 100
            }
        },
        messages: {
            name: {
                required: 'Enter page name.'
            },
            slug: {
                required: 'Enter slug.'
            },
            page_title: {
                required: 'Enter page title.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
</script>

<script>
    jQuery.validator.addMethod("alphaNumericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+(?:-[a-z]+)+$/gim.test(value);
    }, "This field must contain only letters, numbers with hyphen.");

    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
</script>
<script>
    $(document).ready(function(){
        $('#slug').on('keyup', function(){
            $(this).val($(this).val().split(" ").join("-").toLowerCase());
        });
    });
</script>