/*
// bootstrap multi select
$('#prod-attr,#prod-sup-cat, #prod-cat, #prod-sub-cat,#product-type, #rel-prod-sup-cat, #rel-prod-catg, #rel-prod-super-catg').select2({
    theme: "bootstrap"
});
//on page load select
$(document).ready(function() {
    var attrName = $('#prod-attr').val();
    var url = $('#prod-attr').attr('data-action');
    if(attrName){
        $.ajax({
            type: 'GET',
            url: url,
            data: {attrName: attrName},
            success: function (data){
                //console.log(data);
                $('#attr-data').html('');
                $.each(data, function(key,value) {
                    var star = value.attribute.is_required == 1 ? '<span class="required-label">*</span>' : '';
                    var required = value.attribute.is_required == 1 ? 'required' : '';

                    if(value.attribute.attribute_type.type == 'Text'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star + '</label> <input '+ required +' type=\"text\" class="form-control" maxlength="50" value=\"'+ value.attribute.attribute_values.value +'\" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Text Area'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <textarea '+ required +' class="form-control" maxlength="200" name=\"' + value.attribute.name + '\" />' + value.attribute.attribute_values.value +'</textarea> </div>');
                    }else if(value.attribute.attribute_type.type == 'Date'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input '+ required +' type=\"date\" class="form-control" maxlength="10" value=\"'+ value.attribute.attribute_values.value +'\" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Yes/No'){
                        var checked = value.attribute.attribute_values.value == 1 ? 'checked' : '';
                        if(value.attribute.attribute_values.value == 1){
                            $('#attr-data').append('<div class="form-group form-show-validation">' +
                                '<label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2 pl-0">'+ value.attribute.name + star +'</label><br>' +
                                '<div class="col-lg-4 col-md-9 col-sm-8 mt-2 d-flex align-items-center pl-0">' +
                                    '<div class="custom-control custom-radio">' +
                                        '<input checked type="radio" value="1" id="yes" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                        '<label class="custom-control-label" for="yes">Yes</label>' +
                                    '</div>' +
                                    '<div class="custom-control custom-radio">' +
                                        '<input type="radio" value="0" id="no" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                        '<label class="custom-control-label" for="no">No</label>' +
                                    '</div>' +
                                '</div>'+
                            '</div>');
                        }else {
                            $('#attr-data').append('<div class="form-group form-show-validation">' +
                                '<label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2 pl-0">'+ value.attribute.name + star+'</label><br>' +
                                '<div class="col-lg-4 col-md-9 col-sm-8 mt-2 d-flex align-items-center pl-0">' +
                                    '<div class="custom-control custom-radio">' +
                                        '<input type="radio" value="1" id="yes" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                        '<label class="custom-control-label" for="yes">Yes</label>' +
                                    '</div>' +
                                    '<div class="custom-control custom-radio">' +
                                        '<input checked type="radio" value="0" id="no" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                        '<label class="custom-control-label" for="no">No</label>' +
                                    '</div>' +
                                '</div>'+
                            '</div>');
                        }
                    }else if(value.attribute.attribute_type.type == 'Number'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input type=\"number\" class="form-control" min="1" maxlength="6" name=\"' + value.attribute.name + '\" value=\"'+ value.attribute.attribute_values.value +'\" '+ required +'/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Checkbox'){
                        var checked = (value.attribute.attribute_values.value == 'on') ? 'checked' : '';
                        $('#attr-data').append('<div class="form-group form-check">' +
                            '<label>'+ value.attribute.name + star +'</label><br>' +
                            '<div class="custom-control custom-checkbox">' +
                                '<input '+ required +' type=\"checkbox\" '+checked+' class="custom-control-input" id="customCheck1" name=\"' + value.attribute.name + "\" />" +
                                '<label class="custom-control-label" for="customCheck1">Women</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox">' +
                                '<input '+ required +' type=\"checkbox\" class="custom-control-input" id="customCheck2" name=\"' + value.attribute.name + "\" required/>" +
                                '<label class="custom-control-label" for="customCheck2">Men</label>' +
                            '</div>' +
                            '</div>');
                    }else if(value.attribute.attribute_type.type == 'File'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input type=\"file\" class="form-control" name=\"' + value.attribute.name + '\" value=\"'+ value.attribute.attribute_values.value +'\" '+ required +'/> </div>');
                    }else if(value.attribute.attribute_type.type == 'Url'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input type=\"url\" maxlength="200" class="form-control" name=\"' + value.attribute.name + '\" value=\"'+ value.attribute.attribute_values.value +'\" '+ required +'/> </div>');
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

//on change select
$(document).on('change','.prodAttr',function() {
    var attrName = $(this).val();
    var url = $(this).attr('data-action');
    if(attrName){
        $.ajax({
            type: 'GET',
            url: url,
            data: {attrName: attrName},
            success: function (data){
                //console.log(data);
                $('#attr-data').html('');
                $.each(data, function(key,value) {
                    var star = value.attribute.is_required == 1 ? '<span class="required-label">*</span>' : '';
                    var required = value.attribute.is_required == 1 ? 'required' : '';

                    if(value.attribute.attribute_type.type == 'Text'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star + '</label> <input '+ required +' type=\"text\" maxlength="50" class="form-control" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Text Area'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <textarea '+ required +' class="form-control" maxlength="200" name=\"' + value.attribute.name + '\" /></textarea> </div>');
                    }else if(value.attribute.attribute_type.type == 'Date'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input '+ required +' type=\"date\" maxlength="10" class="form-control" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Yes/No'){
                        $('#attr-data').append('<div class="form-group form-show-validation">' +
                            '<label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2 pl-0">'+ value.attribute.name +' '+star+'</label></br>' +
                            '<div class="col-lg-4 col-md-9 col-sm-8 mt-2 d-flex align-items-center pl-0">' +
                                '<div class="custom-control custom-radio">' +
                                    '<input type="radio" value="1" id="yes" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                    '<label class="custom-control-label" for="yes">Yes</label>' +
                                '</div>' +
                                '<div class="custom-control custom-radio">' +
                                    '<input type="radio" value="0" id="no" name="'+ value.attribute.name +'" class="custom-control-input" '+ required +' />' +
                                    '<label class="custom-control-label" for="no">No</label>' +
                                '</div>' +
                            '</div>'+
                        '</div>');
                    }else if(value.attribute.attribute_type.type == 'Number'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input '+ required +' type=\"number\" min="1" maxlength="6" class="form-control" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Checkbox'){
                        $('#attr-data').append('<div class="form-group form-check">' +
                            '<label>'+ value.attribute.name + star +'</label><br>' +
                            '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="custom-control-input" id="customCheck1" name="' + value.attribute.name +'" '+ required +' />' +
                                '<label class="custom-control-label" for="customCheck1">Women</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox">' +
                                '<input type="checkbox" class="custom-control-input" id="customCheck2" name="' + value.attribute.name + '" '+ required +' />' +
                                '<label class="custom-control-label" for="customCheck2">Men</label>' +
                            '</div>' +
                        '</div>');
                    }else if(value.attribute.attribute_type.type == 'File'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input '+ required +' type=\"file\" class="form-control" name=\"' + value.attribute.name + '\" /> </div>');
                    }else if(value.attribute.attribute_type.type == 'Url'){
                        $('#attr-data').append('<div class="form-group form-show-validation"> <label for='+ value.attribute.name +'>' + value.attribute.name + star +'</label> <input '+ required +' type=\"url\" maxlength="200" class="form-control" name=\"' + value.attribute.name + '\" /> </div>');
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
//console.log(window.location);

//image upload via dropzone
Dropzone.autoDiscover = false;
var pId = $('#dropzone').attr('data-id');
$(".dropzone").dropzone({
    addRemoveLinks: true,
    timeout: 50000,
    removedfile: function(file)
    {
        //File remove functionality
        var name = file.name;
        var url = $('#dropzone').attr('data-action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: {filename: name},
            success: function (data){
                console.log('1');
                //console.log("File has been successfully removed!!");
                $(".dz-preview").remove();
                $.ajax({
                    url: 'get/product/images',
                    type: 'get',
                    data: {pId: pId},
                    dataType: 'json',
                    success: function(response){
                        $.each(response, function(key,value) {
                            var mockFile = { name: value.name, size: value.size };
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, value.path);
                            myDropzone.emit("complete", mockFile);
                        });
                    }
                });
            },
            error: function(e) {
                //console.log(e);
            }
        });
    },
    //File get functionality
    init: function() {
        myDropzone = this;
        $.ajax({
            url: 'get/product/images',
            type: 'get',
            data: {pId: pId},
            dataType: 'json',
            success: function(response){
                $.each(response, function(key,value) {
                    var mockFile = { name: value.name, size: value.size };
                    //myDropzone.createThumbnailFromUrl(mockFile, '/images/product/thumbnail/'+value.name);
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);
                });
            }
        });
    }
});

Dropzone.options.dropzone =
{
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png",
    addRemoveLinks: true,
    maxFilesize: 2,
    dictFileTooBig: 'Image is larger than 2MB',
    timeout: 50000,
    removedfile: function(file)
    {
        //Remove file functionality
        var name = file.upload.filename;
        var url = $('#dropzone').attr('data-action');
        //console.log(url);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: {filename: name},
            success: function (data){
                //console.log("File has been successfully removed!!");
            },
            error: function(e) {
                //console.log(e);
            }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },

    success: function(file, response)
    {
        console.log(response);
    },
    error: function(file, response)
    {
        return false;
    }
};
// To add categories to product
$("#prod-sup-cat").change(function(){
    var prod_super_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_super_cat_id : prod_super_cat_id, _token:token},
        success: function(data) {
            $("#prod-cat").empty();
            $("#prod-cat").append('<option disabled>Select Category</option>');
            $.each(data,function(key,value){
                $("#prod-cat").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

$("#prod-cat").change(function(){
    var prod_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_cat_id : prod_cat_id, _token:token},
        success: function(data) {
            $("#prod-sub-cat").empty();
            $("#prod-sub-cat").append('<option disabled>Select Sub Category</option>');
            $.each(data,function(key,value){
                $("#prod-sub-cat").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

// To add related products to  aproduct
$("#rel-prod-super-catg").change(function(){
    var prod_super_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_super_cat_id : prod_super_cat_id, _token:token},
        success: function(data) {
            $("#rel-prod-catg").empty();
            $("#rel-prod-catg").append('<option disabled>Select Category</option>');
            $.each(data,function(key,value){
                $("#rel-prod-catg").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

$("#rel-prod-catg").change(function(){
    var prod_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_cat_id : prod_cat_id, _token:token},
        success: function(data) {
            $("#rel-prod-sup-cat").empty();
            $("#rel-prod-sup-cat").append('<option disabled>Select Sub Category</option>');
            $.each(data,function(key,value){
                $("#rel-prod-sup-cat").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});


$("#rel-prod-sup-cat").change(function() {
    var prod_sub_cat_id = $(this).val();
    var product_id = $(this).attr('data-num');
    console.log(prod_sub_cat_id);
    $.ajax({
        url: $(this).attr('data-action'),
        method: 'GET',
        data: {
            prod_sub_cat_id : prod_sub_cat_id,
            product_id : product_id,
            _token : $("input[name='_token']").val()
        },
        success: function(data) {
            console.log(data);
            $('#related-products-show').html('');
            $.each(data,function(key,value){
                //$('#related-products-show').append('<div class="form-group form-check-inline col-md-5"><label class="form-check-label"><input type="checkbox" class="form-check-input" value="'+value.id+'" name="related_products[]">'+value.name+'<label class="form-check-label ml-5"> Type : '+value.product_type.type+'</label><label class="form-check-label ml-5"> Price : '+value.price+'</label><label class="form-check-label ml-5"> SKU : '+value.sku+'</label></label></div><br>');
                if(value.related_product != null){
                    var checked = product_id == value.related_product.product_id ? 'checked' : '';
                    $('#related-products-show').append('<div class="form-group form-check-inline col-md-5"><label class="form-check-label"><input type="checkbox" class="form-check-input" value="'+value.id+'" name="related_products[]" '+checked+'>'+value.name+'<label class="form-check-label ml-5"> Type : '+value.product_type.type+'</label><label class="form-check-label ml-5"> Price : '+value.price+'</label><label class="form-check-label ml-5"> SKU : '+value.sku+'</label></label></div><br>');
                }else {
                    $('#related-products-show').append('<div class="form-group form-check-inline col-md-5"><label class="form-check-label"><input type="checkbox" class="form-check-input" value="'+value.id+'" name="related_products[]" >'+value.name+'<label class="form-check-label ml-5"> Type : '+value.product_type.type+'</label><label class="form-check-label ml-5"> Price : '+value.price+'</label><label class="form-check-label ml-5"> SKU : '+value.sku+'</label></label></div><br>');
                }
            });
        }
    });
});

//get attributes with checkboxes
$(document).ready(function(){
    var prod_sub_cat_id = $("#rel-prod-sup-cat").val();
    var url = $("#rel-prod-sup-cat").attr('data-action');
    var product_id = $("#rel-prod-sup-cat").attr('data-num');

    //console.log(prod_sub_cat_id);
    //console.log(url);
    //console.log(product_id);
    $.ajax({
        url: url,
        method: 'GET',
        data: {
            prod_sub_cat_id : prod_sub_cat_id,
            product_id : product_id,
            case : 'edit',
            _token : $("input[name='_token']").val()
        },
        success: function(data) {
            //console.log(data);
            $('#related-products-show').html('');
            $.each(data,function(key,value){
                if(value.related_product != null){
                    var checked = product_id == value.related_product.product_id ? 'checked' : '';
                    $('#related-products-show').append('<div class="form-group form-check-inline col-md-5"><label class="form-check-label"><input type="checkbox" class="form-check-input" value="'+value.id+'" name="related_products[]" '+checked+'>'+value.name+'<label class="form-check-label ml-5"> Type : '+value.product_type.type+'</label><label class="form-check-label ml-5"> Price : '+value.price+'</label><label class="form-check-label ml-5"> SKU : '+value.sku+'</label></label></div><br>');
                }else {
                    $('#related-products-show').append('<div class="form-group form-check-inline col-md-5"><label class="form-check-label"><input type="checkbox" class="form-check-input" value="'+value.id+'" name="related_products[]" >'+value.name+'<label class="form-check-label ml-5"> Type : '+value.product_type.type+'</label><label class="form-check-label ml-5"> Price : '+value.price+'</label><label class="form-check-label ml-5"> SKU : '+value.sku+'</label></label></div><br>');
                }
            });
        }
    });
});
*/
