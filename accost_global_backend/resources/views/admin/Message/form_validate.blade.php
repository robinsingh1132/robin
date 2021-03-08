<script>
    //date format
    $('#from_date').datepicker({
        format: 'dd/mm/yyyy',
        endDate:'0',
    });
    $('#to_date').datepicker({
        format: 'dd/mm/yyyy',
        endDate:'0',
    });
    var fromDateFuture=true;
    var toDateFuture=true;
    $.validator.addMethod("fromDateFuture", function (value, element, param) {
        return fromDateFuture;
    },"From date is future date its not allowed.");
    $.validator.addMethod("toDateFuture", function (value, element, param) {
        return toDateFuture;
    },"To date is future date its not allowed.");
    jQuery.validator.addMethod("textvalidation", function(value, element) {
        return this.optional(element) || /^\S[a-zA-Z0-9\ \s,#.-]+$/i.test(value);
    }, "This field contain letters,numbers.");

    // form validation for filter messages popup
    $("#filter-messages").validate({
        validClass: "success",
        rules: {
            product_id: {
                required: !0,
            },
            from_date: {
                required: !0,
                fromDate:true,
                fromDateFuture:true,
            },
            to_date: {
                required: !0,
                toDate:true,
                toDateFuture:true,
            }
        },
        messages: {
            product_id: {
                required: 'Please select product from product list.'
            },
            from_date: {
                required: 'Please enter from date.'
            },
            to_date: {
                required: 'Please enter to date.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
    });
    $.validator.addMethod("fromDate", function(value, element) {
        value=value.split("/").reverse().join("-");
        var toDate = $('.toDate').val();
        toDate = toDate.split("/").reverse().join("-");
        if(toDate==''){
            return true;
        }
        if(Date.parse(toDate) >=Date.parse(value)){
            return true;
        }
        if(Date.parse(toDate)<=Date.parse(value)){
            return false;
        }
        return Date.parse(toDate) >= Date.parse(value);
    }, "* From date must be before To date");
    $.validator.addMethod("toDate", function(value, element) {
        value=value.split("/").reverse().join("-");
        var fromDate = $('.fromDate').val();
        fromDate = fromDate.split("/").reverse().join("-");
        if(fromDate==''){
            return false;
        }
        return Date.parse(fromDate) <= Date.parse(value);
    }, "* To date must be after From date");
    /*future date validation*/
    $(document).on('change', '.fromDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var from = $('.fromDate').val();
        var newfromdate = from.split("/").reverse().join("-");
        var to = $('.toDate').val();
        var newtodate = to.split("/").reverse().join("-");
        var today =new Date(output);
        var fromDate=new Date(newfromdate);
        var toDate=new Date(newtodate);
        if(fromDate && toDate ){
            if(fromDate > today){
                fromDateFuture=false;
                return fromDateFuture;
            }else if(fromDate<=today){
                fromDateFuture=true;
                return fromDateFuture;
            }else if(fromDate == today){
                fromDateFuture=true;
                return fromDateFuture;
            }else{
                fromDateFuture=true;
                return fromDateFuture;
            }
        }
        if(fromDateFuture==true){
            $('.fromDate').removeClass('has-error').addClass('has-success');
            $('.fromDate').parent().removeClass('has-error');
            $('#from_date-error').text('');
        }
        if(toDateFuture==true){
            $('.toDate').removeClass('has-error').addClass('has-success');;
            $('.toDate').parent().removeClass('has-error');
            $('#to_date-error').text('');
        }
    });
    $(document).on('change', '.toDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;       
        var from = $('.fromDate').val();
        var newfromdate = from.split("/").reverse().join("-");
        var to = $('.toDate').val();
        var newtodate = to.split("/").reverse().join("-");
        var today =new Date(output);
        var fromDate=new Date(newfromdate);
        var toDate=new Date(newtodate);     
        if(fromDate && toDate ){
            if(toDate > today){
                toDateFuture=false;
                return toDateFuture;
            }else if(toDate<=today){
                toDateFuture=true;
                return toDateFuture;
            }else if(toDate ==today){
                toDateFuture=true;
                return toDateFuture;
            }
        }
        if(fromDateFuture==true){
            $('.fromDate').removeClass('has-error').addClass('has-success');
            $('.fromDate').parent().removeClass('has-error');
            $('#from_date-error').text('');
        }
        if(toDateFuture==true){
            $('.toDate').removeClass('has-error').addClass('has-success');;
            $('.toDate').parent().removeClass('has-error');
            $('#to_date-error').text('');
        }
    });

    // form validation for mail popup : send message form
    $("#send-message").validate({
        validClass: "success",
        rules: {
            message: {
                required: !0
            }
        },
        messages: {
            message: {
                required: 'Please enter message.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
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
            var textMessage = $('#text-message').val();
            textMessage = textMessage.replace(/\n\r?/g, '<br />');
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: $('#_token').val(),
                    last_msg_id: $('#last_msg_id').val(),
                    message: textMessage
                },
                success: function(data)
                {
                    $('#ajax-loader').hide();
                    $('.close').trigger('click');
                    $(form)[0].reset();
                    window. location. reload();
                },
                error: function(data){
                    $('#ajax-loader').hide();
                }
            });
            return false;
        }
    });
</script>