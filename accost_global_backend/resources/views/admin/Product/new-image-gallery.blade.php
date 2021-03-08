@if(count($product_images)>0)
    <h3 class="">Uploaded Images</h3><br>
    <div class="row ml-3">
    <?php if(empty($class)){$class='';}?>
    @foreach($product_images as $image)
    @if($image->is_header==1)
        <div class="column header_img_border" >
    @else
        <div class="column" >
    @endif        
            <div class="form-control" id="imgDiv">
                <img src="{{ asset('images/product/'.$image->image) }}" alt="{{$image->image}}" width="120px" height="120px">
            </div>
            <div class="form-control" style="text-align: center;">
                <a class=" btn set_primary_image mr-1" data-link="{{ url('admin/catalog/product/image/primary-image/'
                .$image->product_id.'/'.$image->id)}}" data-toggle="tooltip" title="Set As Primary"><i class="fas fa fa-award"></i></a>
                <a class=" btn delete_images" data-link="{{ url('admin/catalog/product/image/delete/'
                .$image->product_id.'/'.$image->id)}}" data-toggle="tooltip" title="Delete Image"><i class="fas fa fa-trash"></i></a>
            </div>
        </div>&nbsp &nbsp &nbsp
    @endforeach
    </div>    
@endif
