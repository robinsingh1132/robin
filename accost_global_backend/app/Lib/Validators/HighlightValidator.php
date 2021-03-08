<?php
namespace App\Lib\Validators;

class HighlightValidator
{
    const SAVE_HIGHLIGHT = [
        'name' => 'required|string',
        'selected_subcat' => 'required',
    ];
    const SAVE_HIGHLIGHT_MSG = [
        'selected_subcat.required' => 'Please select atleast one subcategories.',
    ];
    
}