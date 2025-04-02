@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Admins</h2>
            <a href="{{ route('admin.admins.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add New Admin
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left">#</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr class="border-b">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $admin->name }}</td>
                            <td class="p-3">{{ $admin->email }}</td>
                            <td class="p-3">
                                @if($admin->role)
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ $admin->role->name }}</span>
                                @else
                                    <span class="text-gray-500">No Role Assigned</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-3 text-gray-500">No admins found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
