<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        $userIds = User::doesntHave('cart')->pluck('id')->toArray();

        if (empty($userIds)) {
            // Si todos los usuarios ya tienen un carrito, no creamos más.
            return [];
        }

        return [
            'user_id' => $this->faker->unique()->randomElement($userIds),
        ];
    }
}
