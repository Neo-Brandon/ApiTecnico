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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', length: 35);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Eliminamos la veriicacion de llaves foraneas para borrar
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('categorias');
        //reactivamos las verificaciones para integridad
        Schema::enableForeignKeyConstraints();
    }
};
