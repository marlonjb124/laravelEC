<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\CartProduct;

class CartProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que la tabla esté vacía antes de comenzar
        CartProduct::truncate();

        // Crea 50 registros de CartProduct
        CartProduct::factory()->count(25)->create(); 
    }
}
