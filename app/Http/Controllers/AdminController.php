<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   

    public function login(){
        return view('admin/login');
    }
// signup function 

    public function showRegistrationForm(){

        return view('admin/register');
    }

    // post register 

     public function register(Request $request){
$validated = $request->validate([
'name'=>'required|string|max:255',
'email'=>'required|string|email|unique:users',
'password' => 'required|string|confirmed|min:8',

]);

$user = User::create([
'name' => $validated['name'],
'email' => $validated['email'],
'password' => Hash::make($validated['password']),
'role'=>'admin' 
]);

return redirect()->route('login')->with('success'   ,'Registration successfully');


     }

// login veryfiry in database

public function userlogin(){
    

}

    public function index(){
        return view('admin/index');
    }

    public function addcategory(){
        return view('admin/add-category');
    }

    public function viewcategory(){
        return view('admin/view-category');
    }

    public function editcategory(){
        return view('admin/edit-category');
    }

    public function users(){
        return view('admin/users');
    }

    public function vendors(){
        return view('admin/vendors');
    }

    public function orders(){
        return view('admin/orders');
    }

    public function orderdetail(){
        return view('admin/order-detail');
    }

    

    // public function products(){
    //     return view('admin/products');
    // }
}
