<script>
    /* check unique product name*/
    $('.highlight_name').on('change',function(){
        var highlight_name=$(this).val();        
        @if(!empty($highlight))
            let prev_highlight_id='{{$highlight->id}}';
        @else
            let prev_highlight_id='';
        @endif
        $.ajax({
            url: "{{route('unique-highlight-name')}}",
            type: 'POST',
            data: {highlight_name:highlight_name,prev_highlight_id:prev_highlight_id,"_token": "{{ csrf_token() }}" },
        })
        .done(function(res) {
            //console.log(res.message);
            if(res.status=='error'){
                //var html='<p id="name-error-duplicate" class="has-error">Product name already exist.</p>';
                $('.highlight_name').addClass('has-error');
                $('.highlight_name').parent().addClass('has-error');
                $('#name-error').text('Highlight name already exist.');
            }else{
                $('.highlight_name').removeClass('has-error');
                $('.highlight_name').parent().removeClass('has-error');
                $('#name-error').text();
            }
            if(res.status=='success'){
                $('.highlight_name').removeClass('has-error');
                $('.highlight_name').parent().removeClass('has-error');
                $('#name-error').text();
            }
                    
        })
        .fail(function() {
            console.log("error");
        })  
    });
    /*remove uncheked subcategories in subcat array*/
    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    /*add and edit highlight*/
    @if(!empty($highlight_subcat_hidden_ids))
    /*edit highlight js*/
        var selected_subcat=('{{$highlight_subcat_hidden_ids}}').split(',');
        $(document).on('click','.pro_sub_cat_check',function(event) {
            if($(this).prop("checked") == false){
                selected_subcat.remove($(this).val());
            }
            $('.pro_sub_cat_check').each(function(index, el) {
                if($(this).prop("checked") == true){
                    selected_subcat.push($(this).val());
                    selected_subcat=selected_subcat.filter( onlyUnique ); 
                }
            });
           // console.log(selected_subcat);
            $('.sel_sub_cat').val(selected_subcat);
        });
    @else
        /* Add highlight blade js for create a collection of checked array and remove subcat at unchecked*/
        var selected_subcat=[];
        $(document).on('click','.pro_sub_cat_check',function(event) {
            $('.pro_sub_cat_check').each(function(index, el) {
                if($(this).prop("checked") == false){
                    selected_subcat.remove($(this).val());
                }
                if($(this).prop("checked") == true){
                    selected_subcat.push($(this).val());
                    selected_subcat=selected_subcat.filter( onlyUnique ); 
                }
            });
            $('.sel_sub_cat').val(selected_subcat);
        }); 
    @endif    
    /*check only unique subcat*/
    function onlyUnique(value, index, self) { 
        return self.indexOf(value) === index;
    }    
</script>