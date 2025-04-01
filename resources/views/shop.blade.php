@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-full py-5 px-6">
    <!-- Page Heading -->
    <h2 class="text-2xl font-bold my-6 text-center">Shop Our Collection</h2>

    <!-- Category Filter -->
    <div class="flex flex-wrap justify-center mb-6 gap-4">
        <!-- Select All checkbox -->
        <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
            <input type="checkbox" id="select-all" class="category-checkbox" />
            <span>Select All</span>
        </label>

        @foreach ($categories as $category)
            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <input type="checkbox" name="categories[]" value="{{ $category->slug }}" class="category-checkbox"
                    @if(in_array($category->slug, $selectedCategory)) checked @endif>
                <span>{{ $category->name }}</span>
            </label>
        @endforeach
    </div>

    <!-- Products Grid -->
    <section id="products-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>

    @if ($products->isEmpty())
        <p class="text-center text-gray-500 mt-6">No products available in this category.</p>
    @endif

    <!-- Pagination (Preserve category filter) -->
    <div id="pagination" class="mt-6 flex justify-center">
        {{ $products->appends(['category' => request('category')])->links() }}
    </div>
</main>

<script>
    // Function to update the "Select All" checkbox state
    function updateSelectAllCheckboxState() {
        const checkboxes = document.querySelectorAll('.category-checkbox:not(#select-all)');
        const selectAllCheckbox = document.getElementById('select-all');

        // Check if all checkboxes are selected
        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
        selectAllCheckbox.checked = allChecked;

        // If none of the checkboxes are selected, uncheck "Select All"
        selectAllCheckbox.indeterminate = !allChecked && Array.from(checkboxes).some(checkbox => checkbox.checked);
    }

    // Handle category checkbox change
    document.querySelectorAll('.category-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.id === 'select-all') {
                // If "Select All" is changed, select/deselect all other checkboxes
                document.querySelectorAll('.category-checkbox:not(#select-all)').forEach(catCheckbox => {
                    catCheckbox.checked = this.checked;
                });
            }

            // Get selected categories
            let selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked:not(#select-all)')).map(cb => cb.value);

            // Send AJAX request to fetch filtered products
            fetchProducts(selectedCategories);
            updateSelectAllCheckboxState();
        });
    });

    // Function to fetch products based on selected categories
    function fetchProducts(selectedCategories) {
        let url = new URL(window.location.href);
        url.searchParams.set('category', selectedCategories.join(','));
        history.pushState(null, '', url);

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the product grid with new products
            document.getElementById('products-grid').innerHTML = data.products;

            // Update pagination
            document.getElementById('pagination').innerHTML = data.pagination;
        })
        .catch(error => console.error('Error fetching products:', error));
    }

    // Initial state update for "Select All" checkbox based on pre-selected categories
    updateSelectAllCheckboxState();
</script>
@endsection
