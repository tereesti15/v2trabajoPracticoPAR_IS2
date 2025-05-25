<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Services\ResumenNominaService;
use App\Models\ConceptoSalario;
use App\Models\Parametro;

final class PlanillaIndex extends Component
{

    public $resumen;
    public $conceptos;
    public $conceptosAgrupados;
    public $ruc;
    public $empresa;
    public $mes;
    public $anho;

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
        $this->mes = 5;
        $this->anho = 2025;
        $parametro = Parametro::find(1);
        \Log::info("Obtiene datos parametros " . $parametro);
        $this->ruc = $parametro->ruc;
        $this->empresa = $parametro->nombre_empresa;
    }

    public function render()
    {
        return view('livewire.reporte.planilla-index')->layout('layouts.app');
    }
}
