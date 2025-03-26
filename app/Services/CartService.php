<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Exception;

class CartService
{
    protected $cartKey = 'cart';

    // Get all cart items
    public function getCart()
    {
        try {
            return Session::get($this->cartKey, []);

        } catch (Exception $e) {
            return ['error' => 'Failed to retrieve cart: ' . $e->getMessage()];
        }
    }

    // Get total quantity
    public function getTotalQuantity()
    {
        try {
            return array_sum(array_column(session($this->cartKey, []), 'quantity'));
        } catch (Exception $e) {
            return 0;
        }
    }

    // Add item to cart
    public function addToCart($product)
    {
    try {
        $cart = $this->getCart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;

        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,  // Ensure ID is included
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        Session::put($this->cartKey, $cart);
    } catch (Exception $e) {
        return ['error' => 'Failed to add product to cart: ' . $e->getMessage()];
    }
}

    // Remove item from cart
    public function removeFromCart($productId)
    {
        try {
            $cart = $this->getCart();

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                Session::put($this->cartKey, $cart);
            }
        } catch (Exception $e) {
            return ['error' => 'Failed to remove product from cart: ' . $e->getMessage()];
        }
    }

    // Increase cart quantity
    public function increaseQuantity($productId)
    {
        try {
            $cart = $this->getCart();

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += 1;
                Session::put($this->cartKey, $cart);
                Session::save();
            }
        } catch (Exception $e) {
            return ['error' => 'Failed to increase quantity: ' . $e->getMessage()];
        }
    }

    // Decrease cart quantity
    public function decreaseQuantity($productId)
    {
        try {
            $cart = $this->getCart();

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] -= 1;
                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
                }
                Session::put($this->cartKey, $cart);
                Session::save();
            }
        } catch (Exception $e) {
            return ['error' => 'Failed to decrease quantity: ' . $e->getMessage()];
        }
    }

    // Clear cart
    public function clearCart()
    {
        try {
            Session::forget($this->cartKey);
        } catch (Exception $e) {
            return ['error' => 'Failed to clear cart: ' . $e->getMessage()];
        }
    }

    // Get total price
    public function getTotalPrice()
    {
        try {
            $cart = $this->getCart();
            return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        } catch (Exception $e) {
            return 0;
        }
    }
}
