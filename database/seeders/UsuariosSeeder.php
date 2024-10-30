<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        // Crear los roles de técnico y administrador si no existen
        /*
        if (Role::where('name', 'Tecnico')->doesntExist()) {
            Role::create(['name' => 'tecnico']);
        }

        if (Role::where('name', 'Administrador')->doesntExist()) {
            Role::create(['name' => 'Administrador']);
        }
        */
        
        // Crear usuarios y asignarles los roles
        $users = [
            [
                'name' => 'Técnico 1',
                'email' => 'tecnico1@example.com',
                'password' => Hash::make('password1'),
                'role' => 'Tecnico'
            ],
            [
                'name' => 'Técnico 2',
                'email' => 'tecnico2@example.com',
                'password' => Hash::make('password2'),
                'role' => 'Tecnico'
            ],
            [
                'name' => 'Técnico 3',
                'email' => 'tecnico3@example.com',
                'password' => Hash::make('password3'),
                'role' => 'Tecnico'
            ],
            [
                'name' => 'Técnico 4',
                'email' => 'tecnico4@example.com',
                'password' => Hash::make('password4'),
                'role' => 'Tecnico'
            ],
            [
                'name' => 'Admin 1',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password5'),
                'role' => 'Administrador'
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password6'),
                'role' => 'Administrador'
            ]
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            $user->assignRole($userData['role']);
        }
    }
}
