<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */   
    protected $redirectTo = '/login';
      
    protected function sendResetResponse($request, $response)
    {
        Auth::logout();
        $flash_success='Your Password reset successfully,Please login with new password.';

        //flash('your password reset successfully,Please login.')->success();
        return redirect($this->redirectTo)
                            ->with('status', trans($response));
    } 
}