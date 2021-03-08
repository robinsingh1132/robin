<?php

namespace App\Lib\Validators;

class ProductSubcategoryValidators
{
    const PRODUCT_SUBCATEGORY = [
        'product_category_id' => 'required|integer',
        'name' => 'required|unique:product_subcategories|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean'
    ];
    const UPDATE_PRODUCT_SUBCATEGORY = [
        'product_category_id' => 'required|integer',
        'name' => 'required|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean'
    ];
}