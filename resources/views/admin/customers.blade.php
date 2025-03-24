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
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Phone</th>
                <th class="p-3 border text-center">Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $customer->id }}</td>
                <td class="p-3 border">{{ $customer->user_name }}</td>
                <td class="p-3 border">{{ $customer->email }}</td>
                <td class="p-3 border">
                    <span class="px-2 py-1 text-xs font-semibold text-white 
                        {{ $customer->status == 'active' ? 'bg-green-500' : 'bg-red-500' }} rounded">
                        {{ ucfirst($customer->status) }}
                    </span>
                </td>
                <td class="p-3 border">{{ $customer->phone }}</td>
                <td class="p-3 border text-center space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" 
                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.customers.delete', $customer->id) }}" method="POST" 
                          class="inline-block" 
                          onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this customer?");
    }
</script>

@endsection
