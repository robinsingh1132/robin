<?php
namespace App\Lib\Validators;

class TaxesValidation
{
    const TAX_ADD = [
        'country' => 'required|integer',
        'state' => 'required|integer',
        'tax' => 'required|numeric'
    ];
}