<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            ['nombre_departamento' => 'Ventas', 'ubicacion' => 'Piso 1'],
            ['nombre_departamento' => 'Recursos Humanos', 'ubicacion' => 'Piso 2'],
            ['nombre_departamento' => 'Tecnología', 'ubicacion' => 'Piso 3'],
            ['nombre_departamento' => 'Marketing', 'ubicacion' => 'Piso 4'],
            ['nombre_departamento' => 'Contabilidad', 'ubicacion' => 'Piso 5'],
            ['nombre_departamento' => 'Operaciones', 'ubicacion' => 'Piso 6'],
            ['nombre_departamento' => 'Logística', 'ubicacion' => 'Piso 7'],
            ['nombre_departamento' => 'Legal', 'ubicacion' => 'Piso 8'],
        ]);
    }
}
