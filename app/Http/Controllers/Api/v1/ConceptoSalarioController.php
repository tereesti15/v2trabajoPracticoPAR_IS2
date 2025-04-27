<?php

namespace App\Http\Controllers\API\v1;

use App\Models\ConceptoSalario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ConceptoSalarioRequest",
 *     required={"nombre", "tipo"},
 *     @OA\Property(property="nombre", type="string", example="Bono de transporte"),
 *     @OA\Property(
 *         property="tipo",
 *         type="string",
 *         enum={"acreditacion", "descuento"},
 *         description="Tipo de concepto (acreditacion o descuento)"
 *     )
 * )
 *
 * @OA\Tag(
 *      name="Conceptos Salariales",
 *      description="Operaciones relacionadas con la nomina"
 * )
 */

class ConceptoSalarioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/conceptos-salario",
     *     summary="Listar todos los conceptos salariales",
     *     tags={"Conceptos Salariales"},
     *     @OA\Response(response=200, description="Listado de conceptos salariales")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(ConceptoSalario::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/conceptos-salario",
     *     summary="Crear un nuevo concepto salarial",
     *     tags={"Conceptos Salariales"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ConceptoSalarioRequest")
     *     ),
     *     @OA\Response(response=201, description="Concepto creado")
     * )
     */
    public function store(Request $request): JsonResponse
    {
        /*
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo'   => 'required|in:acreditacion,descuento',
        ]);

        $concepto = ConceptoSalario::create($data);
        return response()->json($concepto, 201);
*/
        try {
            $concepto = ConceptoSalario::create($request->all());
            return response()->json($concepto, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * @OA\Put(
     *     path="/api/v1/conceptos-salario/{id}",
     *     summary="Actualizar un concepto salarial",
     *     tags={"Conceptos Salariales"},
     *     @OA\Parameter(
     *         name="id", in="path", required=true, description="ID del concepto salarial", @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ConceptoSalarioRequest")
     *     ),
     *     @OA\Response(response=200, description="Concepto actualizado")
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->validate([
            'nombre_concepto' => 'required|string|max:255',
            'tipo'   => 'required|in:acreditacion,descuento',
        ]);

        $concepto = ConceptoSalario::findOrFail($id);
        $concepto->update($data);

        return response()->json($concepto);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/conceptos-salario/{id}",
     *     summary="Eliminar un concepto salarial",
     *     tags={"Conceptos Salariales"},
     *     @OA\Parameter(
     *         name="id", in="path", required=true, description="ID del concepto salarial", @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Concepto eliminado")
     * )
     */
    public function destroy($id): JsonResponse
    {
        $concepto = ConceptoSalario::findOrFail($id);
        $concepto->delete();

        return response()->json(null, 204);
    }
}
