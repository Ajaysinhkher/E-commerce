<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        try {
            $cart = $this->cartService->getCart();
            return view('cart', ['cartItems' => $this->cartService->getCart()]);
        } catch (Exception $e) {
            Log::error('CartController@index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load cart.');
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $this->cartService->addToCart($product);

            return response()->json([
                'success' => true,
                'cartCount' => $this->cartService->getTotalQuantity(),
                'message' => 'Item added to cart'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('CartController@addToCart: Product not found - ID: ' . $request->id);
            return response()->json(['success' => false, 'message' => 'Product not found!'], 404);
        } catch (Exception $e) {
            Log::error('CartController@addToCart Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to add item.'], 500);
        }
    }

    public function removeFromCart($id)
    {
        try {
            $this->cartService->removeFromCart($id);
    
            return response()->json([
                'success' => true,
                'cartCount' => $this->cartService->getTotalQuantity(),
                'getTotal' => $this->cartService->getTotalPrice(),
                'message' => 'Item removed from cart'
            ]);

        } catch (Exception $e) {
            Log::error('CartController@removeFromCart Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to remove item.'], 500);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $id = $request->id;
            $action = $request->action;
    
            if ($action === 'increase') {
                $this->cartService->increaseQuantity($id);
            } elseif ($action === 'decrease') {
                $this->cartService->decreaseQuantity($id);
            }

            return response()->json([
                'success' => true,
                'getTotal' => $this->cartService->getTotalPrice(),
                'getTotalQuantity' => $this->cartService->getTotalQuantity(),
            ]);
        } catch (Exception $e) {
            Log::error('CartController@updateCart Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update cart.'], 500);
        }
    }

    public function clearCart()
    {
        try {
            $this->cartService->clearCart();
            return redirect()->route('cart.index')->with('success', 'Cart cleared!');
        } catch (Exception $e) {
            Log::error('CartController@clearCart Error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Failed to clear cart.');
        }
    }
}
