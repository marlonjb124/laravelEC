<?php
// database/factories/CartProductFactory.php

namespace Database\Factories;

use App\Models\CartProduct;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartProductFactory extends Factory
{
    protected $model = CartProduct::class;

    public function definition()
    {
        // Obtén un carrito aleatorio
        $cart = Cart::inRandomOrder()->first();

        // Obtén un producto aleatorio
        $product = Product::inRandomOrder()->first();

        return [
            'cart_id' => $cart->cart_id,
            'product_id' => $product->product_id,
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
