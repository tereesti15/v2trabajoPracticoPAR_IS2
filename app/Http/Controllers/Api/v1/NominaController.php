<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Nomina;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Nominas",
 *     description="Operaciones relacionadas con la nómina"
 * )
 */
final class NominaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/nomina",
     *     summary="Listar todas las nóminas",
     *     tags={"Nominas"},
     *     @OA\Response(response=200, description="Lista de nóminas")
     * )
     */
    public function index()
    {
        return response()->json(Nomina::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/nomina/{id}",
     *     summary="Obtener una nómina específica",
     *     tags={"Nominas"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Nómina encontrada"),
     *     @OA\Response(response=404, description="Nómina no encontrada")
     * )
     */
    public function show($id)
    {
        $nomina = Nomina::find($id);
        if (!$nomina) {
            return response()->json(['error' => 'Nómina no encontrada'], 404);
        }
        return response()->json($nomina, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/nomina",
     *     summary="Crear una nueva nómina",
     *     tags={"Nominas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Nomina")
     *     ),
     *     @OA\Response(response=201, description="Nómina creada")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periodo' => 'required|date',
            'fecha_proceso_liquidacion' => 'required|date',
            'estado_nomina' => 'required|in:Modificable,Confirmada',
        ]);

        $nomina = Nomina::create($validated);
        return response()->json($nomina, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/nomina/{id}",
     *     summary="Actualizar una nómina",
     *     tags={"Nominas"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Nomina")
     *     ),
     *     @OA\Response(response=200, description="Nómina actualizada"),
     *     @OA\Response(response=404, description="Nómina no encontrada")
     * )
     */
    public function update(Request $request, $id)
    {
        $nomina = Nomina::find($id);
        if (!$nomina) {
            return response()->json(['error' => 'Nómina no encontrada'], 404);
        }

        $validated = $request->validate([
            'periodo' => 'required|date',
            'fecha_proceso_liquidacion' => 'required|date',
            'estado_nomina' => 'required|in:Modificable,Confirmada',
        ]);

        $nomina->update($validated);
        return response()->json($nomina, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/nomina/{id}",
     *     summary="Eliminar una nómina",
     *     tags={"Nominas"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Nómina eliminada"),
     *     @OA\Response(response=404, description="Nómina no encontrada")
     * )
     */
    public function destroy($id)
    {
        $nomina = Nomina::find($id);
        if (!$nomina) {
            return response()->json(['error' => 'Nómina no encontrada'], 404);
        }

        $nomina->delete();
        return response()->json(['message' => 'Nómina eliminada'], 200);
    }
}
