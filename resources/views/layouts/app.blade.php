
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>eCommerce Store</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

   
    <x-nav-link></x-nav-link>

    <main class="flex-grow">

        {{-- here the page content to be shown will be injected from @section('content') --}}
        @yield('content')
    </main>
    <!-- Hero Section -->
  

    <!-- Footer -->
    {{-- <x-footer :footer-content="$footerContent" ></x-footer> --}}
    <x-footer></x-footer>
    
    <x-toast />
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function(e) {
                e.preventDefault(); 
                e.stopPropagation(); 
                let productId = $(this).data("id");
                console.log("Product ID:", productId);

                // ajax request will send teh data: to CartController using defined route and will wait for json response
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: { 
                        id: productId, 
                        quantity: 1, 
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                   
                    success: function(response) {
                        if (response.success) {
                            updateCartCount(response.cartCount);
                            showToast(response.message,'success',2000);
                            // Show alert once
                        } else {
                            alert("Error adding to cart!");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        console.log("XHR Response:", xhr.responseText);
                    }
                });
            });
        });

        function updateCartCount(count) {
        let cartCountElement = $("#cart-count");
        if (cartCountElement.length) {
            if (count > 0) {
                cartCountElement.text(count);
                cartCountElement.show(); // Show when count is greater than 0
            } else {
                cartCountElement.hide(); // Hide when count is 0
            }
          }
        }

        @if(session('success'))
        showToast("{{ session('success') }}",'success',3000);
        @endif
        </script>


       
</body>


</html>