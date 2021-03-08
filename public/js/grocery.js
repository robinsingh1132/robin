$(document).ready(function($) {

    // Open model  
    $('#btn-add').click(function() {
        $('#btn-save').val("add");
        $('#myForm').trigger("reset");
        $('#formModal').modal('show');
    });

    // CREATE
    $("#btn-save").click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: $('#title').val(),
            description: $('#description').val(),
        };
        var state = $('#btn-save').val();
        var grocery_id = $('#grocery_id').val();

        $.ajax({
            type: 'POST',
            url: 'grocery',
            data: formData,
            dataType: 'json',
            success: function(data) {
                if(data){
                    var grocery = '<tr id="grocery' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                    if (state == "add") {
                        $('#grocery-list').append(grocery);
                    } else {
                        $("#grocery" + grocery_id).replaceWith(grocery);
                    }
                    $('#myForm').trigger("reset");
                    $('#formModal').modal('hide');
                }
                
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});