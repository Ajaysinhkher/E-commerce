<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index() {
        try {
            return view("auth.login");
        } catch (Exception $e) {
            Log::error('LoginController@index Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the login page.');
        }
    }

    public function authenticate(AuthRequest $request) {
        try {
            $credentials = $request->only(["email", "password"]);
            
            // Create session 
            if (Auth::guard("customer")->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect(route("home"));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');

        } catch (Exception $e) {
            Log::error('LoginController@authenticate Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during authentication. Please try again.');
        }
    }

    public function logout(Request $request) {
        try {
            Auth::guard("customer")->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect(route("customer.login"));
            
        } catch (Exception $e) {
            Log::error('LoginController@logout Error: ' . $e->getMessage());
            return redirect(route("customer.login"))->with('error', 'Failed to log out. Please try again.');
        }
    }
}
