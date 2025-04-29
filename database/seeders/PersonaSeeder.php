<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personas;

class PersonaSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = ['Juan', 'María', 'Carlos', 'Ana', 'Luis', 'Sofía', 'Miguel', 'Lucía', 'Jorge', 'Laura'];
        $apellidos = ['Pérez', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez', 'Gómez', 'Díaz', 'Sánchez', 'Ramírez'];

        for ($i = 0; $i < 10; $i++) {
            Personas::create([   // <<<<<< También usar el nombre plural aquí
                'nombre' => $nombres[$i],
                'apellido' => $apellidos[$i],
                'documento' => 'DOC' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'direccion' => 'Calle Falsa ' . ($i + 1) . '00',
                'telefono' => '555-01' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'email' => strtolower($nombres[$i]) . '.' . strtolower($apellidos[$i]) . '@example.com',
            ]);
        }
    }
}
