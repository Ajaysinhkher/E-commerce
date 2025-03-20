@extends('layouts.admin')

@section('content')
{{-- <pre>{{ print_r($product, true) }}</pre> --}}
{{-- {{dd($product->toArray())}} --}}
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md max-w-2xl mx-auto p-5">
        <h2 class="text-xl font-semibold mb-3">Edit Product</h2>
        
        <form action="{{ route('admin.products.update', ['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block text-sm font-medium">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" rows="2" required>{{ $product->description }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block text-sm font-medium">Price</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" step="0.01" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Quantity</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" min="0" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
                    <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="not_available" {{ $product->status == 'not_available' ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Current Image</label>
                <div class="mb-2">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded">
                    @else
                        <p class="text-sm text-gray-500">No image uploaded</p>
                    @endif
                </div>
                <label class="block text-sm font-medium">Change Image</label>
                <input type="file" name="image" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.products') }}" class="px-3 py-1.5 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm">Cancel</a>
                <button type="submit" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
