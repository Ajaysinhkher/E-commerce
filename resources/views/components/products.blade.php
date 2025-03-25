
<section class="py-12 px-6 bg-gray-100">
    <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">Featured Products</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>

      <!-- Pagination Links -->
      <div class="mt-6">
        {{ $products->links() }}
    </div>
</section>
 