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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', length:100);
            $table->text('descripcion');
            // Cambiar el campo categoria a unsignedBigInteger para la clave foránea
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('estado_id')->default(1); // Añadir campo estado_id con valor por defecto
            $table->timestamps();

             // Definir la clave foránea
             $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

             // Conexion con tabla estados
             $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['estado_id']);
        });

        //Eliminamos la veriicacion de llaves foraneas para borrar
        Schema::disableForeignKeyConstraints();
        // Luego elimina la tabla tareas
        Schema::dropIfExists('tareas');
        //reactivamos las verificaciones para integridad
        Schema::enableForeignKeyConstraints();
    }
};
