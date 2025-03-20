<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        try {

            return view("auth.login");

        } catch (Exception $e) {

        }
    }

    public function authenticate(AuthRequest $request) {
        try {

            $credentials = $request->only(["email", "password"]);
            
            // create session 
            if(Auth::guard("customer")->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect(route("home"));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');

        } catch (Exception $e) {

        }
    }

    public function logout() {
        Auth::guard("customer")->logout();
        return redirect(route("customer.login"));
    }
}
