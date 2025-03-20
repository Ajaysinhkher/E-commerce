@vite(['resources/js/app.js','resources/css/app.css'])
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<div class="relative min-h-screen flex items-center justify-center bg-gray-100">

    <div class="relative z-10 w-full max-w-4xl bg-white rounded-lg shadow-lg flex overflow-hidden">
        
        <!-- Left Section with Background Image -->
        <div class="w-1/2 relative bg-cover bg-center bg-no-repeat" 
            style="background-image: url('{{ asset('storage/images/clothes1.jpg') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Dark overlay for readability -->
            <div class="relative z-10 flex flex-col justify-center p-8 text-white text-center">
                <h2 class="text-3xl font-bold">Welcome Back!</h2>
                {{-- <p class="mt-4 text-sm">Manage your store efficiently with our powerful admin tools.</p> --}}
            </div>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="w-1/2 p-8">
            <div class="text-center">
                <i class="uil uil-shopping-bag text-blue-500 text-3xl"></i>
                <h1 class="text-2xl text-black font-bold">Shopper</h1>
                <p class="mt-2 text-sm text-gray-700">Please login to your account</p>
            </div>

            <form class="mt-6 space-y-4" action="/login" method="POST">
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
                    <a href="#" class="text-sm text-blue-500 hover:text-red-600 float-right mt-2">Forgot password?</a>
                </div>

                <div>
                    <button type="submit"
                        class="w-full rounded-md bg-teal-500 px-4 py-3 mt-1 text-white font-semibold shadow-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-700">
                Don't have an account? <a href="/register" class="font-semibold text-blue-500 hover:text-red-600">Register</a>
            </p>
        </div>
    </div>
</div>
