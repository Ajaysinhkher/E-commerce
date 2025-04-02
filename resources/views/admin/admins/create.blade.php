@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Create New Admin</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.admins.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded mt-1 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded mt-1 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>

            <div class="mb-4">
                <label for="role_id" class="block font-medium text-gray-700">Role</label>
                <select name="role_id" id="role_id" class="w-full p-2 border border-gray-300 rounded mt-1 @error('role_id') border-red-500 @enderror">
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Create Admin</button>
        </form>
    </div>
@endsection
