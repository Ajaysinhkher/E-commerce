@props(['product'])

<div class="bg-white p-3 shadow-sm rounded-lg hover:shadow-md transition border relative group">
    <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" 
         class="w-full h-48 object-cover rounded-md">

    <!-- Product Name & Price -->
    <div class="flex justify-between items-center mt-3">
        <h3 class="text-md font-medium text-gray-900">{{ $product['name'] }}</h3>
        <p class="text-md font-semibold text-gray-900">₹{{ number_format($product['price'], 2) }}</p>
    </div>

    <!-- Product Details -->
    <p class="text-sm text-gray-700 mt-1">{{ $product['description'] }}</p>

    <!-- Buttons: View Details & Add to Cart -->
    <div class="mt-4 flex justify-between items-center">
        <a href="/product-details" 
           class="text-blue-500 text-sm hover:underline transition">
            View Details
        </a>

        {{-- <form action="{{ route('cart.add', $product['id']) }}" method="POST"> --}}

            <a href="/cart" class="py-2 px-4 text-sm border rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition">Add to cart</a>
            {{-- <form action="/cart" method="POST"> --}}
            {{-- @csrf
            <button type="submit" class="py-2 px-4 text-sm border rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                Add to Cart
            </button>
        </form> --}}
    </div>

    <!-- Wishlist Button (Appears on Hover) -->
    <button class="absolute top-3 right-3 hidden group-hover:flex items-center justify-center w-8 h-8 
                   bg-white rounded-full shadow-md hover:bg-gray-100 transition">
        <i class="uil uil-heart text-red-500 text-lg"></i>
    </button>
</div>
