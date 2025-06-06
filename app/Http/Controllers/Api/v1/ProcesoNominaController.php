<?php

namespace App\Http\Controllers\API\v1;

use App\Services\NominaService;
use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\DetalleNomina;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Proceso Planilla Nomina",
 *     description="Operaciones sobre las nóminas"
 * )
 * @OA\Get(
 *     path="/api/v1/proceso-nomina",
 *     summary="Obtener todas las nóminas procesadas",
 *     tags={"Proceso Planilla Nomina"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de nóminas procesadas",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Nomina")
 *         )
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/proceso-nomina/{mes}/{anho}",
 *     summary="Obtener una nómina específica por mes y año",
 *     tags={"Proceso Planilla Nomina"},
 *     @OA\Parameter(
 *         name="mes",
 *         in="path",
 *         required=true,
 *         description="Mes de la nómina",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="anho",
 *         in="path",
 *         required=true,
 *         description="Año de la nómina",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle de la nómina para el periodo solicitado",
 *         @OA\JsonContent(ref="#/components/schemas/Nomina")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nómina no encontrada"
 *     )
 * )
 * 
 */

final class ProcesoNominaController extends Controller
{
    protected $nominaService;

    public function __construct(NominaService $nominaService)
    {
        $this->nominaService = $nominaService;
    }

    public function index(Request $request)
    {
        // Obtenemos todas las nóminas procesadas
        $nominas = Nomina::all();

        // Recorremos cada nómina y cargamos el detalle de cada una
        $nominasConDetalle = $nominas->map(function ($nomina) {
            $detalle = DetalleNomina::where('id_nomina', $nomina->id_nomina)->get();

            return [
                'id_nomina' => $nomina->id_nomina,
                'periodo' => $nomina->periodo,
                'fecha_proceso_liquidacion' => $nomina->fecha_proceso_liquidacion,
                'estado_nomina' => $nomina->estado_nomina,
                'detalle_nomina' => $detalle, // Incluimos el detalle
            ];
        });

        // Devolvemos la respuesta en formato JSON
        return response()->json($nominasConDetalle);
    }

    public function showByPeriodo($mes, $anho)
    {
        // Creamos la fecha del primer día del mes y año proporcionado
        $primerDia = Carbon::createFromDate($anho, $mes, 1)->startOfMonth();

        // Creamos la fecha del último día del mes y año proporcionado
        $ultimoDia = Carbon::createFromDate($anho, $mes, 1)->endOfMonth();

        // Buscamos la nómina para el periodo correspondiente (mes y año)
        $nomina = Nomina::whereBetween('periodo', [$primerDia, $ultimoDia])->first();

        // Si no se encuentra la nómina, devolvemos un error 404
        if (!$nomina) {
            return response()->json(['error' => 'Nómina no encontrada para el periodo especificado'], 404);
        }

        // Obtenemos el detalle de la nómina
        $detalle = DetalleNomina::where('id_nomina', $nomina->id_nomina)->get();

        // Devolvemos la respuesta en formato JSON
        return response()->json([
            'id_nomina' => $nomina->id_nomina,
            'periodo' => $nomina->periodo,
            'fecha_proceso_liquidacion' => $nomina->fecha_proceso_liquidacion,
            'estado_nomina' => $nomina->estado_nomina,
            'detalle_nomina' => $detalle, // Incluimos el detalle
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mes' => 'required|integer',
            'anho' => 'required|integer',
        ]);
        try {
            $nomina = $this->nominaService->procesarPlanilla($validated['mes'], $validated['anho']);
            return response()->json(['message' => 'Nómina procesada correctamente'], 200);
        } catch (\Exception $e) {
            \Log::error("CONTROLLER Error al procesar la planilla: " . $validated['mes'] . " " . $validated['anho'] . " " . $e->getMessage());
            return response()->json(['error' => 'No se pudo procesar la planilla.'], 500);
        }
    }

    public function destroy($mes, $anho)
    {
        try {
            $nomina = $this->nominaService->borrarPlanilla($mes,$anho);
            return response()->json(['message' => 'Nómina borrada correctamente'], 200);
        } catch (\Exception $e) {
            \Log::error("CONTROLLER Error al borrar la planilla: " . $mes . " " . $anho . " " . $e->getMessage());
            return response()->json(['error' => 'No se pudo borrar la planilla.'], 500);
        }
    }
}
