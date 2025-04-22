<?php

namespace App\Http\Controllers\Api\v1;

use OpenApi\Annotations as OA;
use Illuminate\Http\Request;
use App\Models\Personas;
use App\Http\Controllers\Controller;

/**
 * @OA\Tag(
 *     name="Personas",
 *     description="Operaciones relacionadas con las personas"
 * )
 */

final class PersonasController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/personas",
     *     tags={"Personas"},
     *     summary="Obtener todos las personas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de personas en formato JSON"
     *     )
     * )
     */

    public function index() {
        $personas = Personas::all();
        return response()->json($personas);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/personas",
     *     tags={"Personas"},
     *     summary="Crear una nueva persona",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "apellido", "documento", "direccion"},
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Perez"),
     *             @OA\Property(property="documento", type="string", example="4444444"),
     *             @OA\Property(property="direccion", type="string", example="calle 1"),
     *             @OA\Property(property="telefono", type="string", example="0981111111"),
     *             @OA\Property(property="email", type="string", example="Perez@gmail.com")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Persona creada correctamente")
     * )
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', 
            'apellido' => 'required|string', 
            'documento' => 'required|string', 
            'direccion' => 'required|string', 
            'telefono' => 'string',
            'email' => 'string']);
        $persona = Personas::create($validated);
        return response()->json($persona, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/personas/{id}",
     *     tags={"Personas"},
     *     summary="Eliminar una persona",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la persona a eliminar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Persona eliminada correctamente"),
     *     @OA\Response(response=404, description="Persona no encontrada")
     * )
     */

    // Eliminar un departamento por ID
    public function destroy($id)
    {
        $persona = Personas::find($id);

        if (!$persona) {
            return response()->json(['mensaje' => 'Persona no encontrada'], 404);
        }

        $persona->delete();

        return response()->json(['mensaje' => 'Persona eliminada con éxito']);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/personas/{id}",
     *     tags={"Personas"},
     *     summary="Actualizar una persona existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la persona a actualizar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "apellido", "documento", "direccion"},
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Perez"),
     *             @OA\Property(property="documento", type="string", example="1231231"),
     *             @OA\Property(property="direccion", type="string", example="calle 1"),
     *             @OA\Property(property="telefono", type="string", example="0981111111"),
     *             @OA\Property(property="email", type="string", example="Perez@gmail.com")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Persona actualizada")
     * )
     */

   // Actualiza un departamento por ID
    public function update(Request $request, $id)
    {
        $persona = Personas::find($id);

        if (!$persona) {
            return response()->json(['mensaje' => 'Persona no encontrada'], 404);
        }

        $request->validate(['nombre' => 'required|string','apellido' => 'required|string', 
        'documento' => 'required|string', 'direccion' => 'required|string', 'telefono' => 'string', 
        'email' => 'string',
        ]);

        $persona->update($request->all());

        return response()->json(['mensaje' => 'Persona actualizada con éxito','departamento' => $persona
        ]);
    }    
}
