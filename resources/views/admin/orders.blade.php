@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Orders</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="p-3 border text-left">ID</th>
                        <th class="p-3 border text-left">Customer</th>
                        <th class="p-3 border text-left">Date of Order</th>
                        <th class="p-3 border text-right">Total</th>
                        <th class="p-3 border text-center">Status</th>
                        <th class="p-3 border text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 border">{{ $order->id }}</td>
                            <td class="p-3 border">{{ $order->user->user_name ?? 'Guest' }}</td>
                            <td class="p-3 border">{{ $order->created_at->format('d M, Y h:i A') }}</td>
                            <td class="p-3 border text-right">₹ {{ number_format($order->total, 2) }}</td>
                            <td class="p-3 border text-center">
                                @php
                                    $badgeColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'shipped' => 'bg-indigo-100 text-indigo-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusClass = $badgeColors[$order->status] ?? 'bg-gray-200 text-gray-800';
                                @endphp
                            
                                <span class="px-3 py-1 text-sm font-semibold rounded-md {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            
                            <td class="p-3 border text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="text-blue-600 hover:underline font-medium">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection