<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Emailcontroller extends Controller
{


    public function showOtpForm($user_email)
    {
        return view('mail.verifyOtp', ['user_email' => $user_email]);
    }

    public function verifyOtp(Request $request)
    {

        $email = $request->user_id;
        // dd($email);
        $otp = $request->otp;
        $user = DB::table('users')
            ->where('email', $email)
            ->where('otp', $otp)
            ->first();
        if ($user) {
            $updateuser = DB::table('users')->where('email', $email)->update(['isEmailverify' => 1, 'otp' => null]);

            if ($user->role == "admin") {
                return redirect()->route('admin.login')->with('success', 'Registration successfully! Please login');
            } elseif ($user->role == "vendor") {
                return redirect()->route('vendor.login')->with('success', 'Registration successfully! Please login');
            } else {
                return redirect()->route('login')->with('success', 'Registration successfully! Please login');
            }
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
        $response =  Mail::to($adminEmail)->send(new welcomeemail($request->all(), $fileName));

        if ($response) {
            return back()->with('success', "Thanks you for contacting us");
        } else {
            return back()->with('error', 'Unable to submit form , Please try again');
        }
    }
}
