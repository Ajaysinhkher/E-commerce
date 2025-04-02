@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Categories</h2>
        <div class="flex space-x-2">

            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Category</a>
            <a href="{{ route('admin.categories.deleted') }}" class="bg-red-500 text-white px-4 py-2 rounded">🗑  Deleted Categories</a>

        </div>

    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Created At</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)    
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $category['id'] }}</td>
                <td class="p-3 border">{{ $category['name'] }}</td>
                <td class="p-3 border">{{ $category->created_at->format('d M, Y h:i A') }}</td>
                <td class="p-3 border">
                    <span class="{{ $category->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="p-3 border">
                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="text-blue-500 hover:underline mr-2">✏ Edit</a>
                    <form action="{{ route('admin.categories.delete', ['id' => $category->id]) }}" method="POST" class="inline">
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
@endsection