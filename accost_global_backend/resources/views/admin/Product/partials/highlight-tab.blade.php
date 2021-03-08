<div class="tab-pane wizard-container" id="highlight" role="tabpanel" ariarequired-labelledby="highlight-tab">
    <h3 style="margin: 10px;" class="text-left"><b>Product highlights:</b></h3>
    <form id="product_highlight" method="POST" action="">
        @csrf
        <div class="form-group form-show-validation">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Highlights</label>
                    <div class="form-group">
                        <div class="form-group form-control form-show-validation no_highlight">
                            <span class="required-label">No highlights Found. Please add a product in 'General' tab to show highlights.</span>
                        </div>
                        <div class="col-md-12 col-sm-10" id="highlight_html">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary other_tabs" disabled><span class="btnrequired-label"><i
                            class="fas fa-save" ></i></span> Save & Continue</button>
            <a href="{{ route('product-list') }}" class="btn btn-danger text-white"><span class="btnrequired-label"><i class="fas fa-list"></i></span> Back to List </a>
        </div>
    </form>
</div>