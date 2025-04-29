<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConceptoSalario;
use App\TipoConceptoNomina;

final class ConceptoSalarioSeeder extends Seeder
{
    public function run()
    {
        // Acreditaciones
        ConceptoSalario::create([
            'nombre_concepto' => 'Salario Base',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);
        
        ConceptoSalario::create([
            'nombre_concepto' => 'Bonificación Familiar',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Bonificación por Antigüedad',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Horas Extra',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Comisiones',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Bonificación de Producción',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Aguinaldo',
            'tipo' => TipoConceptoNomina::ACREDITACION->value,
        ]);

        // Descuentos
        ConceptoSalario::create([
            'nombre_concepto' => 'Descuento por Inasistencia',
            'tipo' => TipoConceptoNomina::DESCUENTO->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Descuento por Llegada Tardia',
            'tipo' => TipoConceptoNomina::DESCUENTO->value,
        ]);

        ConceptoSalario::create([
            'nombre_concepto' => 'Descuento por Seguro Médico',
            'tipo' => TipoConceptoNomina::DESCUENTO->value,
        ]);
    }
}
