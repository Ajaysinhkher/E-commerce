<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;



class DashboardController extends Controller
{

    // Admin Dashboard
    public function index()
    {

        $totalCustomers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('total');
        // dd($totalrevenue);

        return view('admin.index',[
            'totalCustomers'=>$totalCustomers,
            'totalOrders'=>$totalOrders,
            'totalProducts'=>$totalProducts,
            'totalRevenue'=>$totalRevenue

            ]); 
    }
}
