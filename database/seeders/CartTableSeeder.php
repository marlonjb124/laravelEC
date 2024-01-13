<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartTableSeeder extends Seeder
{
    public function run()
    {
        Cart::factory()->count(25)->create(); 
    }
}
