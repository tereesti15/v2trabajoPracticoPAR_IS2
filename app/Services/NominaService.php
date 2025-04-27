<?php

namespace App\Services;

use App\Models\Personas;
use App\Models\Empleados;
use App\Models\Nomina;
use App\Models\DetalleNomina;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class NominaService
{
    /**
     * Obtener los hijos menores de 18 años por persona
     */
    public function obtenerHijosPorPersona(int $idPersona): ?Collection
    {
        $persona = Personas::find($idPersona);

        if (!$persona) {
            return null; // Persona no encontrada
        }

        // Filtramos los hijos menores de 18 años
        return $persona->hijos->filter(function ($hijo) {
            $fechaNacimiento = Carbon::parse($hijo->fecha_nacimiento);
            return $fechaNacimiento->age < 18; // Filtra a los menores de 18 años
        });
    }

    public function procesarPlanilla(int $mes, int$anho) {

        $ultimoDiaDelMes = Carbon::createFromDate($anho, $mes, 1)->endOfMonth();
        $existeNomina = Nomina::where('periodo', $ultimoDiaDelMes)->exists();

        if ($existeNomina) {
            throw new \Exception('Ya existe una nómina para este periodo.');
        }

        DB::beginTransaction();

        try {
            // 1. Crear Nomina con el último día del mes
            // El primer paso es generar la fecha con el día 1
            $periodo = Carbon::createFromDate($anho, $mes, 1);

            $ultimoDiaDelMes = $periodo->endOfMonth(); // Esto nos da el último día del mes, considerando bisiestos

            // Fecha de proceso
            $fechaProceso = now();

            // Crear el registro en la tabla "nomina"
            $nomina = Nomina::create([
                'periodo' => $ultimoDiaDelMes,  // Guardamos el último día del mes
                'fecha_proceso_liquidacion' => $fechaProceso,
                'estado_nomina' => \App\EstadoNomina::Modificable->value,
            ]);

            // 2. Recuperar empleados
            $allEmployees = Empleados::with('cargo')->get();

            foreach ($allEmployees as $empleado) {

                // 3. Crear un detalle de nómina por empleado
                $this->calculoSalarioBase($empleado, $nomina);
            }

            DB::commit();

            return $nomina; // Retornar la nómina creada
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    /**
     * Método que guarda los detalles de la nómina de un empleado.
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    private function calculoSalarioBase(Empleados $empleado, Nomina $nomina)
    {
        // Puedes agregar la lógica de cálculos adicionales aquí, como bonificaciones, descuentos, etc.

        // Calcular salario base (esto es solo un ejemplo)
        $salarioBase = $empleado->cargo->salario_base ?? 0;
        //echo $nomina . " " . $salarioBase . "\n";

        // Crear detalle de nómina
        DetalleNomina::create([
            'id_nomina' => $nomina->id_nomina,
            'id_empleado' => $empleado->id_empleado,
            'id_concepto' => 1,
            'detalle_concepto' => 'Salario base',
            'monto_concepto' => $salarioBase,
        ]);

    }

    private function calculoBonificacionFamiliar(Empleados $data) {
        $datoHijos = obtenerHijosPorPersona(data->id);
    } 
}
