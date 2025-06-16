<?php

namespace App\Services;

use App\Models\Empleados;
use App\Models\ConceptoSalario;
use App\TipoConceptoNomina;

class ResumenNominaService
{
    /**
     * Retorna un resumen tabular de empleados y sus valores por concepto salarial
     */
    public function obtenerResumen(int $id_nomina): array
    {
        // Obtener todos los conceptos salariales ordenados por tipo y nombre
        $conceptos = ConceptoSalario::orderBy('tipo')->orderBy('nro_orden', 'desc')->get();

        // Agrupar los conceptos por tipo
        $conceptosAgrupados = $conceptos
            ->groupBy('tipo')
            ->map(function ($grupo) {
                return $grupo->sortByDesc('nro_orden')->values();
            });
            \Log::info("PROCESA 1 " . $conceptosAgrupados);
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

            $totalNeto = 0.00;

            foreach ($conceptosAgrupados as $tipo => $conceptosDelTipo) {
                $fila[$tipo] = [];
                $totalPorTipo = 0.00;

                foreach ($conceptosDelTipo as $concepto) {
                    $detalle = $empleado->detalleNomina
                        ->where('id_nomina', $id_nomina)
                        ->where('id_concepto', $concepto->id_concepto)
                        ->first();

                    $monto = $detalle?->monto_concepto ?? 0.00;

                    $fila[$tipo][$concepto->nombre_concepto] = $monto;
                    $totalPorTipo += $monto;
                }
                $fila[$tipo]['total'] = $totalPorTipo;
                // Ajustar el total neto según el tipo
                if ($tipo === TipoConceptoNomina::ACREDITACION->value) {
                    $totalNeto += $totalPorTipo;
                } elseif ($tipo === TipoConceptoNomina::DESCUENTO->value) {
                    $totalNeto -= $totalPorTipo;
                }
            }

            $fila['total_neto'] = $totalNeto;

            $resumen[] = $fila;
        }
        \Log::info("PLANILLA FINAL ", $resumen);
        return $resumen;
    }
}
