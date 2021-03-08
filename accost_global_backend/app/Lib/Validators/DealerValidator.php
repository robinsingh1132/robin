<?php

namespace App\Lib\Validators;

class DealerValidator
{
    const DEALER_ADD = [
        'first_name' => 'required|max:256|string',
        'last_name' => 'required|max:256|string',
        'email' => 'required|email|max:100',
        'contact_number'=>'required|regex:/^[0-9]{10,15}$/|min:10|max:15',
        'address'=>'required'
    ];
    const DEALER_ADD_IMPORTFILE=[
    	'dealer_file'=>'required|mimes:xls,xlsx'

    ];

}