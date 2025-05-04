<?php

namespace App\Services;

use App\Models\Personas;
use App\Models\Empleados;
use App\Models\Nomina;
use App\Models\DetalleNomina;
use App\Models\Parametro;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class NominaService
{

    private Parametro $parametro;

    public function __construct()
    {
        // Instanciamos la clase Parametro en el constructor
        //\Log::info('Entra constructor NominaService');
        $this->parametro = new Parametro();
        //\Log::info('DATOS DE PARAMETRO EN CONSTRUCTOR ' . $this->parametro->salario_minimo);
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
                $this->calculoBonificacionFamiliar($empleado, $nomina);
                $this->calculoSeguroSocialIPS($empleado, $nomina);
                $this->calculoNominaDetalleCuota($empleado, $nomina);
            }

            DB::commit();

            return $nomina; // Retornar la nómina creada
        } catch (\Exception $e) {
            \Log::error('Error al procesar la planilla: ' . $mes . ' ' . $anho . ' ' . $e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Método que guarda los detalles de la nómina de un empleado para salario base
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    private function calculoSalarioBase(Empleados $empleado, Nomina $nomina)
    {
        // Puedes agregar la lógica de cálculos adicionales aquí, como bonificaciones, descuentos, etc.

        $salarioBase = $empleado->salario_base;
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

    /**
     * Método que guarda los detalles de la nómina de un empleado para bonificación familiar.
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    private function calculoBonificacionFamiliar(Empleados $empleado, Nomina $nomina)
    {
        $salarioBase = $empleado->salario_base;
        $cantHijosMenores = $empleado->getCantidadHijosMenores18Attribute();
        $salarioMinimo = $this->parametro->salario_minimo;
        $max_salario_minimo = $this->parametro->bonificacion_familiar_max_salario_minimo;
        $porcentaje_bonificacion_familiar = $this->parametro->bonificacion_familiar_porcentaje;
        //echo "Empleado " . $empleado->id_persona . " SALARIO BASE " . $salarioBase . " SALARIO MINIMO " . $salarioMinimo . " HIJOS " . $cantHijosMenores . "\n";

        if((($salarioMinimo * $max_salario_minimo) >= $salarioBase) && ($cantHijosMenores > 0)) {
            $importeBonificacion = $salarioMinimo * $porcentaje_bonificacion_familiar * $cantHijosMenores;
            $importeBonificacion = round($importeBonificacion);
            $concepto = "Bonificacion familiar (" . $cantHijosMenores . ")" ;
            // Crear detalle de nómina
            DetalleNomina::create([
                'id_nomina' => $nomina->id_nomina,
                'id_empleado' => $empleado->id_empleado,
                'id_concepto' => 2,
                'detalle_concepto' => $concepto,
                'monto_concepto' => $importeBonificacion,
            ]);
        } else {
            DetalleNomina::create([
                'id_nomina' => $nomina->id_nomina,
                'id_empleado' => $empleado->id_empleado,
                'id_concepto' => 2,
                'detalle_concepto' => 'Bonificacion familiar',
                'monto_concepto' => 0,
            ]);
        }
    }

    /**
     * Método que guarda los detalles de la nómina de un empleado para seguro IPS.
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    private function calculoSeguroSocialIPS(Empleados $empleado, Nomina $nomina)
    {
        // Puedes agregar la lógica de cálculos adicionales aquí, como bonificaciones, descuentos, etc.
        $salario_base = $empleado->salario_base;
        $porcentaje_seguro_IPS = 0.09;
        $seguroIPS = $salario_base * $porcentaje_seguro_IPS;
        $seguroIPS = round($seguroIPS);
        $concepto = "Seguro I.P.S.";
        //echo "Empleado " . $empleado->id_persona . " SALARIO BASE " . $salarioBase . " SALARIO MINIMO " . $salarioMinimo . " HIJOS " . $cantHijosMenores . "\n";
        // Crear detalle de nómina
        DetalleNomina::create([
            'id_nomina' => $nomina->id_nomina,
            'id_empleado' => $empleado->id_empleado,
            'id_concepto' => 3,
            'detalle_concepto' => $concepto,
            'monto_concepto' => $seguroIPS,
        ]);
    }

    /**
     * Método que guarda los detalles de cuotas de un empleado.
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    private function calculoNominaDetalleCuota(Empleados $empleado, Nomina $nomina)
    {
        // Puedes agregar la lógica de cálculos adicionales aquí, como bonificaciones, descuentos, etc.
        $detalle_cuota = $empleado->nominaDetalleCuotas;

        $concepto = $detalle_cuota->conceptoCuotaDescripcion;
        $importe_concepto = $detalle_cuota->importeConcepto;
        $id_concepto = $detalle_cuota->codigoConcepto;

        //echo "Empleado " . $empleado->id_persona . " SALARIO BASE " . $salarioBase . " SALARIO MINIMO " . $salarioMinimo . " HIJOS " . $cantHijosMenores . "\n";
        // Crear detalle de nómina
        DetalleNomina::create([
            'id_nomina' => $nomina->id_nomina,
            'id_empleado' => $empleado->id_empleado,
            'id_concepto' => $id_concepto,
            'detalle_concepto' => $concepto,
            'monto_concepto' => $importe_concepto,
        ]);
    }
}
