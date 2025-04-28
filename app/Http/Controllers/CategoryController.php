<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function addcategory()
    {
        return view('admin/add-category');
    }
    public function insertcategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category;
        $category->status = 1;
        $category->save();

        return response()->json(['status' => 'success', 'message' => 'Category created successfully']);

        // return redirect()->back()->with('success', 'Category added successfully!');
    }
    public function fetchcategory()
    {

        $category = Category::all();
        return response()->json(['status' => 'success', 'categories' => $category]);
    }

    public function detail($slug)
    {
        return view('category');
    }
}
