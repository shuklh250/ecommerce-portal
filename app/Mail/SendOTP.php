<?php 
namespace App\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOTP extends Mailable {

    use SerializesModels;
    public $otp;
    public function __construct($otp){

        $this->otp = $otp;
    }

    public function build(){

        return $this->subject('Your OTP code')
        ->view('emails.otp');
    }

}