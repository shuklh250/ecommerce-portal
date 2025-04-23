<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOTP extends Mailable
{

    use SerializesModels;
    public $otp;
    public $name;
    public function __construct($otp, $name)
    {

        $this->otp = $otp;
        $this->name = $name;
    }

    public function build()
    {

        return $this->subject('Your OTP code')
            ->view('emails.otp');
    }
}
