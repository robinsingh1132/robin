<?php

namespace App\Lib\Validators;

class ProductCategoryValidators
{
    const PRODUCT_SUPER_CATEGORY = [
        'name' => 'required|unique:product_super_categories|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean',
        'icon' => 'image|mimes:jpeg,png,jpg|max:4096'
    ];
    const UPDATE_PRODUCT_SUPER_CATEGORY = [
        'name' => 'required|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean',
        'icon' => 'image|mimes:jpeg,png,jpg|max:4096'
    ];

    const PRODUCT_CATEGORY = [
        'name' => 'required|unique:product_categories|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean',
        'icon' => 'image|mimes:jpeg,png,jpg|max:4096'
    ];
    const UPDATE_PRODUCT_CATEGORY = [
        'name' => 'required|max:256',
        'slug' => 'required',
        'is_featured' => 'required|boolean',
        'status' => 'required|boolean',
        'icon' => 'image|mimes:jpeg,png,jpg|max:4096'
    ];
}