<?php

namespace App\Controllers;

use App\Classes\Request;
use Stripe\Customer;
use Stripe\Charge;

class PaymentController
{
    public function stripePayment(){
        $post = Request::get("post");
        $token = $post->stripeToken;
        $email = $post->stripeEmail;

        $customer = Customer::create([
            "email" => $email,
            "source" => $token
        ]);

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd',
        ]);

        $status = $charge->status;
        
        $home = new HomeController();
       $con = $home->saveDataToDatabase($status, json_encode($charge));
       if($con){
           view("payment_sucess");
       }else{
           view("cart");
       }

    }
}


?>