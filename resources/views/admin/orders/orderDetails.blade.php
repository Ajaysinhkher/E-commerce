@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-sm rounded-md p-6 mt-6">
    <h2 class="text-2xl font-semibold mb-4">Order #{{ $order->id }} Details</h2>

    {{-- Order Info --}}
    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
        <div><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</div>
        <div>
            <strong>Status:</strong> 
            <span class="capitalize font-medium px-3 py-1 rounded-md text-sm
                @if ($order->status === 'pending') bg-yellow-200 text-yellow-800 
                @elseif ($order->status === 'processing') bg-blue-200 text-blue-800 
                @elseif ($order->status === 'shipped') bg-purple-200 text-purple-800
                @elseif ($order->status === 'delivered') bg-green-200 text-green-800
                @elseif ($order->status === 'cancelled') bg-red-200 text-red-800
                @else bg-gray-200 text-gray-800
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>
        
        <div><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</div>
    </div>

    {{-- Order Items --}}
    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Items</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border px-3 py-2">Product</th>
                        <th class="border px-3 py-2">Qty</th>
                        <th class="border px-3 py-2">Price</th>
                        <th class="border px-3 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($order->orderItems as $item)
                        @php 
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="border px-3 py-2">{{ $item->product->name ?? 'Product not found' }}</td>
                            <td class="border px-3 py-2">{{ $item->quantity }}</td>
                            <td class="border px-3 py-2">₹{{ number_format($item->product_price) }}</td>
                            <td class="border px-3 py-2">₹{{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right mt-3 font-semibold text-base">
            Total: ₹{{ number_format($order->total, 1) }}
        </div>
    </div>

    {{-- Update Order Status --}}
    <div class="mt-6 border-t pt-4">
        <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
            @csrf
            @method('PUT')

            <label for="status" class="block mb-1 font-medium text-sm">Change Order Status:</label>
            <div class="flex items-center gap-4">
                <select name="status" id="status" class="p-2 border border-gray-300 rounded w-60 text-sm">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
