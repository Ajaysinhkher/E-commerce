@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Edit Customer</h2>

    @if(session('error'))
        <div class="p-3 bg-red-500 text-white rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form id="editCustomerForm" action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="user_name" value="{{ old('user_name', $customer->user_name) }}" 
                class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}" 
                class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" 
                class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Update Customer
            </button>
            <a href="{{ route('admin.customers') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- jQuery & jQuery Validation Plugin -->
@push('scripts')

<script>
    $(document).ready(function () {
        $("#editCustomerForm").validate({
            rules: {
                user_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },
                status: {
                    required: true
                }
            },
            messages: {
                user_name: {
                    required: "Name is required.",
                    minlength: "Name must be at least 3 characters.",
                    maxlength: "Name cannot exceed 255 characters."
                },
                email: {
                    required: "Email is required.",
                    email: "Enter a valid email address."
                },
                phone: {
                    required: "Phone number is required.",
                    digits: "Only numbers are allowed.",
                    minlength: "Phone number must be at least 10 digits.",
                    maxlength: "Phone number cannot exceed 15 digits."
                },
                status: {
                    required: "Please select a status."
                }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("text-red-500 text-xs mt-1");
                element.after(error);
            }
        });
    });
</script>
@endpush
@endsection
