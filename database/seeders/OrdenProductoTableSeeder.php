<?php

// database/seeders/OrdenProductoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenProducto;

class OrdenProductoTableSeeder extends Seeder
{
    public function run()
    {
        // Ajusta la cantidad según tus necesidades
        OrdenProducto::factory()->count(30)->create();
    }
}

