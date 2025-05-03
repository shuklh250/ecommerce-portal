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
        if (Auth::guard('user')->check()) {
            return redirect()->route('home');
        }
        return view('lo gin');
    }
    public function verifylogin(Request $request)
    {
        if (Auth::guard('user')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already logged in.'
            ]);
        }
        if (Auth::guard('web')->check()) {
            // apna user dashboard route daalna
        }
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->status != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'You blocked by admin'
            ]);
        }
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Email!'
            ]);
        }

        if ($user->role !== 'user') {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied. Only registered users can login!'
            ]);
        }

        if ($user->isEmailverify !== 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please verify your email before logging in!'
            ]);
        }

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            Session::put('user_email', $user->email);
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect_url' => route('home'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid password'
            ]);
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

    //   logout fiunction 

    public function logout(Request $request)
    {
        Auth::guard('user')->logout(); // ya admin/vendor

        $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
