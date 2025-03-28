@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-full py-5 px-6">
    <!-- Page Heading -->
    <h2 class="text-2xl font-bold my-6 text-center">Shop Our Collection</h2>

    <!-- Category Navigation -->
    <nav class="flex justify-center space-x-4 bg-gray-100 p-4 rounded-lg shadow-md mb-6">
        <!-- All Categories Button -->
        <a href="{{ route('shop') }}" 
           class="px-3 py-2 rounded-md shadow-sm font-semibold transition 
                  {{ request('category') ? 'bg-white text-gray-700 hover:bg-indigo-100' : 'bg-indigo-600 text-white' }}">
            All Categories
        </a>
    
        <!-- Category Links -->
        @foreach ($categories as $category)
            <a href="{{ route('shop', ['category' => $category->slug]) }}" 
               class="px-3 py-2 rounded-md shadow-sm font-semibold transition 
                      {{ $selectedCategory  == $category->slug ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </nav>
    

    <!-- Products Grid -->
    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>

    @if ($products->isEmpty())
        <p class="text-center text-gray-500 mt-6">No products available in this category.</p>
    @endif

    <!-- Pagination (Preserve category filter) -->
    <div class="mt-6 flex justify-center">
        {{ $products->appends(['category' => request('category')])->links() }}
    </div>
</main>
@endsection
