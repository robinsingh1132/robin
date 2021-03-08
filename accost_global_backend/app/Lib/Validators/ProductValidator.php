<?php
namespace App\Lib\Validators;

class ProductValidator
{
    const PRODUCT = [
//        'product_super_category' =>  'required',
//        'product_category' =>  'required',
//        'product_sub_category' =>  'required',
        'product_type'  =>  'required',
        'name' => 'required|string|unique:products',
        'sku' => 'required|string',
        'brand_id'=>'required',
        'is_featured' => 'required',
        'is_free_shipping' => 'required',
        'is_review_allowed' => 'required',
    ];
    const UPDATE_PRODUCT = [
//        'product_super_category' =>  'required',
//        'product_category' =>  'required',
//        'product_sub_category' =>  'required',
        'product_type'  =>  'required',
        'brand_id'=>'required',
        'name' => 'required|string',
        'sku' => 'required|string',
        'is_featured' => 'required',
        'is_free_shipping' => 'required',
        'is_review_allowed' => 'required',
    ];
    const PRODUCT_SIZE = [
        'size_1' => 'required',
        'size_price_1' => 'required',        
        'set_1_price_1' => 'required',
        'size_stock_1' => 'required',
    ];
    const SAVE_RELATED_PRODUCT = [
        'related_products'  =>  'required',
    ];
    const PRODUCT_SEO=[
        'page_title' => 'required|string',
        'seo_keywords' => 'required|string',
        'seo_description' => 'required|string',
        'product_page_slug' => 'required|string'
    ];
}
