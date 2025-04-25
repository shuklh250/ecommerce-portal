<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showregister()
    {
        return view('register');
    }

    // here dtabase call

    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        $otp = rand(100000, 999999);
        $name = $request->email;
        $user = new User();
        $user->name = $request->name ?? null;
        $user->session_token = $request->sessiontoken ?? null;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->otp = $otp;
        $user->save();

        Mail::to($request->email)->send(new SendOTP($otp, $name));

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('verifyOtpForm', ['user_email' => $request->email])
        ]);
        // return redirect()->route('verifyOtpForm', ['user_email' => $request->email]);
    }

    public function showverifyotp()
    {

        return view('user.verifyotp');
    }
    public function register1()
    {
        return view('register1');
    }

    public function login()
    {
        return view('login');
    }
    public function verifylogin(Request $request)
    {

        $validate =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['status' => 'success', 'message' => 'Invalid Email']);
        } elseif ($user->role !== 'user') {
            return response()->json(['status' => 'success', 'message' => 'Access denied. Only registred user login']);
        } elseif ($user->isEmailverify !== 1) {
            return response()->json(['status' => 'success', 'message' => 'Please verify your email before logging in.']);
        } else {
            if (Auth::attempt($validate)) {
                Session::put('user_email', $user->email);
            } else {
                return response()->json(['invalid passsword']);
            }
        }
    }
    public function login1()
    {
        return view('login1');
    }

    // User dashboard Start Here
    public function index()
    {
        return view('user/index');
    }

    public function history()
    {
        return view('user/order-history');
    }

    public function detail()
    {
        return view('user/detail');
    }

    public function settings()
    {
        $email = Session::get('user_email');
        $user = User::where('email', $email)->first();
        // dd($user);
        return view('user/settings', compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => ['required', 'regex:/^[6-9][0-9]{9}$/']
        ]);

        $email = Session::get('user_email');
        $user = User::where('email', $email)->update([
            'name' => $request->name,
            'phone' => $request->phone

        ]);
        if (!$user) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('error', "Unable to update profile");
        }
    }
}
