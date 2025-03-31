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
            // $products = Product::all();
            $products = Product::where('status', 'available')->paginate(8);

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


    // search funtion 
    public function search(Request $request)
    {

    $query = $request->input('query');

    $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->where('status', 'available')
                ->limit(5)
                ->get();



    // Check if it's AJAX
    if ($request->ajax()) {
        return view('partials.search-results', compact('products'));
    }

    return view('partials.search-results', compact('products', 'query'));   //make it proper to handle requests if it is not ajax request
} 

}

