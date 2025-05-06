<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
      $TopDeals = Product::where('status', '1')->get();

      return view('home', compact('TopDeals'));
   }
}
