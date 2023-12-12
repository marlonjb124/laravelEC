<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id(); // Por defecto, asume que se llamará 'id'
            $table->foreignId('cart_id')->constrained('cart', 'cart_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->integer('quantity');
            // Puedes agregar más campos según sea necesario
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('cart_product');
    }
};

