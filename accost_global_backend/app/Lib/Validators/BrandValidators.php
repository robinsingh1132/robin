<?php
namespace App\Lib\Validators;

class BrandValidators
{
    const SAVE_BRAND = [
        'brand_name' => 'required|unique:brands',
        'super_category_id' => 'required',
    ];
    const UPDATE_BRAND = [
        'brand_name' => 'required',
        'super_category_id' => 'required',
    ];
}