
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
    

</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

   
    <x-nav-link></x-nav-link>

    <main class="flex-grow">

        {{-- here the page content to be shown will be injected from @section('content') --}}
        @yield('content')
    </main>
    <!-- Hero Section -->
  

    <!-- Footer -->
    <x-footer></x-footer>
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function(e) {
                e.preventDefault(); 
                e.stopPropagation(); 
                let productId = $(this).data("id");
                console.log("Product ID:", productId);

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
                            
                            // Show alert once
                            if (!$(".cart-alert").length) {
                                $("body").append('<div class="cart-alert fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-md">Item added to cart</div>');
                                
                                setTimeout(function() {
                                    $(".cart-alert").fadeOut(500, function() { $(this).remove(); });
                                }, 2000);
                            }
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


    
        </script>
</body>
</html>