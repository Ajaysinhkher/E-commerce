@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        <i class="uil uil-user-circle text-teal-600 mr-2"></i> Your Profile
    </h2>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- User Details Card -->
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-xl font-semibold text-teal-700 mb-4 flex items-center">
                <i class="uil uil-id-card text-teal-600 mr-2"></i> User Details
            </h3>
            <div class="space-y-4 text-gray-700">
                <p class="flex items-center">
                    <i class="uil uil-user text-teal-500 mr-2"></i>
                    <span><strong>Name:</strong> {{ $user->user_name }}</span>
                </p>
                <p class="flex items-center">
                    <i class="uil uil-tag-alt text-teal-500 mr-2"></i>
                    <span><strong>User ID:</strong> {{ $user->id }}</span>
                </p>
                <p class="flex items-center">
                    <i class="uil uil-envelope text-teal-500 mr-2"></i>
                    <span><strong>Email:</strong> {{ $user->email }}</span>
                </p>
                {{-- Uncomment and style address if needed --}}
                {{-- <p class="flex items-center">
                    <i class="uil uil-map-marker text-teal-500 mr-2"></i>
                    <span><strong>Address:</strong> {{ $user->address ?? 'Not set' }}</span>
                </p> --}}
            </div>
            <a href="{{ route('user.edit-profile') }}" 
               class="mt-6 inline-flex items-center text-teal-600 hover:text-teal-800 font-medium transition-colors duration-200">
                <i class="uil uil-edit mr-1"></i> Edit Profile
            </a>
        </div>

        <!-- Orders Card -->
        <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-xl font-semibold text-teal-700 mb-4 flex items-center">
                <i class="uil uil-shopping-cart-alt text-teal-600 mr-2"></i> Your Orders
            </h3>
            @if($orders->isEmpty())
                <p class="text-gray-600 flex items-center">
                    <i class="uil uil-info-circle text-gray-500 mr-2"></i> You haven’t placed any orders yet.
                </p>
            @else
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @foreach($orders as $order)
                        <div class="border-b border-gray-200 pb-4 last:border-b-0">
                            <p class="flex items-center text-gray-700">
                                <i class="uil uil-box text-teal-500 mr-2"></i>
                                <span><strong>Order #{{ $order->id }}</strong></span>
                            </p>
                            <p class="flex items-center text-gray-600 text-sm mt-1">
                                <i class="uil uil-calendar-alt text-teal-500 mr-2"></i>
                                <span><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</span>
                            </p>
                            <p class="flex items-center text-gray-600 text-sm mt-1">
                                <i class="uil uil-dollar-sign text-teal-500 mr-2"></i>
                                <span><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</span>
                            </p>
                            <p class="flex items-center text-gray-600 text-sm mt-1">
                                <i class="uil uil-check-circle text-teal-500 mr-2"></i>
                                <span><strong>Status:</strong> 
                                    <span class="{{ $order->status === 'pending' ? 'text-yellow-600' : 'text-green-600' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection