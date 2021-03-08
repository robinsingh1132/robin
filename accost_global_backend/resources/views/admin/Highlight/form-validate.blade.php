<script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script> 
<script>
    $("#frm-highlight").validate({
        validClass: "success",
        rules: {
            name: {
                required: !0,
                minlength: 2,
                maxlength: 100,
                normalizer: function(value) {
                    return $.trim(value)
                }
            },
            sub_cat_id: {
                required: !0,
            }
        },
        messages: {
            name: {
                required: 'Please enter Highlight label.'
            },
            sub_cat_id: {
                required: 'Please choose subcategories for highlight.'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form){
            checked = $('.sel_sub_cat').length;
            if(!checked) {
                alert("You must check at least one subcategory.");
                return false;
            }else{
                form.submit();
            }
        }
    });
    $('#dt-product-subcat-list').DataTable({
        "info": false,
        "bLengthChange": false,
        "filter": false
    }); 
</script>
