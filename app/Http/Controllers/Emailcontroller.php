<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Emailcontroller extends Controller
{

    public function sendEmail()
    {

        $toEmail = "parasjisco@gmail.com";
        $moreuser = "test@gmail.com";
        $message = "Hello, Welcome to our website";
        $subject = "Welcomt to YahooBaba";
        $details = [
            'name' => 'john deo',
            'product' => 'Test Product',
            'price' => 250
        ];

        $request =  Mail::to($toEmail)->cc($moreuser)->send(new welcomeemail($message, $subject, $details));

        // dd($request);
    }




    public function showOtpForm()
    {
        return view('mail.verifyOtp');
    }


    public function verifyOtp(Request $request)
    {
        // Validate OTP

        // dd($request);
        if ($request->otp == session('otp')) {


            $user = User::create([
                'name' => session('name'),
                'email' => session('email'),
                'password' => Hash::make(session('password')), // Hash the password
                'role' => 'admin'
            ]);
            Auth::login($user);

            return redirect()->route('dashboard'); // Redirect to home or dashboard
        } else {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
        }
    }


    public function mailform()
    {

        return view('mail.mail');
    }


    public function sendContactEmail(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);


        $fileName = time() . "." . $request->file('file')->extension();
        $request->file('file')->move('uploads', $fileName);
      
      $adminEmail = "shuklh250@gmail.com";
        $response =  Mail::to($adminEmail)->send(new welcomeemail($request->all(),$fileName));

if($response){
    return back()->with('success',"Thanks you for contacting us");
}else{
    return back()->with('error','Unable to submit form , Please try again');
}

        // dd($fileName);
    }
}
