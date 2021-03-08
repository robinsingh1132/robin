<?php

namespace App\Lib\Validators;

class ChangePasswordValidators
{
    const CHANGE_PASSWORD = [
        'current' => 'required|min:8',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
    ];
}