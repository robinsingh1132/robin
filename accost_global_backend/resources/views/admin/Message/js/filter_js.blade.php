<script>
	/*validation of to date and from date*/
    $(document).on('change', '.toDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);
        var toDate=new Date($('.toDate').val());
        var fromDate=new Date($('.fromDate').val());

        if(toDate && fromDate ){
            if(toDate > today){
                toDateFuture=false;
                return toDateFuture;
            }else if(startDate<=today){
                toDateFuture=true;
                return toDateFuture;
            }else if(toDate == today){
                toDateFuture=true;
                return toDateFuture;
            }else{
                toDateFuture=true;
                return toDateFuture;
            }
        } 
        if(toDate==true){
            $('.toDate').removeClass('has-error').addClass('has-success');
            $('.toDate').parent().removeClass('has-error');
            $('#to_date-error').text('');
        }
        if(toDateFuture==true){
            $('.toDate').removeClass('has-error').addClass('has-success');
            $('.toDate').parent().removeClass('has-error');
            $('#to_date-error').text('');
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
    /* validation perform at th time of onchange    */
    $(document).on('change', '.endDate', function(event) {
        var d=new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
        var today =new Date(output);
        var startDate=new Date($('.startDate').val());
        var endDate=new Date($('.endDate').val());
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
</script>