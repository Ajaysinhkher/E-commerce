@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Roles Management</h2>
            <a href="{{ route('admin.roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create Role
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left">Id</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Role Name</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Slug</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr class="border border-gray-200">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2">{{ $role->slug }}</td>
                        <td class="px-4 py-2">
                            <a href="" class="text-blue-600 hover:underline">Edit</a>
                            <form action="" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No roles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
