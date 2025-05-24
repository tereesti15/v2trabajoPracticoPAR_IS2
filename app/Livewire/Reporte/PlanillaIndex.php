<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Services\ResumenNominaService;
use App\Models\ConceptoSalario;

final class PlanillaIndex extends Component
{

    public $resumen;

 // Obtiene el resumen de nómina
    //$resumen = $service->obtenerResumen($id_nomina);
    // Obtiene los conceptos para usarlos en la vista
    public $conceptos;
    

    public function mount()
    {
        $resumenService = new ResumenNominaService();
        $this->resumen = $resumenService->obtenerResumen(7);
        $this->conceptos = ConceptoSalario::orderBy('nombre_concepto')->get();
    }

    public function render()
    {
        return view('livewire.reporte.planilla-index')->layout('layouts.app');
    }
}
