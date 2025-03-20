<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::all();
        return view('admin.customers',['customers'=>$customers]);
    }
}
