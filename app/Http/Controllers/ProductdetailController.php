<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductdetailController extends Controller
{

    public function addproduct()
    {
        $category = Category::where('status', 1)->get();
        $subcategory = SubCategory::where('status', 1)->get();
        return view('admin.add-product', compact('category', 'subcategory'));
    }

    public function insertproduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'stock' => 'required|numeric',
            'shortdescription' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'stock_quantity' => $request->stock,
            'short_description' => $request->shortdescription,
            'description' => $request->description,
            'discount_price' => $request->discount_price ?? null,
            'image' => $imageName,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Product added successfully']);
    }


    public function viewproduct()
    {
        $products = Product::with(['category', 'subcategory'])->get();
        return view('admin.view-product', compact('products'));
    }

    public function getSubcategories(Request $request)
    {
        $subcategories  = SubCategory::where('category_id', $request->id)->get();
        return response()->json(data: $subcategories);
    }
    public function detail($slug)
    {
        return view('product-detail');
    }
}
