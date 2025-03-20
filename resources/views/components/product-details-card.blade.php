@vite(['resources/js/app.js','resources/css/app.css'])
    <div class="container mx-auto px-4 py-12">
       

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div>
                <div class="relative w-full h-[400px] rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . 'images/clothes3.jpg')}}" alt="Product Image" class="w-full h-full object-cover">
                </div>
                <div class="flex mt-4 space-x-2">
                    <img src="/img/product/details/thumb-1.jpg" class="w-20 h-20 rounded-lg cursor-pointer">
                    <img src="/img/product/details/thumb-2.jpg" class="w-20 h-20 rounded-lg cursor-pointer">
                    <img src="/img/product/details/thumb-3.jpg" class="w-20 h-20 rounded-lg cursor-pointer">
                    <img src="/img/product/details/thumb-4.jpg" class="w-20 h-20 rounded-lg cursor-pointer">
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Essential Structured Blazer</h1>
                <p class="text-sm text-gray-500">Brand: SKMEI</p>
                <div class="flex items-center mt-2">
                    <div class="text-yellow-400 text-lg">★★★★★</div>
                    <span class="ml-2 text-gray-500 text-sm">(138 reviews)</span>
                </div>
                <div class="text-2xl font-semibold text-gray-900 mt-2">₹ 75.00 <span class="text-gray-400 text-lg line-through">$83.00</span></div>
                <p class="text-gray-600 mt-4">Nemo enim ipsam voluptatem quia aspernatur aut odit fugit, sed quia consequuntur magni eos.</p>

                <div class="mt-4">
                    <span class="font-semibold">Quantity:</span>
                    <input type="number" class="w-16 p-2 border rounded-md ml-2" value="1">
                </div>

                <div class="mt-6 flex space-x-4">
                    <button class="bg-[#14C4A3] text-white px-6 py-3 rounded-lg hover:bg-[#0fa58d] transition">Add to Cart</button>
                    <button class="bg-gray-200 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-300 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25C3 5.35 5.35 3 8.25 3c1.26 0 2.47.48 3.38 1.35L12 5.12l.37-.37A4.75 4.75 0 0 1 15.75 3C18.65 3 21 5.35 21 8.25c0 2.2-1.32 4.17-3.38 5.5L12 21l-5.62-7.25C4.32 12.42 3 10.45 3 8.25z"/>
                        </svg>
                    </button>
                </div>

                <div class="mt-6 text-sm">
                    <p><span class="font-semibold">Availability:</span> <span class="text-green-600">In Stock</span></p>
                    {{-- <p><span class="font-semibold">Colors:</span> <span class="inline-block w-5 h-5 bg-red-500 rounded-full ml-2"></span> <span class="inline-block w-5 h-5 bg-black rounded-full ml-2"></span> <span class="inline-block w-5 h-5 bg-gray-500 rounded-full ml-2"></span></p> --}}
                    {{-- <p><span class="font-semibold">Sizes:</span> XS, S, M, L</p> --}}
                    <p><span class="font-semibold">Promotion:</span> Free Shipping</p>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mt-12 border-t pt-6">
            <div class="flex space-x-8 text-lg">
                <button class="text-[#14C4A3] font-semibold">Description</button>
                {{-- <button class="text-gray-500">Specification</button> --}}
                {{-- <button class="text-gray-500">Reviews (2)</button> --}}
            </div>
            <p class="mt-4 text-gray-600">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
        </div>
    </div>

