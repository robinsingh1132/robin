<div class="tab-pane" id="images" role="tabpanel" ariarequired-labelledby="images-tab">
    <h4 style="margin: 10px;" class="text-danger text-center"> <b>Add Product Images</b> </h4>
    <div class="row">
        <div class="col-md-12 ml-auto mr-auto">
            <div class="main-section">
                <form method="post" id="product_image" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group form-show-validation">
                            <label for="tag"> Choose Image (multiple) <span class="required-label">*</span></label>
                            <input type="file" multiple="multiple" style="display: block !important;" class="form-control file-upload" id="product-image" name="product_image[]" placeholder="Choose images" autocomplete="off" height="100px" width="50px" accept="image/png, image/jpeg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group p-image form-show-validation div-img-upload">
                            {{--<img class="img-upload" src="{{ asset('admin/img/no-image.png') }}" height="100" width="50" style="height:150px;width:150px">--}}
                            <img class="img-upload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" height="100" width="50" style="height:0px;width:0px">
                        </div>
                    </div>
                    {{--<div class="form-group form-show-validation">
                        <label for="is_header"> Is Header Image &nbsp &nbsp &nbsp<input type="checkbox" name="is_header"  id="header_image"></label>
                    </div>--}}
                    <div class="form-group " id="show_product_images">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="image-btn" class="btn btn-primary other_tabs" disabled><span class="btnrequired-label"><i class="fas fa-arrow-alt-circle-up" ></i></span> Upload Image</button>
                        <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>