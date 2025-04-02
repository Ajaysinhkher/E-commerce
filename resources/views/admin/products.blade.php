@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Products</h2>
        <div class="flex space-x-2">

            
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                + Add Product
            </a>
            <a href="{{ route('admin.products.deleted') }}" class="bg-red-500 text-white px-4 py-2 rounded">
                🗑  Deleted Products
            </a>
        </div>
    </div>

    

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Image</th>
                <th class="p-3 border">Description</th>
                <th class="p-3 border">Price</th>
                <th class="p-3 border">Quantity</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $product['id'] }}</td>
                <td class="p-3 border">{{ $product['name'] }}</td>
                <td class="p-3 border">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-16 object-cover rounded">
                    @else
                        No Image
                    @endif
                </td>
                <td class="p-3 border">{{ $product['description'] }}</td>
                <td class="p-3 border">₹ {{ number_format($product['price'], 2) }}</td>
                <td class="p-3 border">{{ $product['quantity'] }}</td>
                <td class="p-3 border">
                    <span class="{{ $product->status == 'available' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td class="p-3 border">
                    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="text-blue-500 hover:underline mr-2">✏ Edit</a>
                    <form action="{{ route('admin.products.delete', ['id' => $product->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">
                            🗑 Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $products->links() }}
@endsection