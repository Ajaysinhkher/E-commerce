@extends('layouts.admin')

@section('content')
<div class="p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-gray-700 mb-3">Create Static Page</h2>

   
    <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name and Slug Side by Side -->
        <div class="flex space-x-4 mb-3">
            <!-- Name -->
            <div class="flex-1">
                <label for="name" class="block text-gray-700 font-medium text-sm mb-1">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded text-sm" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="block text-gray-700 font-medium text-sm mb-1">Content</label>
            <textarea name="content" id="content_summernote" class="w-full border rounded">{{ old('content') }}</textarea>
            @error('content')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="block text-gray-700 font-medium text-sm mb-1">Status</label>
            <select name="status" id="status" class="w-full p-2 border rounded text-sm">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700 text-sm">Create</button>
            <a href="{{ route('admin.pages.index') }}" class="bg-gray-300 text-gray-700 px-4 py-1.5 rounded hover:bg-gray-400 text-sm">Cancel</a>
        </div>
    </form>

    
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content_summernote').summernote({
                placeholder: 'Enter your content here',
                tabsize: 2,
                height: 200, // Reduced height for compactness
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
@endsection