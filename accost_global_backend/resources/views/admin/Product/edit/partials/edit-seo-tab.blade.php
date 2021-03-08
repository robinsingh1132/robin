<div class="tab-pane" id="seo" role="tabpanel" ariarequired-labelledby="seo-tab">
    <h4 style="margin: 10px;" class="text-danger text-center"> <b>Add SEO Details</b> </h4>
    <form id="product_seo" method="POST" action="{{route('save-products-seo',$product->id)}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-show-validation">
                    <label for="page_title"> Page Title <span class="required-label">*</span></label>
                    <input type="text" id="page_title" class="form-control" value="{{ @$product->page_title ?? old('page_title') }}" name="page_title" placeholder="Enter Page Title"  autocomplete="off" >
                </div>
                <div class="form-group form-show-validation">
                    <label for="seo_keywords"> SEO Keyword <span class="required-label">*</span></label>
                    <input type="text" class="form-control" value="{{ @$product->seo_keywords ?? old('seo_keywords') }}" name="seo_keywords" placeholder="Enter SEO Keyword"  autocomplete="off" >
                </div>
                <div class="form-group form-show-validation">
                    <label for="seo_description"> SEO Description <span class="required-label">*</span></label>
                    <input type="text" class="form-control" value="{{ @$product->seo_description ?? old('seo_description') }}" name="seo_description" placeholder="Enter SEO Description"  autocomplete="off" >
                </div>
                <div class="form-group form-show-validation">
                    <label for="product_page_slug"> Product Page Slug <span class="required-label">*</span></label>
                    <input type="text" id="slug" class="form-control" value="{{ @$product->product_page_slug ?? old
                        ('product_page_slug') }}" name="product_page_slug" placeholder="Enter Product Page slug"
                           autocomplete="off" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary other_tabs" ><span class="btnrequired-label"><i
                            class="fas fa-arrow-alt-circle-up" ></i></span> Update & Continue</button>
            <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
        </div>
    </form>
</div>