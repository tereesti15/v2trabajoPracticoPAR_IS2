<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hijo;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Hijos",
 *     description="Operaciones relacionadas con los hijos"
 * )
 */
class HijoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/hijos",
     *     summary="Listar hijos",
     *     tags={"Hijos"},
     *     @OA\Response(response=200, description="Listado exitoso")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(Hijo::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/hijos",
     *     summary="Crear hijo",
     *     tags={"Hijos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"persona_id", "nombre", "fecha_nacimiento", "documento"},
     *             @OA\Property(property="persona_id", type="integer", example="1"),
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="fecha_nacimiento", type="string", format="date", example="2025-01-25"),
     *             @OA\Property(property="documento", type="string", example="12345"),
     *             @OA\Property(property="discapacitado", type="boolean", example=0)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Creado exitosamente")
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'documento' => 'required|string|max:255',
            'discapacitado' => 'boolean',
        ]);

        $hijo = Hijo::create($validated);

        return response()->json($hijo, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/hijos/{id}",
     *     summary="Mostrar hijo",
     *     tags={"Hijos"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Hijo encontrado"),
     *     @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show($id): JsonResponse
    {
        $hijo = Hijo::findOrFail($id);
        return response()->json($hijo);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/hijos/{id}",
     *     summary="Actualizar hijo",
     *     tags={"Hijos"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="persona_id", type="integer", example="2"),
     *             @OA\Property(property="nombre", type="string", example="Juan" ),
     *             @OA\Property(property="fecha_nacimiento", type="string", format="date", example="2025-01-26"),
     *             @OA\Property(property="documento", type="string", example="1234563"),
     *             @OA\Property(property="discapacitado", type="boolean", example=0)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Actualizado exitosamente")
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $hijo = Hijo::findOrFail($id);

        $validated = $request->validate([
            'persona_id' => 'sometimes|exists:personas,id',
            'nombre' => 'sometimes|string|max:255',
            'fecha_nacimiento' => 'sometimes|date',
            'documento' => 'sometimes|string|max:255',
            'discapacitado' => 'boolean',
        ]);

        $hijo->update($validated);

        return response()->json($hijo);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/hijos/{id}",
     *     summary="Eliminar hijo",
     *     tags={"Hijos"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Eliminado exitosamente")
     * )
     */
    public function destroy($id): JsonResponse
    {
        //Hijo::findOrFail($id)->delete();
       // return response()->json(null, 204);

        $hijo = Hijo::find($id);

        if (!$hijo) {
            return response()->json(['mensaje' => 'Hijo no encontrado'], 404);
        }

        $hijo->delete();

        return response()->json(['mensaje' => 'Hijo eliminado con éxito']);
    }
}
