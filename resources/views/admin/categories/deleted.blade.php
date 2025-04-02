@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Deleted Categories</h2>
        <a href="{{ route('admin.categories') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            🔙 Back to Categories
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Deleted At</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $category['id'] }}</td>
                <td class="p-3 border">{{ $category['name'] }}</td>
                <td class="p-3 border">{{ $category->deleted_at->format('d M, Y h:i A') }}</td>
                <td class="p-3 border flex space-x-2">
                    <form action="{{ route('admin.categories.restore', ['id' => $category->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 text-sm rounded hover:bg-green-600 transition">
                            🔄 Restore
                        </button>
                    </form>
                    <form action="{{ route('admin.categories.forceDelete', ['id' => $category->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 text-sm rounded hover:bg-red-700 transition" 
                                onclick="return confirm('This will permanently delete the category. Continue?')">
                            ❌ Permanently Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $categories->links() }}
@endsection