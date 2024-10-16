<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['nombre_estado' => 'Pendiente'], // Gris
            ['nombre_estado' => 'Completada'], // Verde
            ['nombre_estado' => 'Pospuesta'], // Amarillo
        ]);
    }
}
