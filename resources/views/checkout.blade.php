@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-5">Checkout</h2>

        <form action="{{ route('place.order') }}" method="POST">
            @csrf

            <!-- Shipping Information -->
            <h3 class="text-lg font-medium text-gray-700 mb-2">Shipping Details</h3>
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="address1" placeholder="Address Line 1" required class="col-span-2 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                <input type="text" name="address2" placeholder="Address Line 2" class="col-span-2 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                <input type="text" name="city" placeholder="City" required class="p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                <input type="text" name="state" placeholder="State" required class="p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                <input type="text" name="postal_code" placeholder="Postal Code" required class="col-span-2 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
            </div>
            
            <!-- Payment Method -->
            <h3 class="text-lg font-medium text-gray-700 mt-4 mb-2">Payment Method</h3>
            <div class="flex space-x-6">
                <label class="flex items-center">
                  <input type="radio" name="payment_method" value="cod" checked class="mr-2">
                    Cash on Delivery
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="card" class="mr-2">
                    Credit / Debit Card
                </label>
            </div>

            <!-- Order Summary -->
            <h3 class="text-lg font-medium text-gray-800 mt-6 mb-2">Order Summary</h3>
            <div class="border border-gray-300 rounded-md p-3 bg-gray-50">
                <ul class="space-y-1 text-gray-700">
                    @foreach ($cartItems as $item)
                        <li class="flex justify-between">
                            <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                            <span>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="text-xl font-semibold text-gray-900 mt-3">Total: ₹{{ number_format($cartTotal, 2) }}</p>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-md mt-4 transition duration-300">
                Place Order
            </button>
        </form>
    </div>
</div>

@endsection