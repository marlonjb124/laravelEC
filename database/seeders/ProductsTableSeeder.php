<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Crear 2 productos de cualquier categoría
        Product::factory()->count(2)->create();

        // Crear 3 productos de la categoría Manualidades
        Product::factory()->count(3)->create([
            'category' => 'Manualidades'
        ]);

        // Crear 6 productos de la categoría Materiales de Construcción
        Product::factory()->count(6)->create([
            'category' => 'Materiales de Construccion'
        ]);
    }
}

