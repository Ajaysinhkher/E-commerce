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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-2 border">1</td>
                <td class="p-2 border">John Doe</td>
                <td class="p-2 border">$200</td>
                <td class="p-2 border">Completed</td>
            </tr>
        </tbody>
    </table>
@endsection
