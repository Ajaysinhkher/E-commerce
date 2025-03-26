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
                        <th class="p-3 border text-right">Total</th>
                        <th class="p-3 border text-center">Status</th>
                        {{-- <th class="p-3 border text-center">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 border">{{ $order->id }}</td>
                            <td class="p-3 border">{{ $order->user->user_name ?? 'Guest' }}</td>
                            <td class="p-3 border text-right">₹ {{ number_format($order->total, 2) }}</td>
                            <td class="p-3 border text-center">
                                <span class="px-3 py-1 text-sm font-semibold rounded-md
                                    @if ($order->status === 'pending') bg-yellow-200 text-yellow-800 
                                    @elseif ($order->status === 'completed') bg-green-200 text-green-800
                                    @elseif ($order->status === 'canceled') bg-red-200 text-red-800
                                    @else bg-gray-200 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            {{-- <td class="p-3 border text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="text-blue-600 hover:underline font-medium">View</a>
                            </td> --}}
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
