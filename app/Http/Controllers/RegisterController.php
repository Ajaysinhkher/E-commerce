<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        try {
            // Validate user input
            $request->validate([
                'user_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|min:10|max:15|unique:users,phone',
                'password' => 'required|min:6|confirmed',
            ]);

            // Create new user
            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => 'active',
            ]);

            // Log the user in automatically after registration
            auth()->login($user);

            // Redirect to homepage or dashboard
            return redirect()->route('home')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            Log::error('RegisterController@register Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }
}
