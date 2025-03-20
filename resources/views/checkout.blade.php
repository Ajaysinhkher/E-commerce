@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-5 bg-white p-4 rounded-lg shadow-md border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-800 mb-3">Checkout</h2>

    <form action="#" method="POST" class="space-y-2">
        @csrf

        <!-- Shipping Information -->
        <h3 class="text-md font-medium text-gray-700">Shipping Details</h3>
        <div class="grid grid-cols-2 gap-2">
            <div class="col-span-2">
                <label class="text-sm text-gray-600">Address Line 1</label>
                <input type="text" name="address1" required class="w-full p-1.5 border rounded-md text-sm focus:ring focus:ring-blue-200">
            </div>

            <div class="col-span-2">
                <label class="text-sm text-gray-600">Address Line 2</label>
                <input type="text" name="address2" class="w-full p-1.5 border rounded-md text-sm focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">City</label>
                <input type="text" name="city" required class="w-full p-1.5 border rounded-md text-sm focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="text-sm text-gray-600">State</label>
                <input type="text" name="state" required class="w-full p-1.5 border rounded-md text-sm focus:ring focus:ring-blue-200">
            </div>

            <div class="w-2/3">
                <label class="text-sm text-gray-600">Postal Code</label>
                <input type="text" name="postal_code" pattern="[0-9]{4,10}" required class="w-full p-1.5 border rounded-md text-sm focus:ring focus:ring-blue-200">
            </div>
        </div>

        <!-- Payment Method -->
        <h3 class="text-md font-medium text-gray-700 mt-3">Payment Method</h3>
        <div class="space-y-1">
            <label class="flex items-center text-sm text-gray-600">
                <input type="radio" name="payment_method" value="cod" checked class="mr-2">
                Cash on Delivery
            </label>
            <label class="flex items-center text-sm text-gray-600">
                <input type="radio" name="payment_method" value="card" class="mr-2">
                Credit / Debit Card
            </label>
        </div>

        <!-- Order Summary -->
        <div class="p-2 border rounded-md bg-gray-100">
            <h3 class="text-md font-medium text-gray-800">Order Summary</h3>
            <p class="text-gray-700 mt-1">Total: <span class="text-blue-600 font-semibold">$640</span></p>
        </div>

        <!-- Checkout Button -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md font-medium text-sm hover:bg-blue-600 transition">
            Place Order
        </button>
    </form>
</div>
@endsection
