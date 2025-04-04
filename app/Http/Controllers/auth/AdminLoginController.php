<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view("auth.admin-login"); // Blade file: resources/views/auth/admin-login.blade.php
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

          
            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            }

            return back()->withErrors([
                'email' => 'Invalid credentials',
            ])->onlyInput('email');

        } catch (Exception $e) {
            Log::error('AdminLoginController@authenticate Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while logging in. Please try again.');
        }
    }

    public function logout(Request $request)
    {
       
        try {
            Auth::guard('admin')->logout();
            // $request->session()->invalidate();  //it detriys all code
            $request->session()->forget('admin_auth');  //to destroy the particular admin sessions
            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        } catch (Exception $e) {
            Log::error('AdminLoginController@logout Error: ' . $e->getMessage());
            return redirect()->route('admin.login')->with('error', 'Failed to log out. Please try again.');
        }
    }
}
