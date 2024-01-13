<?php

// database/factories/OrdenProductoFactory.php

namespace Database\Factories;


use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenProductoFactory extends Factory
{
    protected $model = OrdenProducto::class;

    public function definition()
    {
        // Obtén una orden aleatoria
        $orden = Orden::inRandomOrder()->first();

        // Obtén un producto aleatorio
        $product = Product::inRandomOrder()->first();

        return [
            'orden_id' => $orden->orden_id,
            'product_id' => $product->product_id,
        ];
    }
}
