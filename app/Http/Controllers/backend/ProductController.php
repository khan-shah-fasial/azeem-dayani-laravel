<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::select('title', 'id')->get();
        return view('backend.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'home_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|boolean',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }

        $product = new Product;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('assets/images', 'public');
        } else {
            $image = null;
        }

        // Handle the image upload
        if ($request->hasFile('home_image')) {
            $home_image = $request->file('home_image')->store('assets/images', 'public');
        } else {
            $home_image = $request->input('existing_home_image');
        }

        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->is_active = $request->is_active;
        $product->image = $image;
        $product->home_image = $home_image;
        $product->categories_id = $request->category;


        $product->save();

        return response()->json([
            'status' => true,
            'notification' => 'Film created successfully!',
        ]);

    }

    

    public function edit(Product $product, $id)
    {
        $product = Product::findOrFail($id);  // Retrieve the product by ID
        $categories = ProductCategory::select('title', 'id')->get();
        return view('backend.pages.products.edit', compact('product', 'categories'));
    }
    

    public function update(Request $request, $id)
{
    // Validate the input data
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'slug' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'home_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_active' => 'required|boolean',
        'category' => 'required',
    ]);

    // Handle validation errors
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'notification' => $validator->errors()->all()
        ], 200);
    }

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('assets/images', 'public');
    } else {
        $image = $request->input('existing_image');
    }

    // Handle the image upload
    if ($request->hasFile('home_image')) {
        $home_image = $request->file('home_image')->store('assets/images', 'public');
    } else {
        $home_image = $request->input('existing_home_image');
    }

    // Update the product details
    $product->title = $request->title;
    $product->slug = $request->slug;
    $product->is_active = $request->is_active;
    $product->image = $image;
    $product->home_image = $home_image;
    $product->categories_id = $request->category;


    // Save the updated product
    $product->save();

    // Return success response
    return response()->json([
        'status' => true,
        'notification' => 'Product updated successfully!',
    ]);
}

    
    public function delete($id) {
        
        $product = Product::find($id);
        if (!$product) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $product->delete();

        $response = [
            'status' => true,
            'notification' => 'Product Deleted successfully!',
        ];

        return response()->json($response);
    }

}
