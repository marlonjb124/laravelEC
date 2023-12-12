<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\CartController;
use App\Models\CartProduct;
use Illuminate\Http\Request;
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
        // $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $user = $request->user();
        $user_id = $user->id;

        try {
            $cart = Cart::where('user_id', $user_id)->first();
           

            if (!$cart) {
                echo('carrito');
                // return response()->json(['error' => 'Cart not found'], 404);
                $newcart = Cart::create(["user_id"=>$user_id,]);
                $cart = $newcart;
            }

            $newProductToCart = CartProduct::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);

            return response()->json($newProductToCart);
        } catch (\Exception $e) {
            // Manejar el error
            // echo 'Error: ' . $e->getMessage();
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
