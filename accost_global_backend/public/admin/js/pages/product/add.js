// bootstrap multi select
$('#prod-attr,#prod-sup-cat, #prod-cat, #prod-sub-cat,#product-type').select2({
    theme: "bootstrap"
});

//
$(document).on('change','.prodAttr',function() {
    var attrName = $(this).val();
    if(attrName){
        $.ajax({
            type: 'GET',
            url: $(this).attr('data-action'),
            data: {attrName: attrName},
            success: function (data){
                //console.log(data);
                $('#attr-data').html('');
                $.each(data, function(key,value) {
                    var required_field = (value.attribute.is_required ==  1 ) ? '<span class="required-label">*</span>'  :   '';
                    if(value.attribute.attribute_type.type == 'Text'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field+ '</label> <input type=\"text\" class="form-control" name=\"' + value.attribute.name + '\" required/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Text Area'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field +'</label> <textarea class="form-control" name=\"' + value.attribute.name + '\" required/></textarea> </div>');
                    }else if(value.attribute.attribute_type.type == 'Date'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field +'</label> <input type=\"date\" class="form-control" name=\"' + value.attribute.name + '\" required/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Yes/No'){
                        $('#attr-data').append('<div class="form-check">' +
                            '<label>'+ value.attribute.name + required_field +'</label><br>' +
                                '<label class="form-radiorequired-label">' +
                                    '<input type=\"radio\" value=\"1\" class="form-radio-input" name=\"' + value.attribute.name + "\" required/>" +
                                    '<span class="form-radio-sign">Yes</span>' +
                                '</label>' +
                                '<label class="form-radiorequired-label ml-3">' +
                                    '<input type=\"radio\" value=\"1\" class="form-radio-input" name=\"' + value.attribute.name + "\" required/>" +
                                    '<span class="form-radio-sign">No</span>' +
                                '</label>' +
                            '</div>');
                    }else if(value.attribute.attribute_type.type == 'Number'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field +'</label> <input type=\"number\" min="1" maxlength="6" class="form-control" name=\"' + value.attribute.name + '\" required/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Checkbox'){
                        $('#attr-data').append('<div class="form-check">' +
                            '<label>'+ value.attribute.name + required_field +'</label><br>' +
                            '<div class="custom-control custom-checkbox">' +
                                    '<input type=\"checkbox\"  class="custom-control-input" id="customCheck1" name=\"' + value.attribute.name + "\" />" +
                                    '<label class="custom-control-label" for="customCheck1">Women</label>' +
                                '</div>' +
                                '<div class="custom-control custom-checkbox">' +
                                    '<input type=\"checkbox\" class="custom-control-input" id="customCheck2" name=\"' + value.attribute.name + "\" />" +
                                    '<label class="custom-control-label" for="customCheck2">Men</label>' +
                                '</div>' +
                            '</div>');
                    }else if(value.attribute.attribute_type.type == 'File'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field +'</label> <input type=\"file\" class="form-control" name=\"' + value.attribute.name + '\" required/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Url'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + required_field +'</label> <input type=\"url\" class="form-control" name=\"' + value.attribute.name + '\" required/> </div>');
                    }
                });
            },
            error: function(e) {
                alert(e);
                //console.log(e);
            }
        });
    }
});


//multiple image upload via dropzone
Dropzone.options.dropzone =
{
    maxFilesize: 12,
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png",
    addRemoveLinks: true,
    timeout: 50000,
    removedfile: function(file)
    {
        var name = file.upload.filename;
        var url = $('#dropzone').attr('data-action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: {filename: name},
            success: function (data){
                alert(data.error);
                //                    console.log("File has been successfully removed!!");
            },
            error: function(e) {
                alert(e);
                //console.log(e);
            }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },

    success: function(file, response)
    {
        alert(response.error);
        //            console.log(response);
        //            $("#pro-img").show();
        //            $('#pro-img').addClass('text-danger');
        //            $("#pro-img").text(response.error);
    },
    error: function(file, response)
    {
        return false;
    }
};

$("select[name='product_super_category[]']").change(function(){
    var prod_super_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_super_cat_id : prod_super_cat_id, _token:token},
        success: function(data) {
            $("select[name='product_category[]']").empty();
            $("select[name='product_category[]']").append('<option>Select Category</option>');
            $.each(data,function(key,value){
                $("select[name='product_category[]']").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

$("select[name='product_category[]']").change(function(){
    var prod_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_cat_id : prod_cat_id, _token:token},
        success: function(data) {
            $("select[name='product_sub_category[]']").empty();
            $("select[name='product_sub_category[]']").append('<option>Select Sub Category</option>');
            $.each(data,function(key,value){
                $("select[name='product_sub_category[]']").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

