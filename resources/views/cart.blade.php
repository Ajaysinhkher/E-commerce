@extends('layouts.app')

@section('content')

@php
    $cartItems = [
        [
            'image' => asset('storage/images/clothes1.jpg'),
            'name' => 'ITALIAN L SHAPE',
            'availability' => 'In Stock',
            'quantity' => 1,
            'price' => 320.00
        ],
        [
            'image' => asset('storage/images/clothes1.jpg'),
            'name' => 'DINING TABLE',
            'availability' => 'In Stock',
            'quantity' => 1,
            'price' => 320.00
        ],
    ];
@endphp

<div class="flex flex-col min-h-screen bg-gray-50">
    <!-- Main Content -->
    <div class="flex-1 w-full max-w-6xl mx-auto py-10 px-4">
        <div class="flex flex-col lg:flex-row items-start gap-8">
            <!-- Left Section: Cart Items -->
            <div class="lg:w-2/3 w-full">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center lg:text-left">Your Cart</h2>
                <div class="space-y-6">
                    @foreach ($cartItems as $cart)
                        <x-cart-design 
                            :image="$cart['image']"
                            :name="$cart['name']"
                            :availability="$cart['availability']"
                            :quantity="$cart['quantity']"
                            :price="$cart['price']"
                        />
                    @endforeach
                </div>
            </div>

            <!-- Right Section: Cart Summary -->
            <div class="lg:w-1/3 w-full">
                <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-md sticky top-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-5">Cart Summary</h3>
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-lg font-medium text-gray-700">Total:</p>
                        <p class="text-2xl font-bold text-blue-600">${{ array_sum(array_column($cartItems, 'price')) }}</p>
                    </div>
                    <div class="space-y-4">
                        <a href="/checkout" class="block w-full px-5 py-3 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-all text-sm font-medium text-center">
                            Proceed to Checkout
                        </a>
                        <a href="/shop" class="block w-full px-5 py-3 text-gray-800 border border-gray-400 rounded-lg hover:bg-gray-200 transition-all text-sm font-medium text-center">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (Always at the Bottom) -->
    {{-- <footer class="w-full bg-gray-900 text-white py-4 text-center text-sm mt-auto">
        &copy; {{ date('Y') }} YourStore. All rights reserved.
    </footer> --}}
</div>

@endsection
