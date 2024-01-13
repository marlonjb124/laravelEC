<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(2),
            'description' => $this->faker->text(10),
            'stock' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'habilitado' => $this->faker->boolean(),
            'cantVentas' => 0, // Puedes usar randomNumber para números enteros
            'actualPrice' => $this->faker->randomNumber(2), // Puedes ajustar el rango según tus necesidades
            "descuento"=> $this->faker->randomNumber(2)
        ];
    }
}
