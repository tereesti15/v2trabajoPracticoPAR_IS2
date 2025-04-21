<?php

namespace App\Http\Controllers\API\v1;

use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;



/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Departamentos",
 *     description="Documentación de la API de departamentos"
 * )
 */

class DepartamentoController extends Controller
{
   /**
     * @OA\Get(
     *     path="/api/v1/departamentos",
     *     summary="Obtener todos los departamentos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de departamentos en formato JSON"
     *     )
     * )
     */

    // Obtener todos los departamentos
    public function index()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/departamentos",
     *     summary="Crear un nuevo departamento",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_departamento", "ubicacion"},
     *             @OA\Property(property="nombre_departamento", type="string", example="Finanzas"),
     *             @OA\Property(property="ubicacion", type="string", example="Piso 3")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Departamento creado correctamente")
     * )
     */

     // Crear un nuevo departamento
    public function store(Request $request)
    {
        $request->validate(['nombre_departamento' => 'required|string','ubicacion' => 'required|string',
        ]);

        $departamento = Departamento::create($request->all());
        return response()->json($departamento, 201);
    }
      
    /**
     * @OA\Delete(
     *     path="/api/v1/departamentos/{id}",
     *     summary="Eliminar un departamento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del departamento a eliminar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Departamento eliminado correctamente"),
     *     @OA\Response(response=404, description="Departamento no encontrado")
     * )
     */

    // Eliminar un departamento por ID
    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['mensaje' => 'Departamento no encontrado'], 404);
        }

        $departamento->delete();

        return response()->json(['mensaje' => 'Departamento eliminado con éxito']);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/departamentos/{id}",
     *     summary="Actualizar un departamento existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del departamento a actualizar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_departamento", "ubicacion"},
     *             @OA\Property(property="nombre_departamento", type="string", example="Sistemas"),
     *             @OA\Property(property="ubicacion", type="string", example="Planta baja")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Departamento actualizado")
     * )
     */

   // Actualiza un departamento por ID
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['mensaje' => 'Departamento no encontrado'], 404);
        }

        $request->validate(['nombre_departamento' => 'required|string','ubicacion' => 'required|string',
        ]);

        $departamento->update($request->all());

        return response()->json(['mensaje' => 'Departamento actualizado con éxito','departamento' => $departamento
        ]);
    }
}
