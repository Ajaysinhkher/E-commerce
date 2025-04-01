<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ShopController extends Controller
{
    public function shop(Request $request)
    
    {
        try {
            // dd($request->all());
            $categories = Category::where('status','active')->get();

            // get selected category from query parameter:
            $categorySlug = $request->query('category')? explode(',', $request->query('category')) : [];
            // dd($categorySlug);
           
            
            // start the product query:
            $query  = Product::query();

             // Apply category filter if a category is selected
             if ($categorySlug) {
                $query->whereHas('categories', function ($q) use ($categorySlug) {
                    $q->whereIn('slug', $categorySlug);
                    // dd($q);
                });
            }


         

          // Fetch products with pagination
            $products = $query->paginate(10);
            // dd($products->toArray());
            

        // Check if the request is expecting JSON
        if ($request->expectsJson()) {
            return response()->json([
                'products' => view('partials.products', compact('products'))->render(),
                'pagination' => view('partials.pagination', compact('products'))->render(),
            ]);
        }

    

            

            // if no ajax request
            return view('shop', [
                'categories' => $categories,
                'products' => $products,
                'selectedCategory' => $categorySlug,  //pass the selecetedCategory to view
                
            ]);
        } catch (Exception $e) {
            Log::error('ShopController@shop Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load the shop. Please try again.');
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('productDetails', compact('product'));
        } catch (Exception $e) {
            Log::error("ShopController@show Error: Failed to load product with ID {$id}. " . $e->getMessage());
            return redirect()->route('shop')->with('error', 'Product not found.');
        }
    }
}
