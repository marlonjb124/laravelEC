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
        //public function up(): void
    
        Schema::table('users', function (Blueprint $table) {
         
        

        // Cambiar el nombre de la columna
        // $table->renameColumn('name', 'username');

        // // Volver a aplicar la restricción unique
        // $table->unique('username');
            // $table->dropColumn("remember_token");
            $table->string("api_token")->after("password")->nullable()->change();
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
