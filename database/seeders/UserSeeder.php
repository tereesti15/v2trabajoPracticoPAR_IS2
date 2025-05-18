<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de usuarios con sus roles
        $users = [
            [
                'name' => 'Admin Principal',
                'email' => 'admin@example.com',
                'role' => 'Administrador',
            ],
            [
                'name' => 'Gerente General',
                'email' => 'gerente@example.com',
                'role' => 'Gerente',
            ],
            [
                'name' => 'Asistente RH',
                'email' => 'asistente@example.com',
                'role' => 'Asistente de RRHH',
            ],
            [
                'name' => 'Empleado Base',
                'email' => 'empleado@example.com',
                'role' => 'Empleado',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'), // puedes cambiar la contraseña
                ]
            );

            $role = Role::firstOrCreate(['name' => $data['role'], 'guard_name' => 'web']);
            $user->assignRole($role);
        }
    }
}
