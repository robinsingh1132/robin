
@if(!empty($exist_highlight))
   @foreach($exist_highlight as $highlight)
    <div class="form-group form-show-validation">
        <label for="name"> {{$highlight->highlight_name}}</label>
        <input type="text" class="form-control" name="highlight_{{$highlight->highlight_id}}" placeholder="Enter {{$highlight->highlight_name}}" autocomplete="off" value="{{$highlight->highlight_value}}" maxlength="50">
    </div>
    @endforeach
@endif
@if(!empty($highlights))
    @if(count($highlights)>0)
        @foreach($highlights as $highlight)
            <div class="form-group form-show-validation">
                <label for="name"> {{$highlight->highlight->name}}</label>
                <input type="text" maxlength="50" class="form-control" name="highlight_{{$highlight->highlight->id}}" placeholder="Enter {{
                $highlight->highlight->name}}" autocomplete="off" value="">
            </div>
        @endforeach
    @else
            <div class="form-group form-control form-show-validation no_highlight_add">
                <span class="required-label">No highlights is set for this sub category. You can add highlights for this category.<a href="{{route('new-highlight')}}">here</a></span>
            </div>
    @endif
@endif

