@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Create New Role</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Role Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Permissions</label>
                <div class="grid grid-cols-3 gap-2 mt-2">
                    @foreach($permissions as $permission)
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-2">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Role</button>
        </form>
    </div>
@endsection
