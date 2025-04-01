@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Static Pages</h2>
        <a href="{{ route('admin.staticpages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Static Page</a>
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
            @foreach ($staticPages as $staticPage)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $staticPage->name }}</td>
                <td class="p-3 border">{{ $staticPage->slug }}</td>
                <td class="p-3 border">
                    <span class="{{ $staticPage->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($staticPage->status) }}
                    </span>
                </td>
                <td class="p-3 border flex space-x-2">
                    <a href="{{ route('admin.staticpages.edit', ['id' => $staticPage->id]) }}" class="text-blue-500 hover:underline">✏ Edit</a>
                    <form action="{{ route('admin.staticpages.destroy', ['id' => $staticPage->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $staticPages->links() }}
</div>
@endsection
