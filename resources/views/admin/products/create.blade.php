@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md max-w-2xl mx-auto p-5">
        <h2 class="text-xl font-semibold mb-3">Add New Product</h2>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium">Product Name</label>
                <input type="text" name="name" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" rows="2" required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block text-sm font-medium">Price</label>
                    <input type="number" name="price" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" step="0.01" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Quantity</label>
                    <input type="number" name="quantity" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" min="0" required>
                </div>
            </div>

            <!-- Categories Multi-Select -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Categories</label>
                <select name="categories[]" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple categories.</small>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Image</label>
                <input type="file" name="image" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.products') }}" class="px-3 py-1.5 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm">Cancel</a>
                <button type="submit" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
