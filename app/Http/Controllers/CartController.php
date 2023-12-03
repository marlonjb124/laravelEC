<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function createCart(Request $request)
    {
        $user_id = $request->input('user_id');

        $newCart = Cart::create([
            'user_id' => $user_id,
        ]);

        return response()->json($newCart);
    }

    public function getCart($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            // Manejar caso cuando no existe el carrito
            return response()->json(['error' => 'Cart not found'], 404);
        }

        return response()->json($cart);
    }
}
