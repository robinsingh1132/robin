@php
if(empty($checked1))
$checked1='';
if(empty($checked2))
$checked2='';
if(empty($value))
$value='';
if(empty($border))
$border='';
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  " id="size-tab" data-toggle="tab" href="#size" role="tab" aria-controls="size" aria-selected="false">Size</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="highlight-tab" data-toggle="tab" href="#highlight" role="tab" aria-controls="attributes" aria-selected="false">Highlights</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="rel-products-tab" data-toggle="tab" href="#rel-products" role="tab" aria-controls="rel-products" aria-selected="false">Related Products</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
    </li>
</ul>
<div class="tab-content">
    @include('admin.Product.edit.partials.edit-general-tab')
    @include('admin.Product.edit.partials.edit-size-tab')
    @include('admin.Product.edit.partials.edit-highlight-tab')
    @include('admin.Product.edit.partials.edit-rel-product-tab')
    @include('admin.Product.edit.partials.edit-seo-tab')
    @include('admin.Product.edit.partials.edit-images-tab')
</div>