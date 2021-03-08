<script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"> </script>
<script src="{{ asset('admin/js/treeview/bootstrap-treeview.js') }}"></script>
<script>
    /*Add coupon form validation*/
    $("#discount-coupon-validate").validate({
        validClass: "success",
        rules: {
            coupon_type: {
                required:true,
            },
            coupon_available_on: {
                required: !0,
            },
            name: {
                required: !0,
                minlength: 1,
                maxlength: 25,
            },
            coupon_code: {
                required: !0,                
                alphaNumericRegex: true,
                minlength: 1,
                maxlength: 25,
            },
            coupon_description: {
                required: !0,
            },
            value: {                                
                numericRegex: true,
                required: !0,
                minlength: 1,
                maxlength: 5,
            },
            currency: {
                required: !0,
                alphaRegex: true,
            },
            duration: {
                required: !0,
                alphaRegex: true,
            },
            minimum_quantity: {
                required: !0,
                minlength: 1,
                maxlength: 4,
                numericRegex: true,
                qtyCheck: true,
            },
            maximum_quantity: {
                required: !0,
                minlength: 1,
                maxlength:4,
                numericRegex: true,
                qtyCheck: true,
            },
            maximum_redemption: { 
                numericRegex: true,
                maxlength: 3,
            },
            start_date: {
                required: true,                
            },
        },
        messages: {
            coupon_type: {
                required: 'Enter Coupon  Type.'
            },
            coupon_available_on: {
                required: 'Enter Coupon Available On.'
            },
            name: {
                required: 'Enter coupon name.',
                alphaNumericRegex: 'Name must be alphnumberic value like: welcome300,blankspace not allowed & contain 6 to 10 letters.'
            },  
            
            coupon_code: {
                required: 'Enter coupon code.Its must be unique.',
                alphaNumericRegex: 'coupon Code must be alphnumberic value like: welcome300, blankspace not allowed & contain 6 to 10 letters.'
            },
            coupon_description: {
                required: 'Enter coupon description.'
            },
            value: {
                required: 'Enter value.'
            },
            currency: {
                required: 'Enter currency.'
            },
            duration: {
                required: 'Enter duration.'
            },
            minimum_quantity: {
                required: 'Enter minimum quantity.',
                qtyCheck: 'Minimum quantity should be less than or equal to maximum quantity.'
            },
            maximum_quantity: {
                required: 'Enter maximum quantity.',
                qtyCheck: 'Maximum quantity should be greater than or equal to minimum quantity.'
            },
            maximum_redemption: {
                required: 'Enter maximum redemption.'
            },
            start_date: {
                required: 'Select start date.',
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },        
    }); 
    /*edit coupon form validation*/
    $("#discount-coupon-validate_edit").validate({
        validClass: "success",
        rules: {
            coupon_type: {
                required:true,
            },
            coupon_available_on: {
                required: !0,
            },
            name: {
                required: !0,
                minlength: 1,
                maxlength: 25,
            },
            coupon_code: {
                required: !0,                
                alphaNumericRegex: true,
                minlength: 1,
                maxlength: 25,
            },
            coupon_description: {
                required: !0,
            },
            value: {                                
                numericRegex: true,
                required: !0,
                minlength: 1,
                maxlength: 5,
            },
            currency: {
                required: !0,
                alphaRegex: true,
            },
            duration: {
                required: !0,
                alphaRegex: true,
            },
            minimum_quantity: {
                required: !0,
                minlength: 1,
                maxlength: 4,
                numericRegex: true,
                qtyCheck: true,
            },
            maximum_quantity: {
                required: !0,
                minlength: 1,
                maxlength:4,
                numericRegex: true,
                qtyCheck: true,
            },
            maximum_redemption: { 
                numericRegex: true,
                maxlength: 3,
            },
            start_date: {
                required: true,
                startDate:true,
                startDatePast:true,              
            },
            end_date: {
                endDate:true
            }
        },
        messages: {
            coupon_type: {
                required: 'Enter Coupon  Type.'
            },
            coupon_available_on: {
                required: 'Enter Coupon Available On.'
            },
            name: {
                required: 'Enter coupon name.',
                alphaNumericRegex: 'Name must be alphnumberic value like: welcome300,blankspace not allowed & contain 6 to 10 letters.'
            },  
            
            coupon_code: {
                required: 'Enter coupon code.Its must be unique.',
                alphaNumericRegex: 'coupon Code must be alphnumberic value like: welcome300, blankspace not allowed & contain 6 to 10 letters.'
            },
            coupon_description: {
                required: 'Enter coupon description.'
            },
            value: {
                required: 'Enter value.'
            },
            currency: {
                required: 'Enter currency.'
            },
            duration: {
                required: 'Enter duration.'
            },
            minimum_quantity: {
                required: 'Enter minimum quantity.',
                qtyCheck: 'Minimum quantity should be less than or equal to maximum quantity.'
            },
            maximum_quantity: {
                required: 'Enter maximum quantity.',
                qtyCheck: 'Maximum quantity should be greater than or equal to minimum quantity.',
            },
            maximum_redemption: {
                required: 'Enter maximum redemption.',
            },
            start_date: {
                required: 'Select start date.',
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },        
    });
    /*sumernote */
    
    $('#summernote').summernote({
        placeholder: 'Enter Coupon Description',
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        tabsize: 2,
        height: 200,
        maxTextLength: 500
    });
/*additional validation methods for coupon form */    
    jQuery.validator.addMethod("numericWithHyphenRegex", function(value, element) {
        return this.optional(element) || /^[0-9]+(?:-[0-9]+)+$/gim.test(value);
    }, "This field must contain only numbers & hyphen.");

    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]*$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");
    $.validator.addMethod("qtyCheck", function (value, element, param) {
        return qtyCheck;
    },"Maximum quantity should be greater than minimum quantity.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[^\s][0-9]*$/i.test(value);
    }, "This field must contain only numbers. Blank space not allowed");
    $.validator.addMethod("startDatePast", function (value, element, param) {
        return startDatePast;
    },"Start date is past date its not allowed.");
    $.validator.addMethod("endDatePast", function (value, element, param) {
        return startDatePast;
    },"End date is past date its not allowed.");
    $.validator.addMethod("startDate", function(value, element) {
        value=value.split("/").reverse().join("-");
        var endDate = $('.endDate').val();
        endDate = endDate.split("/").reverse().join("-");
        if(endDate==''){
            return true;
        }
        if(Date.parse(endDate) >=Date.parse(value)){
            return true;
        }
        if(Date.parse(endDate)<=Date.parse(value)){
            return false;
        }
        return Date.parse(endDate) >= Date.parse(value);
    }, "* start date must be before end date");
    $.validator.addMethod("endDate", function(value, element) {
        value=value.split("/").reverse().join("-");
        var startDate = $('.startDate').val();
        startDate = startDate.split("/").reverse().join("-");
        if(startDate==''){
            return false;
        }
        return Date.parse(startDate) <= Date.parse(value);
    }, "* End date must be after start date");
</script>
