<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Session check karo yahan
        if (!session()->has('user_id')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized - Please login first'
            ], 401);
        }

        // Product data fetch karo
        $products = Product::all();

        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }
}
