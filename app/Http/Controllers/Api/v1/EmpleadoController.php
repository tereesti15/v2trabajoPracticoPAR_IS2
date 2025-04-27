<?php

namespace App\Http\Controllers\API\v1;

use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;
use App\Models\Empleados;
use Illuminate\Http\Request;

/**
 *
 * @OA\Tag(
 *     name="Empleados",
 *     description="Operaciones relacionadas con los empleados"
 * )
 *
 * @OA\Get(
 *     path="/api/v1/empleados",
 *     summary="Listar empleados",
 *     tags={"Empleados"},
 *     @OA\Response(response=200, description="Lista de empleados")
 * )
 *
 * @OA\Post(
 *     path="/api/v1/empleados",
 *     summary="Crear empleado",
 *     tags={"Empleados"},
 *     @OA\RequestBody(
 *         required=true,
 *          @OA\JsonContent(ref="#/components/schemas/Empleado")
 *     ),
 *     @OA\Response(response=201, description="Empleado creado")
 * )
 *
 * @OA\Get(
 *     path="/api/v1/empleados/{id}",
 *     summary="Obtener un empleado",
 *     tags={"Empleados"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Empleado encontrado"),
 *     @OA\Response(response=404, description="Empleado no encontrado")
 * )
 *
 * @OA\Put(
 *     path="/api/v1/empleados/{id}",
 *     summary="Actualizar un empleado",
 *     tags={"Empleados"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/Empleado")),
 *     @OA\Response(response=200, description="Empleado actualizado"),
 *     @OA\Response(response=404, description="Empleado no encontrado")
 * )
 *
 * @OA\Delete(
 *     path="/api/v1/empleados/{id}",
 *     summary="Eliminar un empleado",
 *     tags={"Empleados"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Empleado eliminado"),
 *     @OA\Response(response=404, description="Empleado no encontrado")
 * )
 * 
 */


final class EmpleadoController extends Controller
{

    protected $empleadoService;

    public function __construct(EmpleadoService $empleadoService)
    {
        $this->empleadoService = $empleadoService;
    }

    // GET /api/empleados
    public function index()
    {
        return response()->json(Empleados::all(), 200);
    }

    // GET /api/empleados/{id}
    public function show($id)
    {
        $empleado = Empleados::find($id);
        if (!$empleado) {
            return response()->json(['error' => 'Empleado no encontrado'], 404);
        }
        return response()->json($empleado, 200);
    }

    // POST /api/empleados
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_persona' => 'required|integer',
            'id_cargo' => 'required|integer',
            'id_departamento' => 'required|integer',
            'fecha_ingreso' => 'required|date',
            'salario_base' => 'required|numeric',
            'estado_empleado' => 'required|string',
            'fecha_egreso' => 'nullable|date',
        ]);

        try {
            $empleado = $this->empleadoService->crearEmpleado($request->all());
            return response()->json($empleado, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // PUT /api/empleados/{id}
    public function update(Request $request, $id)
    {
        $empleado = Empleados::find($id);
        if (!$empleado) {
            return response()->json(['error' => 'Empleado no encontrado'], 404);
        }

        $validated = $request->validate([
            //'id_persona' => 'required|integer',
            'id_cargo' => 'required|integer',
            'id_departamento' => 'required|integer',
            'fecha_ingreso' => 'required|date',
            'salario_base' => 'required|numeric',
            'estado_empleado' => 'required|string',
            'fecha_egreso' => 'nullable|date',
        ]);

        //$empleado->update($validated);
        //return response()->json($empleado, 200);
        try {
            $empleadoActualizado = $this->empleadoService->actualizarEmpleado($id, $validated);
            return response()->json($empleadoActualizado, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // DELETE /api/empleados/{id}
    public function destroy($id)
    {
        try {
            $this->empleadoService->borrarEmpleado($id);
            return response()->json(['message' => 'Empleado eliminado correctamente.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
