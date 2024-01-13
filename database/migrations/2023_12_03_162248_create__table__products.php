<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->string('name', 100);
            $table->integer('price');
            $table->string('description', 30);
            $table->integer("descuento");
            $table->integer("actualPrice")->nullable();
            $table->integer('stock');
            $table->string('category', 30);
            $table->string('image', 300);
            $table->boolean("habilitado");
            $table->integer("cantVentas");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};