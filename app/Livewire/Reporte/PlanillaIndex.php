<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Services\ResumenNominaService;
use App\Models\ConceptoSalario;

final class PlanillaIndex extends Component
{

    public $resumen;
    public $conceptos;
    public $conceptosAgrupados;

    public function mount()
    {
        $resumenService = new ResumenNominaService();
        $this->resumen = $resumenService->obtenerResumen(17); // ID de prueba

        $this->conceptos = ConceptoSalario::orderBy('nombre_concepto')->get();

        // Agrupar por tipo para usar en la tabla
        $this->conceptosAgrupados = $this->conceptos
            ->groupBy('tipo')
            ->map(fn ($group) => $group->values()->all())
            ->toArray();

    }

    public function render()
    {
        return view('livewire.reporte.planilla-index')->layout('layouts.app');
    }
}
