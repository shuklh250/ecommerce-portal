<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Mail;

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
        return view('user/settings');
    }
}
