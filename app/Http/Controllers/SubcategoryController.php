<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{


    public function showSubcategory()
    {

        return view('admin.add-subcategory');
    }
    public function addSubcategory(Request $request)
    {

        // dd($request);
        $request->validate([

            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:225',
        ]);

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        return response()->json(['status' => 'succss', 'message' => 'Subcategory created succesfully']);
    }


    public function fetchsubcategory()
    {
        $subcategoeies = SubCategory::with('category')->get();
        return response()->json(['subcategories' => $subcategoeies]);
    }


    public function changestatus(Request $request)
    {
        $id = $request->id;

        $subcategory =  SubCategory::find($id);

        if ($subcategory) {
            $subcategory->status = $request->status;
            $subcategory->save();
            return response()->json(['status' => 'success', 'message' => 'Category update successfully']);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'

            ]);
        }
    }

    public function deletesubcategory(Request $request)
    {
        $id = $request->id;

        $subcategory = SubCategory::find($id);
        if (!$subcategory) {
            return response()->json(['status' => 'error', 'message' => 'Category not found']);
        }
        $subcategory->delete();

        return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
    }

    public function detail($slug)
    {
        return view('subcategory');
    }
}
