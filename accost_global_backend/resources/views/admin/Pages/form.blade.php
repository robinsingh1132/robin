@csrf
<div class="form-group form-show-validation">
    <label for="name">Name <span class="required-label">*</span></label>
    <input type="text" class="form-control" value="{{ @$static_page->name }}" name="name" placeholder="Page Name">
</div>
<div class="form-group form-show-validation">
    <label for="slug">Slug <span class="required-label">*</span></label>
    <input type="text" id="slug" class="form-control" name="slug" value="{{ @$static_page->slug }}" placeholder="Page Slug">
</div>
<div class="form-group form-show-validation">
    <label for="page_title">Page Title <span class="required-label">*</span></label>
    <input type="text" class="form-control" name="page_title" value="{{ @$static_page->page_title }}" placeholder="Page Title">
</div>
<div class="form-group form-show-validation">
    <label for="description">Page Description</label>
    <textarea rows="5" type="text" class="form-control" id="description" name="description">{{ @$static_page->description }}</textarea>
</div>
<div class="form-group form-show-validation">
    <label for="page_content">Page Content</label>
    <textarea rows="5" type="text" class="form-control" id="page_content" name="page_content">{{ @$static_page->page_content }}</textarea>
</div>
<div class="form-group form-show-validation">
    <label for="meta_keywords">Meta Keywords</label>
    <input type="text" class="form-control" name="meta_keywords" value="{{ @$static_page->meta_keywords }}" placeholder="Keywords">
</div>
<div class="form-group form-show-validation">
    <label for="meta_description">Meta Description</label>
    <textarea rows="5" type="text" class="form-control" id="meta_description" name="meta_description">{{ @$static_page->meta_description }}</textarea>
</div>