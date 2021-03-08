
    // modal country save
$(document).ready(function(){
    $('#save-country').on('click',function(){
        var country = $("#country").val();
        if(country == ''){
            $('.countrySuccessMsg').addClass('has-error');
        }else {
            $('.countrySuccessMsg').addClass('has-success');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'POST',
                url: $(this).attr('data-action'),
                data: {
                    country: country
                },
                success: function (data) {
                    $("#country").val('');
                    $("#country").hide();
                    $(".countrySuccessMsg").html(data).addClass('text-success');
                    setTimeout(function() { $('#addCountry').modal('hide'); }, 2000);
                    location.reload(true);
                },
                error: function(error) {
                    console.log(error);
                    $("#country").val('');
                    $("#country").hide();
                    $(".countrySuccessMsg").html(error.responseJSON).addClass('text-danger');
                    setTimeout(function() { $('#addCountry').modal('hide'); }, 100000);
                    location.reload(true);
                }
            });
        }
    });
});

    // modal state save
$(document).ready(function(){
    $('#save-state').on('click',function(){
        var state = $("#state").val();
        var country = $("#popup-country").val();
        if(country == ''){
            $('.contSuccessMsg').addClass('has-error');
        }else if (state == ''){
            $('.stateSuccessMsg').addClass('has-error');
        }else {
            $('.contSuccessMsg').addClass('has-success');
            $('.stateSuccessMsg').addClass('has-success');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'POST',
                url: $(this).attr('data-action'),
                data: {
                    state: state,
                    country_id : country
                },
                success: function (data) {
                    $("#state").val('');
                    $("#state").hide();
                    $("#popup-country").hide();
                    $(".modal-body").html(data).addClass('text-success');
                    setTimeout(function () {
                        location.reload(true);
//                                $('#addState').modal('hide');
                    }, 2000);
                },
                error: function (error) {
                    $("#state").val('');
                    $("#popup-country").hide();
                    $(".modal-body").html(error.responseJSON).addClass('text-danger');
                    setTimeout(function(){
                        location.reload(true);
                    }, 2000);
                    return false;
                }
            });
        }
    });
});