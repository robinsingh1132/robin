<script>
    var _URL = window.URL || window.webkitURL;
    $("#image_link").change(function(e) {
            var image, file;
            var html='';
            html+= '<label id="image_link-error" class="error image_new_error" for="image_link"></label>';
        if(this.files[0].size > 2000000) {            
           //alert('size is lareger');
            $(this).parent().addClass('has-error');
            $(this).after(html);
            $('.image_new_error').text("Image Size is greater than 2mb not allowed.");
            $(this).val = '';
            return;
        }else{
            $(this).parent().removeClass('has-error');
            $('.image_new_error').remove();
        }
        if ((file = this.files[0])) {
            image = new Image();
            image.onload = function () {
                if(this.width > 1600) {             
                    $('#image_link').parent().addClass('has-error');
                    $('#image_link').after(html);
                    $('.image_new_error').text("Image Width is larger than required size. Plase uploaded image file size is: 1600*400px.");
                    $(this).val = '';                    
                    return false;
                }else if(this.height > 400){
                    $('#image_link').parent().addClass('has-error');
                    $('#image_link').after(html);
                    $('.image_new_error').text("Image Height is larger than required size. Plase uploaded image file size is: 1600*400px.");
                    $(this).val = '';                    
                    return false;
                }else if(this.width < 1590){
                    $('#image_link').parent().addClass('has-error');
                    $('#image_link').after(html);
                    $('.image_new_error').text("Image Width is Less than required size. Plase uploaded image file size is: 1600*400px.");
                    $(this).val = '';                    
                    return false;
                }else if(this.height < 390){
                    $('#image_link').parent().addClass('has-error');
                    $('#image_link').after(html);
                    $('.image_new_error').text("Image Height is Less than required size. Plase uploaded image file size is: 1600*400px.");
                    $(this).val = '';                    
                    return false;
                }
                else{
                    $('#image_link').parent().removeClass('has-error');
                    $('.image_new_error').remove();
                    return true;

                }
            };
            image.src = _URL.createObjectURL(file);
        }
    });
    $("#mobile_image_link").change(function(e) {
        var image, file;
        var html='';
        html+= '<label id="image_link-error" class="error image_new_error" for="image_link"></label>';
        if(this.files[0].size > 2000000) {
            //alert('size is lareger');
            $(this).parent().addClass('has-error');
            $(this).after(html);
            $('.image_new_error').text("Image Size is greater than 2mb not allowed.");
            $(this).val = '';
            return;
        }else{
            $(this).parent().removeClass('has-error');
            $('.image_new_error').remove();
        }
        if ((file = this.files[0])) {
            image = new Image();
            image.onload = function () {
                if(this.width > 645) {
                    $('#mobile_image_link').parent().addClass('has-error');
                    $('#mobile_image_link').after(html);
                    $('.image_new_error').text("Image Width is larger than required size. Plase uploaded image file size is: 640*345px.");
                    $(this).val = '';
                    return false;
                }else if(this.height > 350){
                    $('#mobile_image_link').parent().addClass('has-error');
                    $('#mobile_image_link').after(html);
                    $('.image_new_error').text("Image Height is larger than required size. Plase uploaded image file size is: 640*345px.");
                    $(this).val = '';
                    return false;
                }else if(this.width < 620){
                    $('#mobile_image_link').parent().addClass('has-error');
                    $('#mobile_image_link').after(html);
                    $('.image_new_error').text("Image Width is Less than required size. Plase uploaded image file size is: 640*345px.");
                    $(this).val = '';
                    return false;
                }else if(this.height < 335){
                    $('#mobile_image_link').parent().addClass('has-error');
                    $('#mobile_image_link').after(html);
                    $('.image_new_error').text("Image Height is Less than required size. Plase uploaded image file size is: 640*345px.");
                    $(this).val = '';
                    return false;
                }
                else{
                    $('#mobile_image_link').parent().removeClass('has-error');
                    $('.image_new_error').remove();
                    return true;

                }
            };
            image.src = _URL.createObjectURL(file);
        }
    });
    $("#frm-home-banner").validate({
        validClass: "success",
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100,
                alphaNumericRegex: true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            image_link: {
                required: true,
                extension: "jpeg|png|jpg|gif",
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            image_alt: {
                required: true,
                minlength: 2,
                maxlength: 200,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            url: {
                required: true,
                url:true,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            position: {
                required:true,
                digits: true,
                //numericRegex: true,
                validPosition:true,
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
                required: 'Enter banner name.'
            },
            image_link: {
                required: 'Choose an image file for banner.',
                extension: 'Only (jpeg,png,jpg,gif) images are allowed to upload.',
                accept: 'Only images are allowed to upload.'
            },
            image_alt: {
                required: 'Enter banner image alt name.'
            },
            position: {
                required: 'Please Choose banner position.'
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
    $("#frm-edit-home-banner").validate({
        validClass: "success",
        rules: {
            name: {
                required: true,
                minlength: 2,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            image_link: {
                required: false,
                extension: "jpeg|png|jpg|gif",
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            image_alt: {
                required: true,
                minlength: 2,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            status: {
                required: !0,
                normalizer: function(value) {
                    return $.trim(value)
                }
            }
        },
        messages: {
            name: {
                required: 'Enter banner name.'
            },
            image_link: {
                extension: 'Only images are allowed to upload',
                accept: 'Only images are allowed to upload'
            },
            image_alt: {
                required: 'Enter banner image alt name.'
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
</script>
<script>
    jQuery.validator.addMethod("alphaNumericRegex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\ \s]+$/i.test(value);
    }, "This field must contain only letters ,numbers & space.");

    jQuery.validator.addMethod("alphaRegex", function(value, element) {
        return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
    }, "This field must contain only letters & space.");

    jQuery.validator.addMethod("numericRegex", function(value, element) {
        return this.optional(element) || /^[0-9\ \s]+$/i.test(value);
    }, "This field must contain only numbers.");
    /*jQuery.validator.addMethod("validPosition", function(value, element) {
        let availablePosition=[];
        @foreach($allPosition as $pos)
            availablePosition.push(parseInt({{$pos}}));
        @endforeach
        console.log(availablePosition.indexOf(parseInt(value)));
        return availablePosition.indexOf(value) == -1 ? true:false;     
    }, "Please enter valid position.");
*/
</script>