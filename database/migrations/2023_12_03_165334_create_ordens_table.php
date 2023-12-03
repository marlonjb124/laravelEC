<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->id('orden_id');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('CASCADE');
            $table->date('date')->nullable();
            $table->string('estado', 20);
           
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden');
    }
};

