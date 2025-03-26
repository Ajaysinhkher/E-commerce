@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-700">Dashboard</h2>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <!-- Total Revenue -->
        <div class="bg-blue-100 text-blue-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Total Revenue</h3>
                <p class="text-2xl font-bold">₹ {{$totalRevenue}}</p>
            </div>
            <i class="uil uil-rupee-sign text-4xl"></i>
        </div>

        <!-- Total Products -->
        <div class="bg-green-100 text-green-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Total Products</h3>
                <p class="text-2xl font-bold">{{$totalProducts}}</p>
            </div>
            <i class="uil uil-box text-4xl"></i>
        </div>

        <!-- Total Customers -->
        <div class="bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Total Customers</h3>
                <p class="text-2xl font-bold">{{$totalCustomers}}</p>
            </div>
            <i class="uil uil-users-alt text-4xl"></i>
        </div>

        <!-- Total Orders -->
        <div class="bg-red-100 text-red-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Total Orders</h3>
                <p class="text-2xl font-bold">{{$totalOrders}}</p>
            </div>
            <i class="uil uil-shopping-cart text-4xl"></i>
        </div>
    </div>
@endsection
