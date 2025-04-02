@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Deleted Products</h2>
        <a href="{{ route('admin.products') }}" class="bg-gray-600 text-white px-3 py-1 rounded-lg shadow-sm hover:bg-gray-700 transition">
            🔙 Back to Products
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300 rounded-lg overflow-hidden shadow-sm">
        <thead>
            <tr class="bg-gray-100 text-left text-sm uppercase">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Image</th>
                <th class="p-3 border">Description</th>
                <th class="p-3 border">Price</th>
                <th class="p-3 border">Quantity</th>
                <th class="p-3 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="hover:bg-gray-50 transition border-b">
                <td class="p-3 border">{{ $product->id }}</td>
                <td class="p-3 border">{{ $product->name }}</td>
                <td class="p-3 border">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded shadow-sm">
                    @else
                        <span class="text-gray-500 text-sm">No Image</span>
                    @endif
                </td>
                <td class="p-3 border text-sm text-gray-700">{{ Str::limit($product->description, 50) }}</td>
                <td class="p-3 border font-semibold">₹ {{ number_format($product->price, 2) }}</td>
                <td class="p-3 border text-center">{{ $product->quantity }}</td>
                <td class="p-3 border text-center">
                    <div class="flex justify-center space-x-2">
                        <form action="{{ route('admin.products.restore', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 text-white text-xs px-2 py-1 rounded shadow-sm hover:bg-green-600 transition">
                                🔄 Restore
                            </button>
                        </form>
                        <form action="{{ route('admin.products.forceDelete', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs px-2 py-1 rounded shadow-sm hover:bg-red-600 transition"
                                    onclick="return confirm('This will permanently delete the product. Continue?')">
                                ❌ Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
