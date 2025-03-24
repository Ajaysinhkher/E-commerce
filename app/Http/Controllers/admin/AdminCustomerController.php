<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminCustomerController extends Controller
{
    public function index()
    {
        try {
            $customers = User::all();
            return view('admin.customers', ['customers' => $customers]);
        } catch (\Exception $e) {
            Log::error('AdminCustomerController@index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load customers.');
        }
    }
}
