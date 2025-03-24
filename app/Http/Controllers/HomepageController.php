<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class HomepageController extends Controller
{
    public function index()
    {
        try {
            // Fetch all products
            $products = Product::all();

            return view('index', ['products' => $products]);
        } catch (QueryException $e) {
            // Log the error for debugging
            Log::error('Database error fetching products: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->back()->with('error', 'Something went wrong while fetching products.');
        } catch (\Exception $e) {
            // Log general exceptions
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}

