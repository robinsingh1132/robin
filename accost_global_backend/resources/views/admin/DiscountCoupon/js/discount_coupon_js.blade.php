<script>
// view page js for disabled all filed for apply coupon page.
    var state='';
    @if(!empty($onlyView) && ($onlyView==1))
        var disableAllCheckedNode=true; 
        state=1;
    @else
        var disableAllCheckedNode=false; 
        state=0; 
    @endif
/*edit page condition for duration value already present*/
    $(document).ready(function($) {
        var duration_value=$('#duration').val();
        if(duration_value=='once'){
            $('#start_date').trigger('changeDate');
            $('.end_date_validation').show(); 
            jQuery.validator.addClassRules("endDate", {
              required: true,
            });                  
        }else if(duration_value=='forever'){
            $('.end_date_validation').hide();
            $('#end_date').val('');
        }        
    });
/*start date and end date validation for on change of duration*/
    $(document).on('change','.date_change',function(event) {
        var duration_value=$(this).val();        
        if(duration_value=='once'){
            $('#start_date').trigger('changeDate');
            $('.end_date_validation').show(); 
            jQuery.validator.addClassRules("endDate", {
              required: true,
            });                  
        }else if(duration_value=='forever'){
            $('.end_date_validation').hide();
            $('#end_date').val('');
        }        
    });
/*apply coupon page give save button for showing form consistancy*/
    $(document).on('click', '.apply_button_save', function(event) {
        event.preventDefault();
        msg_box('Coupon save successfully.','success');
    });
    $(document).on('click', '.apply_button_update', function(event) {
        event.preventDefault();
        msg_box('Coupon update successfully.','success');
    });
    // end
    var uniqueCouponName = true;
    var uniqueCouponCode=true;
    /*Extra conditional coupon form validations*/
    var qtyCheck=true; 
    var startDate=true;
    var endDate=true;
    var startDatePast=true;
    var endDatePast=true;    
/*minimum and miximum value validation*/
    $('.checkNumber').change(function(event) {            
        var maxQty=  parseInt($('#maximum_quantity').val());
        var minQty=  parseInt($('#minimum_quantity').val());
        if(maxQty){
            if(minQty > maxQty){
                qtyCheck=false;
            }else{
                qtyCheck=true;
                $('#maximum_quantity').parent().removeClass('has-error');
                $('#maximum_quantity').parent().removeClass('has-error');
                $('#maximum_quantity-error').text('');
            } 
        }                                   
    });

    /*start date and end date for case of add coupon*/  
    $('#start_date').datepicker({
        format: 'dd/mm/yyyy',
        startDate: new Date()
        }).on('changeDate', function() {        
        $('#end_date').datepicker('setStartDate', $(this).val());
    });
    $('#end_date').datepicker({
        format: 'dd/mm/yyyy',
        startDate: new Date()
    });
    /*validation of start date end date*/
    $(document).on('change', '.startDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);        
        var start = $('.startDate').val();
        var newstartdate = start.split("/").reverse().join("-");
        var end = $('.endDate').val();
        var newenddate = end.split("/").reverse().join("-");
        var startDate=new Date(newstartdate);
        var endDate=new Date(newenddate);

        if(startDate && endDate ){
            if(startDate < today){
                startDatePast=false;
                return startDatePast;
            }else if(startDate>=today){
                startDatePast=true;
                return startDatePast;
            }else if(startDate == today){
                startDatePast=true;
                return startDatePast;
            }else{
                startDatePast=true;
                return startDatePast;
            }
        } 
        if(startDate==true){
            $('.startDate').removeClass('has-error').addClass('has-success');
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(startDatePast==true){
            $('.startDate').removeClass('has-error').addClass('has-success');
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(endDate==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        }
        if(endDatePast==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        }
    });
    $(document).on('change', '.endDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);        
        var start = $('.startDate').val();
        var newstartdate = start.split("/").reverse().join("-");
        var end = $('.endDate').val();
        var newenddate = end.split("/").reverse().join("-");
        var startDate=new Date(newstartdate);
        var endDate=new Date(newenddate);
        if(startDate && endDate ){
            if(endDate < today){
                endDatePast=false;
                return endDatePast;
            }else if(endDate>=today){
                endDatePast=true;
                return endDatePast;
            }else if(endDate ==today){
                endDatePast=true;
                return endDatePast;
            }
        }
        if(endDate==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        }
        if(startDate==true){
            $('.startDate').removeClass('has-error').addClass('has-success');;
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(startDatePast==true){
            $('.startDate').removeClass('has-error').addClass('has-success');
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(endDatePast==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        }
    });
    
/*validation of start date end date on change of duration*/
    $(document).ready(function($) {        
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);        
        var start = $('.startDate').val();
        var newstartdate = start.split("/").reverse().join("-");
        var end = $('.endDate').val();
        var newenddate = end.split("/").reverse().join("-");
        var startDate=new Date(newstartdate);
        var endDate=new Date(newenddate);
        if($('#duration').val()=='once'){
            if(startDate && endDate ){                
                if(startDate < today){
                    startDatePast=false;
                    return startDatePast;
                }else if(startDate>=today){
                    startDatePast=true;
                    return startDatePast;
                }else if(startDate == today){
                    startDatePast=true;
                    return startDatePast;
                }else{
                    startDatePast=true;
                    return startDatePast;
                }
            } 
        }
    });
    $(document).on('change', '#duration', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);        
        var start = $('.startDate').val();
        var newstartdate = start.split("/").reverse().join("-");
        var end = $('.endDate').val();
        var newenddate = end.split("/").reverse().join("-");
        var startDate=new Date(newstartdate);
        var endDate=new Date(newenddate);
        if($('#duration').val()=='once'){
            if(startDate && endDate ){
                if(startDate < today){
                    startDatePast=false;
                    return startDatePast;
                }else if(startDate>=today){
                    startDatePast=true;
                    return startDatePast;
                }
            } 
        }
    });
    $(document).on('change', '#duration', function(event) {
        if(startDatePast==true){
            $('.startDate').removeClass('has-error').addClass('has-success');
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(endDatePast==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        }
    });
    $(document).ready(function($) {
        if(startDatePast==true){
            $('.startDate').removeClass('has-error').addClass('has-success');
            $('.startDate').parent().removeClass('has-error');
            $('#start_date-error').text('');
        }
        if(endDatePast==true){
            $('.endDate').removeClass('has-error').addClass('has-success');;
            $('.endDate').parent().removeClass('has-error');
            $('#end_date-error').text('');
        } 
    }); 
/*switcing on next tab*/
    $(document).on('click', '.coupon_submit', function(event) {
        $('input[name=is_next_tab]').val('1');
        $('.date_change').trigger('change');
    }); 
    @if(!empty($nextTab) && ($nextTab==1))
        $('#apply-coupon-tab').trigger('click');
    @endif
    @if(!empty($onlyView) && ($onlyView==1))
        $('form input').attr('disabled', 'true');
        $('form select').attr('disabled', 'true');
        $('form textarea').attr('disabled', 'true');
        $('form textarea').removeAttr('id');
        $('form textarea').show();
        $('.note-editor').remove();
    @endif
/* unique check on coupon*/   
    $(document).on('change', '.coupon_name', function(event) {
        event.preventDefault();
        check_unique_coupon_name();
    });    
    function check_unique_coupon_name(){
        let coupon_name=$('.coupon_name').val();
        @if(!empty($coupon))
            let prev_coupon_id='{{$coupon->id}}';
        @else
            let prev_coupon_id='';
        @endif
        $.ajax({
            url: "{{route('unique-coupon-name')}}",
            type: 'POST',
            data: {prev_coupon_id:prev_coupon_id,coupon_name:coupon_name,"_token": "{{ csrf_token() }}" },
        })
        .done(function(res) {
            if(res.status==1){
               uniqueCouponName=false;
                $('#name-error').remove();
                $('input[name=name]').closest('.form-group').removeClass('has-error').addClass('has-success');
               $('input[name=name]').after('<label id="name-error" class="error" for="name">Coupon name already exist.</label>');
               $('input[name=name]').closest('.form-group').addClass('has-error');
            }else{
                if(uniqueCouponName==false){
                    if($('#name-error').text()=='Coupon Name already exist.'){
                        $('#name-error').remove();
                        $('input[name=name]').closest('.form-group').removeClass('has-error');
                    }
                }
                uniqueCouponName=true;
            }
        })
    }
/* unique check on coupon code*/
    $(document).on('change', '.coupon_code', function(event) {
        event.preventDefault();
        check_unique_coupon_code();
    });    
    function check_unique_coupon_code(){
        let coupon_code=$('.coupon_code').val();
        @if(!empty($coupon))
            let prev_coupon_id='{{$coupon->id}}';
        @else
            let prev_coupon_id='';
        @endif
        $.ajax({
            url: "{{route('unique-coupon-code')}}",
            type: 'POST',
            data: {prev_coupon_id:prev_coupon_id,coupon_code:coupon_code,"_token": "{{ csrf_token() }}" },
        })
        .done(function(res) {
            if(res.status==1){
               uniqueCouponCode=false;
                $('#coupon_code-error').remove();
                $('input[name=coupon_code]').closest('.form-group').removeClass('has-error').addClass('has-success');
               $('input[name=coupon_code]').after('<label id="name-error" class="error" for="coupon_code">Coupon code already exist.</label>');
               $('input[name=coupon_code]').closest('.form-group').addClass('has-error');
            }else{
                if(uniqueCouponCode==false){
                    if($('#coupon_code-error').text()=='Coupon code already exist.'){
                        $('#coupon_code-error').remove();
                        $('input[name=coupon_code]').closest('.form-group').removeClass('has-error');
                    }
                }
               uniqueCouponCode=true;
            }
        })
    }    
/*product list*/
        $(function() {
            var coupon_id=$('#coupon_id').val();
            var table=$('#dt-product-list').DataTable({
                    processing: true,
                    serverSide: true,
                    search:true,                
                    ajax: '{{ route("list-product") }}/'+coupon_id+'?state='+state,
                    columns: [
                        { data:'action',name:'id',orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                            return data ? "Active" : "Inactive" ;
                        }}
                    ]
                });            
        });
        $(document).on( 'click', '.pro_list',function () {
            var product_id = $(this).val();
            var coupon_id=$('#coupon_id').val();
            if($(this).is(":checked")) { 
                couponAddDelete();
            }else { 
                if(!confirm('Are you sure to remove coupon from this products.')){
                    $(this).prop('checked','true');
                    return false;
                }else{
                    couponAddDelete();
                }
            }
            function couponAddDelete(){            
                $('#ajax-loader').show();
                if(product_id!=''){
                    $.ajax({           
                        type: "POST",       
                        url: "{!! route('add_products') !!}",
                        data: {'product_id' : product_id ,'coupon_id' : coupon_id ,"_token": "{{ csrf_token() }}"},
                        dataType: "text",
                        success: function(response){ 
                            $('#ajax-loader').hide();
                        }        
                    });
                }
            }
        });        
  
/*checkeable tree*/
    @if(!empty($coupon))
        var cat_data ='<?php echo  json_encode($superCatArr) ?>';
        var $checkableTree = '';
        var open_node='';
        var close_node='';
        make_cat_tree(cat_data);
        function make_cat_tree(cat_data){
            $checkableTree=$('#treeview-category').treeview({
                data: cat_data,
                showIcon: false,
                showCheckbox: true,
                disableAllCheckedNode:disableAllCheckedNode,
                onNodeChecked: function(event, node) {
                    let cat=get_value_type(node);
                    save_coupon_cat_ajax(cat);
                    open_node=$checkableTree.treeview('getExpanded');
                    close_node= $checkableTree.treeview('getCollapsed');               
                },
                onNodeUnchecked: function (event, node) {
                    let cat=get_value_type(node);
                    delete_coupon_cat_ajax(cat);
                    open_node=$checkableTree.treeview('getExpanded');
                    close_node= $checkableTree.treeview('getCollapsed');
                }
            });
        }
        function get_value_type(node){
            let check_value=node.href;
            let cat = {type:0,cat_id:0};
            if(check_value.match('superCat')){
                var cat_id=check_value.split('#superCat_');
                cat.cat_id=cat_id[1];
                cat.type=1;
            }
            if(check_value.match('productCat')){
                var cat_id=check_value.split('#productCat_');
                cat.cat_id=cat_id[1];
                cat.type=2;
            }
            if(check_value.match('subCat')){
                var cat_id=check_value.split('#subCat_');
                cat.cat_id=cat_id[1];
                cat.type=3;
            }
            return cat;
        }
        function save_coupon_cat_ajax(cat){
            $.ajax({
                url: "{!! route('save_coupon_categories') !!}",
                type: 'POST',                   
                data: {'cat_id': cat.cat_id,'type':cat.type,'coupon_id':'{{$coupon->id}}',"_token": "{{ csrf_token() }}"},
                beforeSend: function( ) {
                            $('#ajax-loader').show();
                        },
                success: function(res){ 
                    $('#ajax-loader').hide();
                    if(res.status=='success'){
                        make_cat_tree(res.data);
                        open_selected_nodes();
                    }else{
                        msg_box(res.message,'danger');
                    }                      
                },
                error:function(){
                    $('#ajax-loader').hide();
                    alert("network work error");
                    location.reload();
                }
            });
        }
        function delete_coupon_cat_ajax(cat){
            $.ajax({
                url: "{!! route('delete_coupon_categories') !!}",
                type: 'POST',                   
                data: {'cat_id': cat.cat_id,'type':cat.type,'coupon_id':"{{$coupon->id}}","_token": "{{ csrf_token() }}"},
                beforeSend: function( ) {
                            $('#ajax-loader').show();
                        },
                success: function(res){
                    $('#ajax-loader').hide();
                    if(res.status=='success'){
                        make_cat_tree(res.data);
                        open_selected_nodes();
                    }else{
                     msg_box(res.message,'danger');
                    }                     
                },
                error:function(){
                    alert("network work error");
                    location.reload();
                }
            });
        }
        function get_open_nodes(){
            let new_open_node =[];
            $('.node-treeview-category').each(function(index, el) {
                if($(el).children('.fa-minus-square').length==1){
                    new_open_node.push($(el).attr('data-nodeid'));
                }
            });
            open_node=new_open_node;
        }
        function open_selected_nodes(){
             $.each(close_node, function(index, el) {
                $checkableTree.treeview('collapseNode', el.nodeId );
            });
            $.each(open_node, function(index, el) {
                $checkableTree.treeview('expandNode', el.nodeId );
            });        
        }
        function msg_box(mesage,type){
            var msg='<div class="alert alert-'+type+' alert-dismissible fade show" role="alert" style="margin-top:20px">';
            msg+=mesage;
            msg+='<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:-13px;margin-right: 10px;">';
            msg+='<span aria-hidden="true">&times;</span></button></div>';
            $('.js-message').hide();
            $('.js-message').html('');
            $('.js-message').html(msg);
            $('#ajax-loader').show();
            setTimeout(function(){
                    $('.js-message').show();
                    $('#ajax-loader').hide(); 
                        },500);
            setTimeout(function(){$('.js-message').empty(); 
                                    $('.js-message').hide(); 
                        },3000);
        }
    @endif
</script>