<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        try {
            $products = Product::query()->simplePaginate(4);
            return view('admin.products', ['products' => $products]);
        } catch (\Exception $e) {
            Log::error('AdminProductController@index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load products.');
        }
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        try {
            $categories = Category::all();
            return view('admin.products.create', ['categories' => $categories]);
        } catch (\Exception $e) {
            Log::error('AdminProductController@create Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load categories.');
        }
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'quantity' => 'required|integer|min:0',
                'status' => 'required|in:available,unavailable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7000',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
            ]);

            // Handle Image Upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $imagePath = 'products/' . basename($imagePath);
            }

            // Create Product
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'slug' => Str::slug($request->name),
                'image' => $imagePath,
            ]);

            // Attach categories
            $product->categories()->attach($request->categories);

            return redirect()->route('admin.products')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            Log::error('AdminProductController@store Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to add product.');
        }
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.edit', ['product' => $product]);
        } catch (\Exception $e) {
            Log::error('AdminProductController@edit Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load product details.');
        }
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'quantity' => 'required|integer|min:0',
                'status' => 'required|in:available,unavailable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7000',
            ]);

            $product = Product::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::delete('public/' . $product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
                $imagePath = 'products/' . basename($imagePath);
                $product->image = $imagePath;
            }

            // Update Product
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'slug' => Str::slug($request->name),
                'image' => $product->image,
            ]);

            // Sync categories
            $product->categories()->sync($request->categories);

            return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error('AdminProductController@update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update product.');
        }
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();  //softdelete applied


            return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            Log::error('AdminProductController@destroy Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete product.');
        }
    }
}
