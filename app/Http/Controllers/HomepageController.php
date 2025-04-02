<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\StaticPage;


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


    // public function contact()
    // {
        
    //      return view('contact');
    // }


    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Send email or store message in the database
        Mail::raw("Message from: {$request->name} ({$request->email})\n\n{$request->message}", function ($mail) use ($request) {
            $mail->to('support@yourshopper.com')
                ->subject('New Contact Form Submission');
        });

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

    public function userProfile()
    {
        // get authenticated user
        $user = Auth::guard('customer')->user();

        //  Fetch the customer's orders 
        $orders  = $user->orders()->latest()->get();

        return view('user-profile', compact('user', 'orders'));

    }

    public function edituserProfile()
    {
        // get authenticated user
        $user = Auth::guard('customer')->user();
        // dd($user);

        return ;


    }

}

