<?php

namespace Database\Seeders;

use App\Models\Orden;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Orden::all()->each(function ($order) {
            $order->products()->attach(Product::inRandomOrder()->take(rand(1, 5))->pluck('id')->toArray());
        });
    }
}
