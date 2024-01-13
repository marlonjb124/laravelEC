<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartProductController extends Controller
{
    public function getProductsByCartId($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            // Manejar caso cuando no existe el carrito
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $products = CartProduct::where('cart_id', $cart->cart_id)->get();

        return response()->json($products);
    }

 
    
    public function addToCart(Request $request)
    {
        try {
            $user = Auth::user();
    
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            $user_id = $user->id;
            $product_id = $request->input('product_id');
            $quantity = $request->input('quantity');
    
            $cart = Cart::where('user_id', $user_id)->first();
    
            if (!$cart) {
                // Si no hay carrito, crea uno nuevo
                $cart = Cart::create([
                    'user_id' => $user_id,
                ]);
                echo($cart);
            }
    
            // Agrega el producto al carrito
            $newProductToCart = CartProduct::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
    
            return response()->json($newProductToCart, 201);
        } catch (\Exception $e) {
            // Imprime el mensaje de error para depuración
            // Log::error($e->getMessage()); // Descomentar para registrar el error en los logs
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function removeAllProductsFromCart(Request $request)
{
    try {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user_id = $user->id;

        // Busca el carrito del usuario
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Elimina todos los productos del carrito
        CartProduct::where('cart_id', $cart->cart_id)->delete();

        return response()->json(['message' => 'All products removed from cart']);
    } catch (\Exception $e) {
        // Imprime el mensaje de error para depuración
        // Log::error($e->getMessage()); // Descomentar para registrar el error en los logs
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

public function removeProductFromCart(Request $request, $productId)
{
    try {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user_id = $user->id;

        // Busca el carrito del usuario
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Busca el producto en el carrito
        $cartProduct = CartProduct::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->first();

        if (!$cartProduct) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        // Elimina el producto del carrito
        $cartProduct->delete();

        return response()->json(['message' => 'Product removed from cart']);
    } catch (\Exception $e) {
        // Imprime el mensaje de error para depuración
        // Log::error($e->getMessage()); // Descomentar para registrar el error en los logs
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

    
}
