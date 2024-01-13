<?php

// database/seeders/OrdenSeeder.php

namespace Database\Seeders;

use App\Models\Orden;
use Illuminate\Database\Seeder;

class OrdenTableSeeder extends Seeder
{
    public function run()
    {
        Orden::factory()->count(25)->create();
    }
}
