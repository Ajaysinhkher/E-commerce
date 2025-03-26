@vite(['resources/js/app.js','resources/css/app.css'])
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<div class="relative min-h-screen flex items-center justify-center bg-gray-100">
    <div class="relative z-10 w-full max-w-3xl bg-white rounded-lg shadow-lg flex overflow-hidden">
        
        <!-- Left Section with Background Image -->
        <div class="w-1/2 relative bg-cover bg-center bg-no-repeat" 
            style="background-image: url('{{ asset('storage/images/clothes1.jpg') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 flex flex-col justify-center p-6 text-white text-center">
                <h2 class="text-2xl font-bold">Join Us Today!</h2>
            </div>
        </div>

        <!-- Right Section (Registration Form) -->
        <div class="w-1/2 p-6">
            <div class="text-center">
                <i class="uil uil-user-plus text-blue-500 text-2xl"></i>
                <h1 class="text-xl text-black font-bold">Create an Account</h1>
                <p class="mt-1 text-sm text-gray-700">Sign up to start shopping</p>
            </div>


            <form class="mt-4 space-y-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="user_name" class="block text-sm font-medium text-gray-800">Full Name</label>
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                    @error('user_name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-800">Contact Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                    @error('phone')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                        <span class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer">
                            🔒
                        </span>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-800">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 text-gray-900 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-300">
                </div>
            
                <div>
                    <button type="submit"
                        class="w-full rounded-md bg-teal-500 px-4 py-2 text-white font-semibold shadow-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                        Register
                    </button>
                </div>
            </form>
            

            <p class="mt-4 text-center text-sm text-gray-700">
                Already have an account? <a href="{{ route('customer.login') }}" class="font-semibold text-blue-500 hover:text-red-600">Login</a>
            </p>
        </div>
    </div>
</div>
