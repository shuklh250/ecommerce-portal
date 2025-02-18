<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Emailcontroller extends Controller
{
   
public function sendEmail(){

        $toEmail = "parasjisco@gmail.com";
        $moreuser = "test@gmail.com";
        $message = "Hello, Welcome to our website";
        $subject = "Welcomt to YahooBaba";  
            $details = [
                'name'=>'john deo',
                'product'=>'Test Product',
                'price'=>250
            ];

     $request =  Mail::to($toEmail)->cc($moreuser)->send(new welcomeemail($message,$subject,$details));

     dd($request);
    }


}
