<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
         
        

        // Cambiar el nombre de la columna
        // $table->renameColumn('name', 'username');

        // // Volver a aplicar la restricción unique
        // $table->unique('username');
            
            $table->string('password',200)->change();
            $table->string("rol",30)->change();
            $table->string("api_token", 200)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};