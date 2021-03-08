<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    Public function execute(){

        // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
            'AWoA-4j6TiCDWTRyGusU3T149jiERW0YwLZXchVrBYhNp9u0mabZfzoCTyYtUI-4NVdeKF9D0s5h1pq4',     // ClientID
            'EGr9NqgY82-AlSYJ4W93ywoMze1E2FvUSBcl-rP4GRvJE8ZVwntiQZn8tKsSyadroNya1cJFmyG6dDyV'      // ClientSecret
        )
    );
        

        $paymentId = request('PaymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount->setCurrency('INR');
        $amount->setTotal(20);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
    
        $execution->addTransaction($transaction);
        $result = $payment->execute($execution, $apiContext);

        return $result;
    }
}