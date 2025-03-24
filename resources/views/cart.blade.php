@extends('layouts.app')

@section('content')

<div class="flex flex-col min-h-screen bg-gray-50">
    <div class="flex-1 w-full max-w-6xl mx-auto py-10 px-4">
        <div class="flex flex-col lg:flex-row items-start gap-8">
            <div class="lg:w-2/3 w-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Your Cart</h2>
                    <form method="POST" action="{{ route('cart.clear') }}" id="clear-cart">
                        @csrf
                        <button type="submit" class="text-red-600 border border-red-500 px-4 py-2 rounded-lg hover:bg-red-500 hover:text-white transition">
                            Clear Cart
                        </button>
                    </form>
                </div>
                
                <div class="space-y-6" id="cart-items">
                    @foreach ($cartItems as $id => $cart)
                        <div class="cart-item flex items-center justify-between bg-white p-4 rounded-lg shadow-md border" data-id="{{ $id }}">
                            <div class="flex items-center gap-4">
                                <img loading="lazy" src="{{ asset('storage/' . $cart['image']) }}" alt="{{ $cart['name'] }}" class="w-20 h-20 object-cover rounded-md">
                                <div>
                                    <h3 class="text-md font-semibold text-gray-900">{{ $cart['name'] }}</h3>
                                    <p class="text-gray-700 text-sm">₹{{ number_format($cart['price'], 2) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <!-- Decrease Quantity -->
                                <button class="decrease-qty text-gray-500 hover:text-black transition px-2 py-1 border rounded">
                                    -
                                </button>
                                <span class="quantity text-md font-semibold text-gray-900">{{ $cart['quantity'] }}</span>
                                <!-- Increase Quantity -->
                                <button class="increase-qty text-gray-500 hover:text-black transition px-2 py-1 border rounded">
                                    +
                                </button>
                            </div>

                            <button class="remove-item text-red-500 hover:text-red-700 transition">
                                <i class="uil uil-trash-alt text-xl"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:w-1/3 w-full">
                <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-md sticky top-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-5">Cart Summary</h3>
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-lg font-medium text-gray-700">Total:</p>
                        <p class="text-2xl font-bold text-blue-600" id="cart-total">
                            ₹{{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)) }}
                        </p>
                    </div>
                    <div class="space-y-4">
                        <a href="/checkout" class="block w-full px-5 py-3 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-all text-sm font-medium text-center">
                            Proceed to Checkout
                        </a>
                        <a href="/shop" class="block w-full px-5 py-3 text-gray-800 border border-gray-400 rounded-lg hover:bg-gray-200 transition-all text-sm font-medium text-center">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  
  function updateCartTotal(total) {
  
      $("#cart-total").text("₹" + total.toFixed(2));
  } 

  // Function to update cart count in navbar
  function updateCartCount(cartCount) {
      let cartCountElement = $("#cart-count");
      if (cartCount > 0) {
          cartCountElement.text(cartCount).show();
      } else {
          cartCountElement.hide();
      }
  }

  // Increase Quantity
  $(document).on("click", ".increase-qty", function(e) {
      e.preventDefault();
      let cartItem = $(this).closest(".cart-item");
      let id = cartItem.data("id");
      let quantitySpan = cartItem.find(".quantity");
      let currentQty = parseInt(quantitySpan.text());

      $.ajax({
          url: "{{ route('cart.update') }}",
          type: "POST",
          data: {
              id: id,
              action: "increase",
              _token: "{{ csrf_token() }}"
          },
          success: function(data) {
              if (data.success) {
                  quantitySpan.text(currentQty + 1);
                //   console.log(data.getTotal);
                  updateCartTotal(data.getTotal);
                  updateCartCount(data.getTotalQuantity); // Update cart count in navbar
              }
          }
      });
  });

  // Decrease Quantity
  $(document).on("click", ".decrease-qty", function(e) {
      e.preventDefault();
      let cartItem = $(this).closest(".cart-item");
      let id = cartItem.data("id");
      let quantitySpan = cartItem.find(".quantity");
      let currentQty = parseInt(quantitySpan.text());

      if (currentQty > 1) {
          $.ajax({
              url: "{{ route('cart.update') }}",
              type: "POST",
              data: {
                  id: id,
                  action: "decrease",
                  _token: "{{ csrf_token() }}"
              },
              success: function(data) {
                  if (data.success) {
                      quantitySpan.text(currentQty - 1);
                      
                      updateCartTotal(data.getTotal);
                      updateCartCount(data.getTotalQuantity); // Update cart count in navbar
                  }
              }
          });
      }
  });

  // Remove Item
  $(document).on("click", ".remove-item", function() {
      let cartItem = $(this).closest(".cart-item");
      let id = cartItem.data("id");

      $.ajax({
          url: `{{ route('cart.remove', ':id') }}`.replace(':id', id),
          type: "POST",
          data: {
              id: id,
              _token: "{{ csrf_token() }}"
          },
          success: function(data) {
            if (data.success) {
                cartItem.remove(); // Remove the item from the UI
                updateCartTotal(data.getTotal);
                updateCartCount(data.cartCount); // Update cart count in navbar
            }
          }
      });
  });

});

</script>

@endsection
