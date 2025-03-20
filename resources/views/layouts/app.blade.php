
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Store</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    

</head>

<body class="bg-gray-100 font-sans">

   
    <x-nav-link></x-nav-link>

    <main>

        {{-- here the page content to be shown will be injected from @section('content') --}}
        @yield('content')
    </main>
    <!-- Hero Section -->
  

    <!-- Footer -->
    <x-footer></x-footer>

</body>
</html>