<?php

namespace App\Lib\Validators;

class DiscountCouponValidator
{
    const SAVE_COUPON = [
        'coupon_type'        =>  'required',
        'coupon_available_on'=>  'required',
        'name'               =>  array('required','unique:coupons,name'),      
        'coupon_code'        =>  array('required','unique:coupons,coupon_code'),
        'coupon_description' =>  'required',
        'value'              =>  'required',
        'duration'           =>  'required',
        'minimum_quantity'   =>  'required',
        'maximum_quantity'   =>  'required',
        'start_date'         =>  'required',
    ];
    const UPDATE_COUPON = [
        'coupon_type'        =>  'required',
        'coupon_available_on'=>  'required',        
        'name'               =>  array('required'),
        'coupon_code'        =>  array('required'),
        'coupon_description' =>  'required',
        'value'              =>  'required',
        'duration'           =>  'required',
        'minimum_quantity'   =>  'required',
        'maximum_quantity'   =>  'required',
        'start_date'         =>  'required',
    ]; 
}