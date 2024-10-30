<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(['create tasks','edit tasks', 'delete tasks']);

        $tecnico = Role::create(['name' => 'Tecnico']);
        $tecnico->givePermissionTo(['edit tasks']);
    }
}
