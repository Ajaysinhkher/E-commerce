<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = product::all();
        return view('admin.products',['products'=>$products]); // Pass products as an array attribute
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // dd($request->toArray());
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'quantity' => 'required|integer|min:0',
                'status' => 'required|in:available,unavailable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7000',
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Show validation errors
        }

        // Handle Image Upload
        $imagePath = null; // Default image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = 'products/' . basename($imagePath);
        }



        // Create Product
        product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit( $id)
    {
        $product = product::find($id);
        if(!$product)
        {
            abort(404);
        }
        // dd($product->toArray());
       
        return view('admin.products.edit',['product'=>$product]);
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string', // Ensure description is required
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7000',
        ]);

        // dd($val);
        // dd($request->validated());

        // fetch product to be edited by id attribute
        $product = product::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {

            // delete the old image if exists:
                if($product->image)
                {
                    \Storage::delete('public/'. $product->image);
                }


            // store new image:

            $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = 'products/' . basename($imagePath);

            // update image path in products folder
            $product->image = $imagePath;
        }

        // dd($imagePath);

      
        // dd($product);
        // Update Product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
            'image'=>$product->image,  //ensure image is updated
        ]);

        // success is stored in session over here
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
