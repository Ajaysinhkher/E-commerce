<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ShopController extends Controller
{
    public function shop()
    {
        try {
            $categories = Category::all();
            $products = Product::paginate(10);

            return view('shop', [
                'categories' => $categories,
                'products' => $products
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
