<?php

namespace App\Http\Controllers\API\v1;

use App\Models\DetalleNomina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;


class DetalleNominaController extends Controller
{

    /**
 *
 * @OA\Tag(
 *     name="Detalle Nomina",
 *     description="API Endpoints para Detalle Nomina"
 * )
 *
 * @OA\Get(
 *     path="/api/v1/detalle-nomina",
 *     summary="Listar el detalle de las nominas",
 *     tags={"Detalle Nomina"},
 *     @OA\Response(response=200, description="Lista el detalle de las nominas")
 * )
 *
 * @OA\Post(
 *     path="/api/v1/detalle-nomina",
 *     summary="Crear detalle nomina",
 *     tags={"Detalle Nomina"},
 *     @OA\RequestBody(
 *         required=true,
 *          @OA\JsonContent(ref="#/components/schemas/DetalleNomina")
 *     ),
 *     @OA\Response(response=201, description="Detalle de nomina creada")
 * )
 *
 * @OA\Get(
 *     path="/api/v1/detalle-nomina/{id}",
 *     summary="Obtener un detalle de nomina",
 *     tags={"Detalle Nomina"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Detalle de nomina encontrado"),
 *     @OA\Response(response=404, description="Detalle de nomina no encontrado")
 * )
 *
 * @OA\Put(
 *     path="/api/v1/detalle-nomina/{id}",
 *     summary="Actualizar un detalle de nomina",
 *     tags={"Detalle Nomina"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/DetalleNomina")),
 *     @OA\Response(response=200, description="Detalle de nomina actualizado"),
 *     @OA\Response(response=404, description="Detalle de nomina no encontrado")
 * )
 *
 * @OA\Delete(
 *     path="/api/v1/detalle-nomina/{id}",
 *     summary="Eliminar un detalle de nomina",
 *     tags={"Detalle Nomina"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Detalle de nomina eliminado"),
 *     @OA\Response(response=404, description="Detalle de nomina no encontrado")
 * )
 * 
 */

    public function index()
    {
        return response()->json(DetalleNomina::all());
    }

    public function store(Request $request)
    {
        $detalle = DetalleNomina::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        $detalle = DetalleNomina::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }
        return response()->json($detalle);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleNomina::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }
        $detalle->update($request->all());
        return response()->json($detalle);
    }

    public function destroy($id)
    {
        $detalle = DetalleNomina::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle no encontrado'], 404);
        }
        $detalle->delete();
        return response()->json(['message' => 'Detalle salario eliminado'], 200);
    }
}
