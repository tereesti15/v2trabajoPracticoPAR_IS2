<?php

namespace App\Http\Controllers\API\v1;

use App\Models\NominaDetalleCuota;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="NominaDetalleCuota",
 *     description="Operaciones sobre cuotas de nómina, se registran los conceptos de acreditacion o descuentos que sean por cuotas, ej: ASO, prestamos, embargo judicial, etc"
 * )
 */

final class NominaDetalleCuotaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/v1/nomina-detalle-cuotas",
     *     tags={"NominaDetalleCuota"},
     *     summary="Obtener todos los registros de nomina_detalle_cuotas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de registros",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/NominaDetalleCuota"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(NominaDetalleCuota::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/nomina-detalle-cuotas",
     *     tags={"NominaDetalleCuota"},
     *     summary="Crear un nuevo detalle de cuota",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/NominaDetalleCuota")
     *     ),
     *     @OA\Response(response=201, description="Registro creado"),
     *     @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_concepto' => 'required|exists:concepto_salario,id_concepto',
            'id_nomina' => 'required|exists:empleados,id_empleado',
            'detalle_concepto' => 'required|string',
            'cant_cuota' => 'required|integer|min:1',
            'nro_cuota' => 'integer|min:1',
            'monto_concepto' => 'required|integer',
            'tipo' => 'required|in:ACREDITACION,DESCUENTO',
        ]);

        $detalle = NominaDetalleCuota::create($validated);
        return response()->json($detalle, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/nomina-detalle-cuotas/{id}",
     *     tags={"NominaDetalleCuota"},
     *     summary="Obtener un registros de nomina_detalle_cuotas",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Registro",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/NominaDetalleCuota"))
     *     ),
     *     @OA\Response(response=404, description="Detalle de nomina no encontrado")
     * )
     */
    public function show($id)
    {
        $detalle = NominaDetalleCuota::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }
        return response()->json($detalle);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/nomina-detalle-cuotas/{id}",
     *     tags={"NominaDetalleCuota"},
     *     summary="Actualizar un detalle por ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/NominaDetalleCuota")),
     *     @OA\Response(response=200, description="Detalle actualizado"),
     *     @OA\Response(response=404, description="No encontrado"),
     *     @OA\Response(response=422, description="Datos inválidos")
     * )
     */
    public function update(Request $request, $id)
    {
        $detalle = NominaDetalleCuota::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }

        $validated = $request->validate([
            'id_concepto' => 'sometimes|exists:concepto_salario,id_concepto',
            'id_nomina' => 'sometimes|exists:empleados,id_empleado',
            'detalle_concepto' => 'sometimes|string',
            'cant_cuota' => 'sometimes|integer|min:1',
            'nro_cuota' => 'sometimes|integer|min:1',
            'monto_concepto' => 'sometimes|integer',
            'tipo' => 'sometimes|in:ACREDITACION,DESCUENTO',
        ]);

        $detalle->update($validated);
        return response()->json($detalle);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/nomina-detalle-cuotas/{id}",
     *     tags={"NominaDetalleCuota"},
     *     summary="Eliminar un detalle por ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Detalle eliminado"),
     *     @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function destroy($id)
    {
        $detalle = NominaDetalleCuota::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }

        $detalle->delete();
        return response()->json(['message' => 'Detalle eliminado con éxito']);
    }
}
