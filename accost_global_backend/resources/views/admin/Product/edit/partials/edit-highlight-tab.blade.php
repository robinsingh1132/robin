<div class="tab-pane" id="highlight" role="tabpanel" ariarequired-labelledby="highlight-tab">
    <h4 style="margin: 10px;" class="text-danger text-center"> <b>Add Product highlights Values</b> </h4>
    <form id="product_highlight" method="POST" action="{{route('product-save-highlight',$product->id)}}">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12">
                    <label>Highlights</label>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-10" id="highlight_html">

                            @if(count($product->productHighlight)>0)
                                @foreach($product->productHighlight as $highlight)
                                    <div class="form-group form-control form-show-validation">
                                        <label for="name"> {{$highlight->highlight_name}}</label>
                                        <input type="text" class="form-control" name="highlight_{{$highlight->highlight_id}}" placeholder="Enter {{$highlight->highlight_name}}" autocomplete="off" value="{{$highlight->highlight_value}}" maxlength="50">
                                    </div>
                                @endforeach
                            @else
                                <div class="form-group form-control form-show-validation no_highlight_edit">
                                    <span class="required-label">No highlights is set for this sub category. You can add highlights for this category.<a href="{{route('new-highlight')}}">here</a></span>
                                </div>
                            @endif
                        </div>
                    </div>
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