@vite(['resources/js/app.js','resources/css/app.css'])
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<div class="relative min-h-screen flex items-center justify-center bg-gray-100">
    <div class="relative z-10 w-full max-w-4xl bg-white rounded-lg shadow-lg flex overflow-hidden">
        <!-- Left Section with Background Image -->
        <div class="w-1/2 relative bg-cover bg-center bg-no-repeat" 
            style="background-image: url('{{ asset('storage/images/admin-bg.jpg') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 flex flex-col justify-center p-8 text-white text-center">
                <h2 class="text-3xl font-bold">Admin Panel</h2>
                <p class="mt-4 text-sm">Manage your store efficiently with our powerful admin tools.</p>
            </div>
        </div>

        <!-- Right Section (Admin Login Form) -->
        <div class="w-1/2 p-8">
            <div class="text-center">
                <i class="uil uil-user-shield text-blue-500 text-3xl"></i>
                <h1 class="text-2xl text-black font-bold">Admin Login</h1>
                <p class="mt-2 text-sm text-gray-700">Please login to access the dashboard</p>
            </div>

            <form class="mt-6 space-y-4" action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800">Email address</label>
                    <input type="email" id="email" name="email" required 
                        class="mt-1 block w-full rounded-md border border-gray-300 p-3 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border border-gray-300 p-3 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                        <span class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer">
                            🔒
                        </span>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full rounded-md bg-teal-500 px-4 py-3 mt-1 text-white font-semibold shadow-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-700">
                <a href="#" class="font-semibold text-blue-500 hover:text-red-600">Forgot password?</a>
            </p>
        </div>
    </div>
</div>
