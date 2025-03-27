<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"> --}}

</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white p-5 flex flex-col">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3 mb-6">
                <i class="uil uil-shopping-bag text-blue-600 text-2xl"></i>
                <span class="text-xl font-semibold">Shopper</span>
            </div>

            <!-- Navigation -->
            <ul class="flex-1 space-y-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-chart-line text-lg"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-box text-lg"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-list-ul text-lg"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-users-alt text-lg"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-shopping-cart text-lg"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded">
                        <i class="uil uil-star text-lg"></i>
                        <span>Pages</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="flex items-center space-x-2 p-2 text-red-400 hover:text-red-500">
                    <i class="uil uil-signout text-lg"></i>
                    <span>Logout</span>
                </button>
            </form>
            
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <header class="bg-white p-4 shadow rounded-lg flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-700">Admin Dashboard</h1>
            </header>

            <div class="mt-6">
                @yield('content')
            </div>
            
        </main>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  
   @stack('scripts')
   

  
   
</body>
</html>
