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

        // dd($category);
        return response()->json(['status' => 'success', 'categories' => $category]);
    }

    public function categorystatus(Request $request)
    {

        // dd($request);
        $id = $request->id;

        $category = Category::find($id);
        if ($category) {
            $category->status = $request->status;
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Category update successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'

            ]);
        }
    }

    public function deletecategory(Request $request)
    {

        $category = Category::find($request->id);
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Category not found']);
        }
        $category->delete();

        return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
    }

    public function detail($slug)
    {
        return view('category');
    }
}
