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
        // Basic stats
        $totalCustomers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('total');

        // Order status counts
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Latest orders (e.g., last 5 orders)
        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Data for the chart (order status distribution)
        $orderStatusData = [
            'pending' => $pendingOrders,
            'shipped' => $shippedOrders,
            'delivered' => $deliveredOrders,
            'canceled' => Order::where('status', 'canceled')->count(),
        ];

        return view('admin.index', [
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalRevenue' => $totalRevenue,
            'shippedOrders' => $shippedOrders,
            'deliveredOrders' => $deliveredOrders,
            'pendingOrders' => $pendingOrders,
            'latestOrders' => $latestOrders,
            'orderStatusData' => $orderStatusData,
        ]);
    }
}