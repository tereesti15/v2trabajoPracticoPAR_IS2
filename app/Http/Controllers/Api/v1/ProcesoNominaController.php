<?php

namespace App\Http\Controllers\API\v1;

use App\Services\NominaService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class ProcesoNominaController extends Controller
{
    protected $nominaService;

    public function __construct(NominaService $nominaService)
    {
        $this->nominaService = $nominaService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mes' => 'required|integer',
            'anho' => 'required|integer',
        ]);
        $this->nominaService->procesarPlanilla($validated['mes'], $validated['anho']);
        return response()->json(['message' => 'Nómina procesada correctamente'], 200);
    }

    public function obtenerHijos($idPersona)
    {
        $hijos = $this->nominaService->obtenerHijosPorPersona($idPersona);

        if (!$hijos) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        return response()->json($hijos);
    }
}
