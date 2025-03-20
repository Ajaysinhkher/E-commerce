<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    // Admin Dashboard
    public function index()
    {
        return view('admin.index'); // Make sure you have 'admin.index' Blade file
    }
}
