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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->unsignedBigInteger('tarea_tecnico_id'); // Llave foránea hacia tarea_tecnico
            $table->timestamps();

            // Definir clave foránea para tarea_tecnico_id
            $table->foreign('tarea_tecnico_id')->references('id')->on('tarea_tecnico')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
