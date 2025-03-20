@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Customers</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Staus</th>
                <th class="p-3 border">Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $customer->id }}</td>
                <td class="p-3 border">{{ $customer->user_name }}</td>
                <td class="p-3 border">{{ $customer->email }}</td>
                <td class="p-3 border">{{ $customer->status }}</td>
                <td class="p-3 border">{{ $customer->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
