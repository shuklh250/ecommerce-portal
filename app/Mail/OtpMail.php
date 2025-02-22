<?php 

namespace App\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable {
use SerializesModels;
public $otp;

 public function __construct($otp){

    $this->otp = $otp;

 }

 public function build(){
    return $this->subject('your Otp fort registration ')
    ->view('mail.otp');
 }

}