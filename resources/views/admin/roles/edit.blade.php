@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Edit Role</h2>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Role Name:</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" 
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Permissions:</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($permissions as $permission)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <span>{{ $permission->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Role</button>
        </div>
    </form>
</div>
@endsection
