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

    public function updateproduct(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'stock_quantity' => 'required|numeric',
            'short_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only([
            'name',
            'category_id',
            'subcategory_id',
            'price',
            'discount_price',
            'stock_quantity',
            'short_description',
            'description',
            'image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            $data['image'] = $imageName;
            // dd($data['image']);
        };
        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function viewproduct()
    {
        $products = Product::with(['category', 'subcategory'])->get();
        $category = Category::where('status', '1')->get();
        $subcategories = SubCategory::where('status', 1)->get();

        return view('admin.view-product', compact('products', 'category', 'subcategories'));
    }

    public function getSubcategories(Request $request)
    {
        $subcategories  = SubCategory::where('category_id', $request->id)->get();
        return response()->json(data: $subcategories);
    }

    public function deleteproduct(Request $request)
    {

        $id = $request->id;

        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }
    public function detail($slug)
    {
        return view('product-detail');
    }
}
