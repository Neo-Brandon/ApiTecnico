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
            $table->string('image_path_1')->nullable(); // Ruta de imagen 1
            $table->string('image_path_2')->nullable(); // Ruta de imagen 2
            $table->string('image_path_3')->nullable(); // Ruta de imagen 3
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
