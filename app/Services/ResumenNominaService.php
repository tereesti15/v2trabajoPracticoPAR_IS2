<?php

namespace App\Services;

use App\Models\Empleados;
use App\Models\ConceptoSalario;

class ResumenNominaService
{
    /**
     * Retorna un resumen tabular de empleados y sus valores por concepto salarial
     */
    public function obtenerResumen(int $id_nomina): array
    {
        // Obtener todos los conceptos salariales ordenados por nombre (opcional)
        $conceptos = ConceptoSalario::orderBy('nombre_concepto')->get();

        // Obtener todos los empleados con sus relaciones necesarias
        $empleados = Empleados::with([
            'persona',
            'cargo',
            'detalleNomina.concepto',
        ])->get();

        $resumen = [];

        foreach ($empleados as $empleado) {
            $fila = [
                'nombre' => $empleado->nombre_persona,
                'documento' => $empleado->persona->documento ?? 'Sin documento',
                'cargo' => $empleado->nombre_cargo,
            ];

            foreach ($conceptos as $concepto) {
                // Buscar el detalle asociado al empleado, al concepto y a la nómina actual
                \Log::info("Ciclo concepto " . $concepto);
                $detalle = $empleado->detalleNomina
                    ->where('id_nomina', $id_nomina)
                    ->where('id_concepto', $concepto->id_concepto)
                    ->first();
                \Log::info("RESUMEN SERVICE data detalle " . $detalle);
                $fila[$concepto->nombre_concepto] = $detalle?->monto_concepto ?? 0.00;
            }

            $resumen[] = $fila;
        }

        return $resumen;
    }
}
