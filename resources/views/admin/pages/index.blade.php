@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Static Pages</h2>
        <a href="{{ route('admin.pages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Page</a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Slug</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $page->name }}</td>
                <td class="p-3 border">{{ $page->slug }}</td>
                <td class="p-3 border">
                    <span class="{{ $page->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($page->status) }}
                    </span>
                </td>
                <td class="p-3 border flex space-x-2">
                    <a href="{{ route('admin.pages.edit', ['id' => $page->id]) }}" class="text-blue-500 hover:underline">✏ Edit</a>
                    <form action="{{ route('admin.pages.destroy', ['id' => $page->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}
</div>
@endsection