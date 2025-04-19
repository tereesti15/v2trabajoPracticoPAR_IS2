<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Http\Controllers\Controller;
final class PersonasController extends Controller
{
    public function index() {
        $personas = Personas::all();
        return response()->json($personas);
    }

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
}
