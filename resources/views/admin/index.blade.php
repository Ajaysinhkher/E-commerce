@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-700 mb-6">Dashboard</h2>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Revenue -->
            <div class="bg-blue-100 text-blue-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Revenue</h3>
                    <p class="text-2xl font-bold">₹ {{ number_format($totalRevenue, 2) }}</p>
                </div>
                <i class="uil uil-rupee-sign text-4xl"></i>
            </div>

            <!-- Total Products -->
            <div class="bg-green-100 text-green-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Products</h3>
                    <p class="text-2xl font-bold">{{ $totalProducts }}</p>
                </div>
                <i class="uil uil-box text-4xl"></i>
            </div>

            <!-- Total Customers -->
            <div class="bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Customers</h3>
                    <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
                </div>
                <i class="uil uil-users-alt text-4xl"></i>
            </div>

            <!-- Total Orders -->
            <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Total Orders</h3>
                    <p class="text-2xl font-bold">{{ $totalOrders }}</p>
                </div>
                <i class="uil uil-shopping-cart text-4xl"></i>
            </div>

            <!-- Pending Orders -->
            <div class="bg-orange-100 text-orange-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Pending Orders</h3>
                    <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
                </div>
                <i class="uil uil-hourglass text-4xl"></i>
            </div>

            <!-- Shipped Orders -->
            <div class="bg-purple-100 text-purple-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Shipped Orders</h3>
                    <p class="text-2xl font-bold">{{ $shippedOrders }}</p>
                </div>
                <i class="uil uil-truck text-4xl"></i>
            </div>

            <!-- Delivered Orders -->
            <div class="bg-teal-100 text-teal-800 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Delivered Orders</h3>
                    <p class="text-2xl font-bold">{{ $deliveredOrders }}</p>
                </div>
                <i class="uil uil-check-circle text-4xl"></i>
            </div>
        </div>

        <!-- Latest Orders Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Latest Orders</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="p-3 border text-left">Order ID</th>
                            <th class="p-3 border text-left">Customer</th>
                            <th class="p-3 border text-left">Date</th>
                            <th class="p-3 border text-right">Total</th>
                            <th class="p-3 border text-center">Status</th>
                            <th class="p-3 border text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestOrders as $order)
                            <tr class="border-b hover:bg-gray-100 transition">
                                <td class="p-3 border">{{ $order->id }}</td>
                                <td class="p-3 border">{{ $order->user->user_name ?? 'Guest' }}</td>
                                <td class="p-3 border">{{ $order->created_at->format('d M, Y h:i A') }}</td>
                                <td class="p-3 border text-right">₹ {{ number_format($order->total, 2) }}</td>
                                <td class="p-3 border text-center">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-md
                                        @if ($order->status === 'pending') bg-yellow-200 text-yellow-800 
                                        @elseif ($order->status === 'shipped') bg-purple-200 text-purple-800
                                        @elseif ($order->status === 'delivered') bg-teal-200 text-teal-800
                                        @elseif ($order->status === 'canceled') bg-red-200 text-red-800
                                        @else bg-gray-200 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="p-3 border text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="text-blue-600 hover:underline font-medium">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 border text-center text-gray-500">No recent orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        
@endsection