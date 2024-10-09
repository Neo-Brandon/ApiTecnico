<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permisos')->insert([
            ['tipo_permiso' => 'Administrador'],
            ['tipo_permiso' => 'Tecnico'],
            ['tipo_permiso' => 'Servicio_social'],
        ]);
    }
}
