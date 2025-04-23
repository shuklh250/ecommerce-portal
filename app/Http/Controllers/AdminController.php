<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTP;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function login()
    {
        return view('admin/login');
    }
    // login veryfiry in database

    public function userlogin(Request $request)
    {

        $validate =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user =  User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('Error', 'Invalid Email');
        } elseif ($user->role !== 'admin') {
            return back()->with('Error', 'Access denied. Admins only.');
        } elseif ($user->isEmailverify != 1) {
            return redirect()->route('show.emailreverify')->with('Error', 'Please verify your email before logging in.');
        } else {
            if (Auth::attempt($validate)) {
                Session::put('admin_email', $request->email);

                // generate new session token
                $token = Str::random(60);
                $user->session_token = $token;
                $user->save();

                session(['session_token' => $token]);

                return redirect()->route('dashboard');
            } else {
                return back()->with('Error', 'Invalid Password');
            }
        }
    }
    // signup function 
    public function showRegistrationForm()
    {

        return view('admin.register');
    }
    // post register 

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:3',

        ]);

        // $otp generate function here 
        $otp = rand(100000, 999999); // 6digit otp 

        // otp store temporary  database 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ]);
        // save otp in the user record
        $name = $request->email;
        $user->otp = $otp;
        $user->save();

        Mail::to($request->email)->send(new SendOTP($otp, $name));
        return redirect()->route('verifyOtpForm', ['user_email' => $user->email]);
    }


    // Show OTP verification form.

    public function verifyOTP(Request $request)
    {
        // Validate OTP entered by user
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if ($user && $user->otp == $request->otp) {
            // OTP is correct, delete OTP from the database
            $user->otp = null;

            // Set email_verified_at to current timestamp
            $user->email_verified_at = Carbon::now();
            $user->save();

            // Respond with success message
            return response()->json([
                'message' => 'OTP verified successfully! Your email is now verified.',
                'email_verified_at' => $user->email_verified_at
            ]);
        } else {
            return response()->json(['message' => 'Invalid OTP!'], 400);
        }
    }

    public function emailreverify()
    {

        return view('emails.emailreverify');
    }

    //  Logout function here 

    public function logout(Request $request)
    {

        Session::forget('admin_email');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have logged out successfully!');
    }
    // resend otp 

    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('Error', 'No account found with this email.');
        }
        if ($user->isEmailverify == 1) {
            return redirect()->route('login')->with('success', 'Your email is already verified.');
        }

        $otp = rand(100000, 999999); // 6digit otp 
        $name = $request->email;
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($request->email)->send(new SendOTP($otp, $name));
        return redirect()->route('verifyOtpForm', ['user_email' => $request->email])->with('success', 'OTP resent to your email.');
    }
    public function index()
    {
        return view('admin/index');
    }

    public function addcategory()
    {
        return view('admin/add-category');
    }

    public function viewcategory()
    {
        return view('admin/view-category');
    }

    public function editcategory()
    {
        return view('admin/edit-category');
    }

    public function users()
    {
        return view('admin/users');
    }

    public function vendors()
    {
        return view('admin/vendors');
    }

    public function orders()
    {
        return view('admin/orders');
    }

    public function orderdetail()
    {
        return view('admin/order-detail');
    }



    // public function products(){
    //     return view('admin/products');
    // }
}
