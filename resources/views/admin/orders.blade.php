@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold">Orders</h2>
    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Status</th>
                {{-- <th class="p-2 border">Action</th> --}}
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
                <tr>
                    
                    <td class="p-2 border">{{ $order->id }}</td>
                    <td class="p-2 border">{{ $order->user->user_name ?? 'Guest' }}</td>
                    <td class="p-2 border">₹ {{ number_format($order->total, 2) }}</td>
                    <td class="p-2 border">{{ ucfirst($order->status) }}</td>
                    {{-- <td class="p-2 border">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500">View</a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

     <!-- Pagination Links -->
     <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection
