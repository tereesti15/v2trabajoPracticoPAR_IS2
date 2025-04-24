<?php

namespace App\Http\Controllers\API\v1;

use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;

/**
 *
 * @OA\Tag(
 *     name="Cargos",
 *     description="Operaciones relacionadas con los cargos"
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/cargos",
 *     tags={"Cargos"},
 *     summary="Obtener todos los cargos",
 *     @OA\Response(response="200", description="Lista de cargos en JSON")
 * )
 *
 * @OA\Post(
 *     path="/api/v1/cargos",
 *     tags={"Cargos"},
 *     summary="Crear un nuevo cargo",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre_cargo","descripcion_cargo","salario_base"},
 *             @OA\Property(property="nombre_cargo", type="string"),
 *             @OA\Property(property="descripcion_cargo", type="string"),
 *             @OA\Property(property="salario_base", type="integer")
 *         )
 *     ),
 *     @OA\Response(response="201", description="Cargo creado"),
 *     @OA\Response(response="422", description="Error de validación")
 * )
 *
 * @OA\Get(
 *     path="/api/v1/cargos/{id}",
 *     tags={"Cargos"},
 *     summary="Obtener un cargo específico",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response="200", description="Cargo encontrado"),
 *     @OA\Response(response="404", description="Cargo no encontrado")
 * )
 *
 * @OA\Put(
 *     path="/api/v1/cargos/{id}",
 *      tags={"Cargos"},
 *     summary="Actualizar un cargo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre_cargo", type="string"),
 *             @OA\Property(property="descripcion_cargo", type="string"),
 *             @OA\Property(property="salario_base", type="integer")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Cargo actualizado"),
 *     @OA\Response(response="404", description="Cargo no encontrado")
 * )
 *
 * @OA\Delete(
 *     path="/api/v1/cargos/{id}",
 *      tags={"Cargos"},
 *     summary="Eliminar un cargo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response="200", description="Cargo eliminado"),
 *     @OA\Response(response="404", description="Cargo no encontrado")
 * )
 */

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Cargo::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:255',
            'descripcion_cargo' => 'required|string|max:255',
            'salario_base' => 'required|integer|min:0',
        ]);

        $cargo = Cargo::create($validated);

        return response()->json([
            'message' => 'Cargo creado exitosamente.',
            'data' => $cargo,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['error' => 'Cargo no encontrado'], 404);
        }
        return response()->json($cargo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['error' => 'Cargo no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre_cargo' => 'sometimes|required|string|max:255',
            'descripcion_cargo' => 'sometimes|required|string|max:255',
            'salario_base' => 'sometimes|required|integer|min:0',
        ]);

        $cargo->update($validated);

        return response()->json($cargo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['error' => 'Cargo no encontrado'], 404);
        }

        $cargo->delete();

        return response()->json(['message' => 'Cargo eliminado con éxito'], 200);
    }
}
