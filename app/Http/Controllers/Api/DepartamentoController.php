<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
     // Obtener todos los departamentos
     public function index()
     {
         $departamentos = Departamento::all();
         return response()->json($departamentos);
     }
 
     // Crear un nuevo departamento
    public function store(Request $request)
    {
        $request->validate([
            'nombre_departamento' => 'required|string',
            'ubicacion' => 'required|string',
        ]);

        $departamento = Departamento::create($request->all());
        return response()->json($departamento, 201);
    }
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
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['mensaje' => 'Departamento no encontrado'], 404);
        }

        $request->validate([
            'nombre_departamento' => 'required|string',
            'ubicacion' => 'required|string',
        ]);

        $departamento->update($request->all());

        return response()->json([
            'mensaje' => 'Departamento actualizado con éxito',
            'departamento' => $departamento
        ]);
    }
}
