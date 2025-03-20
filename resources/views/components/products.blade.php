{{-- @php
    $products = [
        ['name' => 'Stylish Jacket', 'price' => 199, 'image' => 'images/clothes1.jpg', 'rating' => 5],
        ['name' => 'Casual Shirt', 'price' => 299, 'image' => 'images/clothes2.jpg', 'rating' => 4],
        ['name' => 'Elegant Dress', 'price' => 399, 'image' => 'images/clothes3.jpg', 'rating' => 3],
        ['name' => 'Denim Jeans', 'price' => 249, 'image' => 'images/clothes5.jpg', 'rating' => 5],
        ['name' => 'nevia football', 'price' => 459, 'image' => 'images/sports1.jpg', 'rating' => 5],
        ['name' => 'Tennis racket', 'price' => 670, 'image' => 'images/sports6.jpg', 'rating' => 4.5],
        ['name' => 'Nike football studs', 'price' => 3000, 'image' => 'images/sports3.jpg', 'rating' => 3],
        ['name' => 'keeper gloves', 'price' => 300, 'image' => 'images/sports4.jpg', 'rating' => 5],
        ['name' => 'SG Cricket Ball', 'price' => 450, 'image' => 'images/sports5.jpg', 'rating' => 5],
        
    ];
@endphp --}}

<section class="py-12 px-6 bg-gray-100">
    <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">Featured Products</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</section>
 