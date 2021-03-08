/* Image upload section start */
$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('.img-upload').attr('src', e.target.result);
                var file_size = input.files[0].size;
                var file_type=input.files[0].type;
                file_type=file_type.split('/');
                file_type=file_type[0];
                if (file_size > 2097152) {
                    $('.btn-primary').attr('disabled', 'disabled');
                    $('#file-upload-error').text('');
                    $('#icon-error').after('<strong id="file-upload-error" class="help-block text-danger">File size must be less than 2MB</strong>');
                    //if($("#file-upload-error").length){
                    //    $('#edit-file-upload').text();
                    //    $('#edit-file-upload').text('File size must be less than 2MB')
                    //}else{
                    //    $('#edit-file-upload').after('<strong id="file-upload-error" class="help-block">File size must be less than 2MB</strong>')
                    //}
                    return false;
                } else {
                    $('#file-upload-error').text('');
                    $('#file-upload').removeAttr('aria-describedby');
                    $('#file-upload').removeClass('help-block');
                    $('.p-image').removeClass('has-error');
                    $('.btn-primary').removeAttr('disabled');
                }
                if (file_type!='image') {
                    $('.btn-primary').attr('disabled', 'disabled');
                    $('#file-upload-error').text('');
                    $('#icon-error').after('<strong id="file-upload-error" class="help-block text-danger">Only Image file is allowed.</strong>');
                    //$('.img-upload').attr("src","url(/admin/img/no-image.png)");
                    return false;
                } else {
                    $('#file-upload-error').text('');
                    $('#file-upload').removeAttr('aria-describedby');
                    $('#file-upload').removeClass('help-block');
                    $('.p-image').removeClass('has-error');
                    $('.btn-primary').removeAttr('disabled');
                }
            };
        }
    };

    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button, .img-upload").on('click', function() {
        $(".file-upload").click();
    });
});

/*Image upload section end */