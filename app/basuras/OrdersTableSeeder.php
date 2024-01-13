<?php

namespace Database\Seeders;

use App\Models\Orden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Orden::factory()->count(5)->create();
    }
}
