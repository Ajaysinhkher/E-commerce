
@props(['products']);
<main class="mx-auto max-w-7xl py-10 px-4">
    <h2 class="text-2xl font-bold my-6">Featured Products</h2>
    <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
        <div class="bg-white p-3 rounded-lg shadow-sm">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-md">
            <h2 class="text-md font-semibold mt-2">{{ $product->name }}</h2>
            <p class="text-gray-600 text-sm">${{ $product->price }}</p>
            <button class="mt-2 bg-indigo-600 text-white py-1 px-3 text-sm rounded-md hover:bg-indigo-500">
                Add to Cart
            </button>
        </div>
        @endforeach
    </section>
</main>