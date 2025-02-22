<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail; // OTP email mail class import karna



class AdminController extends Controller
{


    public function login()
    {
        return view('admin/login');
    }



    // login veryfiry in database

    public function userlogin(Request $request)
    {
        // dd($request);

        $user =  User::where('email', $request->email)->first();
        if ($user) {
            $validate =  $request->validate([
                'email' => 'required|email',
                'password' => 'required'

            ]);

            if (Auth::attempt($validate)) {
                return redirect()->route('dashboard');
            } else {
                return back()->with('Error', 'Invalid Password');
            }
        } else {
            return back()->with('Error', 'Invalid Email');
        }
    }



    // signup function 

    public function showRegistrationForm()
    {

        return view('admin/register');
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

        // otp store temporary in session or database 

        session(['otp' => $otp, 'email' => $request->email, 'name' => $request->name, 'password' => $request->password]);
        // send mail to user 



        Mail::to($request->email)->send(new OtpMail($otp));

        return redirect()->route('verifyOtpForm');


        // $user = User::create([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'password' => Hash::make($validated['password']),
        //     'role' => 'admin'
        // ]);

        // return redirect()->route('login')->with('success', 'Registration successfully');
    }


    // Show OTP verification form.


    public function verifyOtp(Request $request)
    {
        // Validate OTP

        if ($request->otp == session('opt')) {


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


    //  Logout function here 

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'You have logged out successfully!');
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
