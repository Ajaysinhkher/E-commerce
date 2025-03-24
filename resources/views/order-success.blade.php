@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-5">Order Placed Successfully!</h2>

        <p class="text-gray-700 text-center mb-4">Thank you for your purchase. Here are your order details:</p>

        <!-- Order Details -->
        <div class="border border-gray-300 rounded-md p-4 bg-gray-50 mb-4">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Status:</strong> <span class="text-blue-600">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>

        <!-- Order Items -->
        <h3 class="text-lg font-medium text-gray-800 mt-4 mb-2">Order Summary</h3>
        <div class="border border-gray-300 rounded-md p-3 bg-gray-50">
            <ul class="space-y-1 text-gray-700">
                @foreach ($order->orderItems as $item)
                    <li class="flex justify-between">
                        <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                        <span>₹{{ number_format($item->product_price * $item->quantity, 2) }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="text-xl font-semibold text-gray-900 mt-3">Total: ₹{{ number_format($order->total, 2) }}</p>
        </div>

        <a href="{{ route('shop') }}" class="block text-center mt-4 text-blue-600 hover:underline">Continue Shopping</a>
    </div>
</div>
@endsection
