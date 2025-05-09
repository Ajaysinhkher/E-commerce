<!-- Navigation Bar -->
<nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center relative">
    <div class="flex items-center space-x-2">
        <i class="uil uil-shopping-bag text-blue-600 text-2xl"></i>
        <span class="text-xl font-semibold">Shopper</span>
    </div>

    <!-- Search Bar -->
    <form id="searchForm" class="relative w-1/3">
        <input 
            type="text" 
            name="query" 
            id="searchInput" 
            class="w-full py-2 px-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
            placeholder="Search for products..." 
            autocomplete="off"
        >
            <i class="uil uil-search absolute right-4 top-3 text-gray-500 pointer-events-none"></i>

        <!-- Search Results Modal -->
        <div id="searchResultsModal" class="absolute bg-white shadow-lg rounded mt-1 w-full z-50 hidden max-h-80 overflow-y-auto"></div>
    </form>

    <ul class="flex space-x-6 text-gray-600 items-center">
        <li><a href="{{ route('home') }}" class="hover:text-black">Home</a></li>
        <li><a href="{{ route('shop') }}" class="hover:text-black">Shop</a></li>
        <li><a href="{{ route('contact','contact') }}" class="hover:text-black">Contact</a></li>    

        <!-- Wishlist and Cart -->
        <li class="relative">
            <!-- Commented out Wishlist -->
            <!-- <i class="uil uil-heart text-gray-600 text-xl cursor-pointer"></i> -->

            <a href="{{ route('cart.index') }}" class="relative">
                <i class="uil uil-shopping-cart text-gray-600 text-2xl cursor-pointer"></i>
                <span id="cart-count" class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 
                bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center" 
                style="display: {{ session('cart') ? 'inline-block' : 'none' }};">
                {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                </span>
            </a>
        </li>

        <!-- Toggle Login/Logout and Profile -->
        @if(auth('customer')->check())
        <li>
            <a href="{{ route('user.profile') }}" class="flex items-center space-x-1 hover:text-black">
                <i class="uil uil-user text-gray-600 text-xl"></i>
            </a>
        </li>
            <li>
                <form method="POST" action="{{ route('customer.logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-black">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('customer.login') }}" class="hover:text-black">Login</a></li>
        @endif
    </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const searchResultsModal = document.getElementById("searchResultsModal");
    
        let debounceTimeout;
    
        searchInput.addEventListener("input", function () {
            const query = this.value.trim();
    
            clearTimeout(debounceTimeout);
    
            if (query.length < 2) {
                searchResultsModal.classList.add("hidden");
                searchResultsModal.innerHTML = "";
                return;
            }
    
            debounceTimeout = setTimeout(() => {
                fetch(`/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        searchResultsModal.innerHTML = html;
                        searchResultsModal.classList.remove("hidden");
                    })
                    .catch(err => {
                        searchResultsModal.innerHTML = '<div class="p-2 text-red-500">Error fetching results.</div>';
                        searchResultsModal.classList.remove("hidden");
                    });
            }, 300); // debounce delay
        });
    
        // Hide modal when clicking outside
        document.addEventListener("click", function (e) {
            if (!searchInput.contains(e.target) && !searchResultsModal.contains(e.target)) {
                searchResultsModal.classList.add("hidden");
            }
        });
    });
</script>