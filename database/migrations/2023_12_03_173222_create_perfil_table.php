<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->nullable();
            $table->string('surname', 30)->nullable();
            $table->string('address', 30)->nullable();
            $table->integer('phone')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('credit_card')->nullable();
            $table->string('profile_pic', 300)->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    public function down():void
    {
        Schema::dropIfExists('perfiles');
    }
};
