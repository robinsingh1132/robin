<?php

namespace App\Lib\Validators;

class HomeBannerValidators
{
    const HOME_BANNER = [
        'name' => 'required',
        'image_link' => ['required','image','mimes:jpeg,png,jpg,gif','dimensions:max_width=1600,max_height=400,min_width=1590,min_height=390'],
        'image_alt' => 'required',
        'url'=>'required|url',
        'position'=>'required',
        'status' => 'required|boolean'
    ];
    const HOME_BANNER_MSG = [
        'image_link.required' => 'Please upload Banner Image.',       
    ];

    const UPDATE_HOME_BANNER = [
        'name' => 'required',
        'image_link' => ['image','mimes:jpeg,png,jpg,gif','dimensions:max_width=1600,max_height=400,min_width=1590,min_height=390'],
        'image_alt' => 'required',
        'url'=>'required|url',
        'position'=>'required',
        'status' => 'required|boolean'
    ];
   /* const UPDATE_HOME_BANNER_MSG = [
        'image_link.required' => 'Please upload Banner Image.',
    ];*/

}
