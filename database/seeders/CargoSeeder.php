<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargos')->insert([
            ['nombre_cargo' => 'Gerente de Ventas', 'descripcion_cargo' => 'Encargado de supervisar el equipo de ventas.', 'salario_base' => 50000],
            ['nombre_cargo' => 'HR Manager', 'descripcion_cargo' => 'Responsable de la gestión de personal y políticas laborales.', 'salario_base' => 45000],
            ['nombre_cargo' => 'Desarrollador Senior', 'descripcion_cargo' => 'Desarrollador principal para proyectos tecnológicos.', 'salario_base' => 70000],
            ['nombre_cargo' => 'Especialista en Marketing', 'descripcion_cargo' => 'Responsable de campañas publicitarias y promoción de productos.', 'salario_base' => 40000],
            ['nombre_cargo' => 'Contador', 'descripcion_cargo' => 'Encargado de la gestión financiera y contable de la empresa.', 'salario_base' => 35000],
            ['nombre_cargo' => 'Jefe de Operaciones', 'descripcion_cargo' => 'Supervisa el funcionamiento diario de la empresa.', 'salario_base' => 60000],
            ['nombre_cargo' => 'Logístico', 'descripcion_cargo' => 'Coordina las operaciones de distribución y almacén.', 'salario_base' => 35000],
            ['nombre_cargo' => 'Abogado Corporativo', 'descripcion_cargo' => 'Responsable de los asuntos legales de la empresa.', 'salario_base' => 55000],
        ]);
    }
}
