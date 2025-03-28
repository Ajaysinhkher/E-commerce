@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md max-w-2xl mx-auto p-5">
        <h2 class="text-xl font-semibold mb-3">Edit Category</h2>

        {{-- Show validation errors --}}
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md mb-4">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="editCategoryForm" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="block text-sm font-medium">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                    class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" required>
                <span class="error-message text-red-500 text-xs mt-1 block"></span>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <span class="error-message text-red-500 text-xs mt-1 block"></span>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.categories') }}" 
                    class="px-3 py-1.5 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm">
                    Cancel
                </a>
                <button type="submit" 
                    class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                    Update
                </b
utton>
            </div>
        </form>
    </div>
</div>

{{-- jQuery Validation --}}
@push('scripts')
<script>
    $(document).ready(function () {
        $("#editCategoryForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                status: {
                    required: true,
                    inList: ["active", "inactive"]
                }
            },
            messages: {
                name: {
                    required: "Category name is required.",
                    minlength: "Category name must be at least 3 characters.",
                    maxlength: "Category name cannot exceed 255 characters."
                },
                status: {
                    required: "Please select a status.",
                    inList: "Status must be either Active or Inactive."
                }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("text-red-500 text-xs mt-1 block");
                element.closest("div").find(".error-message").html(error);
            },
            success: function (label) {
                label.closest("div").find(".error-message").html("");
            }
        });

        // Custom validation method for inList (to check if value is in the allowed list)
        $.validator.addMethod("inList", function(value, element, params) {
            return this.optional(element) || params.indexOf(value) !== -1;
        }, "Please select a valid option.");
    });
</script>
@endpush
@endsection