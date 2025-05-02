<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductdetailController extends Controller
{


    public function addproduct()
    {
        $category = Category::where('status', 1)->get();

        $subcategory = SubCategory::where('status', 1)->get();
        return view('admin.add-product', compact('category', 'subcategory'));
    }

    public function viewproduct()
    {
        return view('admin.view-product');
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
