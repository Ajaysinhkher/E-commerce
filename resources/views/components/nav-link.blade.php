<!-- Navigation Bar -->
<nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center relative">
    <div class="flex items-center space-x-2">
        <i class="uil uil-shopping-bag text-blue-600 text-2xl"></i>
        <span class="text-xl font-semibold">Shopper</span>
    </div>

    <!-- Search Bar -->
    <div class="relative w-1/3">
        <input type="text" placeholder="Search for products..." class="w-full py-2 px-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400">
        <i class="uil uil-search absolute right-4 top-3 text-gray-500 cursor-pointer"></i>
    </div>

    <ul class="flex space-x-6 text-gray-600 items-center">
        <li><a href="{{ route('home') }}" class="hover:text-black">Home</a></li>
        <li><a href="{{ route('shop') }}" class="hover:text-black">Shop</a></li>
        <li><a href="#" class="hover:text-black">Contact</a></li>

        <!-- Wishlist and Cart -->
        <li class="relative">
            <i class="uil uil-heart text-gray-600 text-xl cursor-pointer"></i>

            <a href="{{ route('cart.index') }}" class="relative">
                <i class="uil uil-shopping-cart text-gray-600 text-2xl cursor-pointer"></i>
                <span id="cart-count" class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 
                bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center" 
                style="display: {{ session('cart') ? 'inline-block' : 'none' }};">
                {{ array_sum(array_column(session('cart', []), 'quantity')) }}

                {{-- array_column(session('cart',[]),'quantity') gets the 'quantity' value from the array stored in session and sum them up --}}
            </span>
                     
            </a>
        </li>

        <!-- Toggle Login/Logout -->
        @if(auth('customer')->check())
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
