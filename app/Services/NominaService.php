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
use App\Models\NominaAdicionalFijo;

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

    public function show($id)
    {
        return Nomina::find($id)->get();
    }

    /**
     * Obtiene los detalles de la nómina agrupados por empleado, incluyendo el nombre.
     *
     * @param int $idNomina
     * @return array
     */
    public function obtenerDetallesAgrupadosPorEmpleado(int $idNomina): array
    {
        // Cargamos los detalles con su concepto
        $detalles = DetalleNomina::with('concepto')->where('id_nomina', $idNomina)->get();

        // Agrupar por empleado
        $agrupado = $detalles->groupBy('id_empleado')->map(function ($items, $idEmpleado) {
            // Obtener nombre del empleado
            $empleado = Empleados::with('persona')->find($idEmpleado);
            $nombre = $empleado && $empleado->persona ? $empleado->persona->nombre_completo : 'Desconocido';

            // Cálculo de totales
            $totalAcreditacion = 0;
            $totalDescuento = 0;

            $detallesMapeados = $items->map(function ($detalle) use (&$totalAcreditacion, &$totalDescuento) {
                $tipo = optional($detalle->concepto)->tipo;

                if ($tipo === 'acreditacion') {
                    $totalAcreditacion += $detalle->monto_concepto;
                } elseif ($tipo === 'descuento') {
                    $totalDescuento += $detalle->monto_concepto;
                }

                return [
                    'id_detalle_nomina' => $detalle->id_detalle_nomina,
                    'id_concepto' => $detalle->id_concepto,
                    'detalle_concepto' => $detalle->detalle_concepto,
                    'monto_concepto' => $detalle->monto_concepto,
                ];
            });

            return [
                'id_empleado' => $idEmpleado,
                'nombre' => $nombre,
                'total_acreditacion' => round($totalAcreditacion, 2),
                'total_descuento' => round($totalDescuento, 2),
                'detalles' => $detallesMapeados->values(),
            ];
        });

        return $agrupado->values()->toArray();
    }

    public function obtenerListadoNominas(): Collection
    {
        return Nomina::orderBy('periodo', 'desc')->get();
    }

    public function obtenerNominasPorAnho(int $anho): Collection
    {
        return Nomina::whereYear('periodo', $anho)
                    ->orderBy('periodo', 'desc')
                    ->get();
    }

    public function obtenerNominasConfirmadas(): Collection
    {
        return Nomina::where('estado_nomina', \App\EstadoNomina::Confirmado->value)
                    ->orderBy('periodo', 'desc')
                    ->get();
    }


    /* Calcula el salario prorrateado de un empleado si corresponde al primer mes de ingreso.
    *
    * @param Empleados $empleado
    * @param Carbon $periodoNomina - Último día del mes de la nómina (ej: 2025-05-31)
    * @return float
    */
    /**
     * Calcula el salario prorrateado de un empleado si corresponde al primer mes de ingreso.
     *
     * @param Empleados $empleado
     * @param Carbon $periodoNomina - Último día del mes de la nómina (ej: 2025-05-31)
     * @return float
     */
    private function calcularSalarioProrrateado(Empleados $empleado, Carbon $periodoNomina): float
    {
        $salarioBaseCompleto = $empleado->salario_base;

        // Truncamos la hora de la fecha de ingreso (dejamos solo fecha)
        $fechaIngreso = Carbon::parse($empleado->fecha_ingreso)->startOfDay();

        // Obtenemos el primer día del mes sin hora
        $primerDiaDelMes = $periodoNomina->copy()->startOfMonth()->startOfDay();
        $ultimoDiaDelMes = $periodoNomina->copy()->endOfDay(); // por claridad

        if ($fechaIngreso->between($primerDiaDelMes, $ultimoDiaDelMes)) {
            // Empleado ingresó este mes => aplicar prorrateo por días calendario
            $diasTrabajados = $fechaIngreso->diffInDays($ultimoDiaDelMes); // +1 para incluir el día de ingreso
            $diasDelMes = $periodoNomina->day;
            $salarioCalculado =round(($salarioBaseCompleto / $diasDelMes) * $diasTrabajados, 0);
            /*echo "diaas trab {$diasTrabajados} 
                dias mes {$diasDelMes} 
                fechaIngreso {$fechaIngreso} 
                salarioBase {$salarioBaseCompleto}
                salarioCalculado  {$salarioCalculado}";*/

            return $salarioCalculado ;
            //echo "diaas trab {$diasTrabajados} dias mes {$diasDelMes} fechaIngreso {$fechaIngreso} salarioBase {$salarioBaseCompleto} ";

        }

        // Si no ingresó este mes, salario completo
        return $salarioBaseCompleto;
    }

    //echo "diaas trab {$diasTrabajados} dias mes {$diasDelMes} fechaIngreso {$fechaIngreso} salarioBase {$salarioBaseCompleto} ";

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
                //$this->calculoSalarioBase($empleado, $nomina);
                //$this->calculoBonificacionFamiliar($empleado, $nomina);
                //$this->calculoSeguroSocialIPS($empleado, $nomina);
                //$this->calculoNominaDetalleCuota($empleado, $nomina);
                $this->calculoConceptoFijo($empleado, $nomina);
            }

            DB::commit();

            return $nomina; // Retornar la nómina creada
        } catch (\Exception $e) {
            \Log::error('Error al procesar la planilla: ' . $mes . ' ' . $anho . ' ' . $e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    private function calculoConceptoFijo(Empleados $empleado, Nomina $nomina)
    {
        $conceptosFijos = NominaAdicionalFijo::where('id_nomina', $empleado->id_empleado)->get();

        if ($conceptosFijos->isEmpty()) {
            return;
        }

        foreach ($conceptosFijos as $concepto) {
            DetalleNomina::create([
                'id_nomina' => $nomina->id_nomina,
                'id_empleado' => $empleado->id_empleado,
                'id_concepto' => $concepto->id_concepto,
                'detalle_concepto' => $concepto->detalle_concepto,
                'monto_concepto' => $concepto->importe,
            ]);
        }
    }


    /**
     * Método que guarda los detalles de la nómina de un empleado para salario base
     *
     * @param Empleados $empleado
     * @param Nomina $nomina
     */
    /*private function calculoSalarioBase(Empleados $empleado, Nomina $nomina)
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

    }*/

    private function calculoSalarioBase(Empleados $empleado, Nomina $nomina)
    {
        $salarioBase = $this->calcularSalarioProrrateado($empleado, Carbon::parse($nomina->periodo));

        // Guardamos el valor para que otros métodos como IPS lo usen
        $empleado->salario_base_calculado = $salarioBase;

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

    /*private function calculoSeguroSocialIPS(Empleados $empleado, Nomina $nomina)
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
    }*/

    private function calculoSeguroSocialIPS(Empleados $empleado, Nomina $nomina)
    {
        $salario_base = $empleado->salario_base_calculado ?? $empleado->salario_base;
        $porcentaje_seguro_IPS = 0.09;
        $seguroIPS = round($salario_base * $porcentaje_seguro_IPS);

        DetalleNomina::create([
            'id_nomina' => $nomina->id_nomina,
            'id_empleado' => $empleado->id_empleado,
            'id_concepto' => 3,
            'detalle_concepto' => 'Seguro I.P.S.',
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
        //$empleado->load('nominaDetalleCuotas.concepto');
        $detalle_cuotas = $empleado->nominaDetalleCuotas;
        //echo $detalle_cuotas;
        //echo "0\n";
        foreach($detalle_cuotas as $cuota) {
            //echo "PROCESO\n" . $cuota . "\n";
            $concepto = $cuota->conceptoCuotaDescripcion;
            //echo "concepto " . $concepto . "\n";
            $importe_concepto = $cuota->importeConcepto;
            //echo "importe_concepto " . $importe_concepto . "\n";
            $id_concepto = $cuota->codigoConcepto;
            //echo "id_concepto " . $id_concepto . "\n";
    
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

    public function borrarPlanilla($mes, $anho)
    {
        // Validar si existe una nómina con el mismo periodo
        $ultimoDiaDelMes = Carbon::createFromDate($anho, $mes, 1)->endOfMonth();
        $nomina = Nomina::where('periodo', $ultimoDiaDelMes)->first();

        if (!$nomina) {
            return response()->json(['error' => 'No se encontró una nómina para este periodo'], 404);
        }

        // Eliminar los registros relacionados en DetalleNomina
        DetalleNomina::where('id_nomina', $nomina->id_nomina)->delete();

        // Eliminar la nómina
        $nomina->delete();

        return response()->json(['message' => 'Nómina eliminada correctamente'], 200);
    }

    public function borrarPlanillaPorId ($id_nomina)
    {
        $nomina = Nomina::find($id_nomina);
        // Obtener el mes (número)
        $mes = $nomina->mes_periodo;
        // Obtener el año
        $anho = $nomina->anho_periodo;

        $this->borrarPlanilla($mes, $anho);

    }
}
