@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md max-w-2xl mx-auto p-6">
        <h2 class="text-lg font-semibold mb-4">Edit Product</h2>
        
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded-md mb-3 text-sm">
            <strong>Something went wrong.</strong>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form id="editProductForm" action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="text-sm font-medium">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="w-full px-3 py-1.5 border rounded text-sm" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
                <div>
                    <label for="price" class="text-sm font-medium">Price</label>
                    <input type="number" id="price" name="price" value="{{ $product->price }}" class="w-full px-3 py-1.5 border rounded text-sm" step="0.01" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
                <div>
                    <label for="quantity" class="text-sm font-medium">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" class="w-full px-3 py-1.5 border rounded text-sm" min="0" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
                <div>
                    <label for="status" class="text-sm font-medium">Status</label>
                    <select id="status" name="status" class="w-full px-3 py-1.5 border rounded text-sm" required>
                        <option value="">Select Status</option>
                        <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>available</option>
                        <option value="unavailable" {{ $product->status == 'unavailable' ? 'selected' : '' }}>unvailable</option>
                    </select>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
            </div>

            <div class="mt-3">
                <label for="description" class="text-sm font-medium">Description</label>
                <textarea id="description" name="description" class="w-full px-3 py-1.5 border rounded text-sm" rows="3" required>{{ $product->description }}</textarea>
                <span class="error-message text-red-500 text-xs"></span>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-3">
                <div>
                    <label for="categories" class="text-sm font-medium">Categories</label>
                    <select id="categories" name="categories[]" class="w-full px-3 py-1.5 border rounded text-sm" multiple required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="error-message text-red-500 text-xs"></span>
                    <small class="text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple categories.</small>
                </div>
                <div>
                    <label class="text-sm font-medium">Current Image</label>
                    <div class="mt-1">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 object-cover rounded mb-2">
                        @else
                            <p class="text-gray-500">No image uploaded</p>
                        @endif
                        <input type="file" name="image" class="w-full px-3 py-1.5 border rounded text-sm">
                        <span class="error-message text-red-500 text-xs"></span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('admin.products') }}" class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-xs hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    console.log(typeof jQuery); // Should print "function"
    console.log($.fn.validate); // Should NOT be "undefined"

    $(document).ready(function () {

        // console.log('hello');
        $("#editProductForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
                },
                description: {
                    required: true,
                    minlength: 10
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 0
                },
                status: {
                    required: true
                },
                "categories[]": {
                    required: true
                },
                // image: {
                //     extension: "jpeg,png,jpg,gif"
                // }
            },
            messages: {
                name: {
                    required: "Product name is required.",
                    minlength: "Product name must be at least 3 characters."
                },
                price: {
                    required: "Price is required.",
                    number: "Please enter a valid price.",
                    min: "Price cannot be negative."
                },
                description: {
                    required: "Description is required.",
                    minlength: "Description must be at least 10 characters."
                },
                quantity: {
                    required: "Quantity is required.",
                    number: "Please enter a valid number.",
                    min: "Quantity cannot be negative."
                },
                status: {
                    required: "Please select a status."
                },
                "categories[]": {
                    required: "Please select at least one category."
                },
                // image: {

                //     extension: "Allowed file types: jpeg, png, jpg, gif."
                // }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                console.log(error.text()); // Debugging line
                if (element.attr("type") === "file") {
                    error.insertAfter(element); // Place error below file input
                } else {
                    element.siblings(".error-message").html(error);
                    }
            },
            submitHandler: function (form) {
                console.log("Validation Passed! Submitting form..."); // Debugging
                form.submit();
            }
        });
           
        });
</script>
@endpush
@endsection
