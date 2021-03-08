<?php

namespace App\Lib\Validators;

class ProductTypeValidator
{
    const SAVE_PRODUCT_TYPE = [
        'type' => 'required|string',
        'default_tax' => 'required|numeric'
    ];
}