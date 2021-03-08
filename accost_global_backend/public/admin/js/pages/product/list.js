$("select[name='product_super_category']").change(function(){
    var prod_super_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_super_cat_id : prod_super_cat_id, _token:token},
        success: function(data) {
            $("select[name='product_category']").empty();
            $("select[name='product_category']").append('<option value="">Select Category</option>');
            $.each(data,function(key,value){
                $("select[name='product_category']").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

$("select[name='product_category']").change(function(){
    var prod_cat_id = $(this).val();
    var url = $(this).attr('data-action');
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        method: 'GET',
        data: {prod_cat_id : prod_cat_id, _token:token},
        success: function(data) {
            $("select[name='product_sub_category']").empty();
            $("select[name='product_sub_category']").append('<option value="">Select Sub Category</option>');
            $.each(data,function(key,value){
                $("select[name='product_sub_category']").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    });
});

$("#filter-products").validate({
    validClass: "success",
    rules: {
        product_super_category: {
            required: !0,
            normalizer: function(value) {
                return $.trim(value)
            }
        },
        //product_category: {
        //    required: !0,
        //    normalizer: function(value) {
        //        return $.trim(value)
        //    }
        //},
        //product_sub_category: {
        //    required: !0,
        //    normalizer: function(value) {
        //        return $.trim(value)
        //    }
        //}
    },
    messages: {
        product_super_category: {
            required: 'Please select product super category.'
        },
        //product_category: {
        //    required: 'Please select product category.'
        //},
        //product_sub_category: {
        //    required: 'Please select product sub category.'
        //}
    },
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    }
});
