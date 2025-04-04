@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Admin</h2>

    <form action="{{ route('admin.admins.update', ['id'=>$admin->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" name="name" value="{{ $admin->name }}" required 
                   class="w-full mt-1 p-2 border rounded focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" name="email" value="{{ $admin->email }}" required 
                   class="w-full mt-1 p-2 border rounded focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Role:</label>
            <select name="role_id" required 
                    class="w-full mt-1 p-2 border rounded bg-white focus:ring focus:ring-indigo-300">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password (leave blank to keep current):</label>
            <input type="password" name="password" 
                   class="w-full mt-1 p-2 border rounded focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm Password:</label>
            <input type="password" name="password_confirmation" 
                   class="w-full mt-1 p-2 border rounded focus:ring focus:ring-indigo-300">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.admins.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Update Admin
            </button>
        </div>
    </form>
</div>
@endsection
