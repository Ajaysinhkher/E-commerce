@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md max-w-3xl mx-auto p-5">
        <h2 class="text-lg font-semibold mb-4">Add New Product</h2>

        <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-medium">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium">Price</label>
                    <input type="number" name="price" id="price" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" step="0.01" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-3">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" id="description" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" rows="2" required></textarea>
                <span class="error-message text-red-500 text-xs"></span>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-3">
                <!-- Quantity -->
                <div>
                    <label class="block text-sm font-medium">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" min="0" required>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
                        <option value="">Select Status</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-3">
                <!-- Categories -->
                <div>
                    <label class="block text-sm font-medium">Categories</label>
                    <select name="categories[]" id="categories" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="error-message text-red-500 text-xs"></span>
                    <small class="text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple categories.</small>
                </div>
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium">Image</label>
                    <input type="file" name="image" id="image" class="w-full px-3 py-1.5 border rounded focus:ring focus:ring-blue-200">
                    <span class="error-message text-red-500 text-xs"></span>
                </div>
            </div>

            <div class="flex justify-end space-x-2 mt-5">
                <a href="{{ route('admin.products') }}" class="px-3 py-1.5 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm">Cancel</a>
                <button type="submit" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Save</button>
            </div>
        </form>

        

    </div>
</div>

@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> --}}
    <script>
    console.log(typeof jQuery);
    console.log($.fn.validate);

        $(document).ready(function() {
           
            $("#productForm").validate({
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
                    image: {
                        required: true,
                        // extension: "jpeg|png|jpg|gif"
                    }
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
                    image: {
                        required: "Please upload an image.",
                        // extension: "Allowed file types: jpeg, png, jpg, gif."
                    }
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    if (element.attr("type") === "file") {
                        error.insertAfter(element); // Place error below file input
                    } else {
                        element.siblings(".error-message").html(error);
                    }
                }   
            });
          
        });
    </script>
    @endpush
@endsection
