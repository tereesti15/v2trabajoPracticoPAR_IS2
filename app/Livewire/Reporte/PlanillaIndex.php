<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Services\ResumenNominaService;
use App\Models\ConceptoSalario;
use App\Models\Parametro;
use App\Models\Nomina;
use Barryvdh\DomPDF\Facade\Pdf;

final class PlanillaIndex extends Component
{

    public $resumen;
    public $conceptos;
    public $conceptosAgrupados;
    public $ruc;
    public $empresa;
    public $mes;
    public $anho;

    public $id_nomina;

    public function mount($id_nomina)
    {
        \Log::info('ENTRA PARA IMPRIMIR PLANILLA ID ' . $id_nomina);
        $this->id_nomina = $id_nomina;
        $resumenService = new ResumenNominaService();
        $this->resumen = $resumenService->obtenerResumen($this->id_nomina); // ID de prueba

        $this->conceptos = ConceptoSalario::orderBy('nro_orden', 'desc')->get();

        // Agrupar por tipo para usar en la tabla
        $this->conceptosAgrupados = $this->conceptos
            ->groupBy('tipo')
            ->map(fn ($group) => $group->values()->all())
            ->toArray();
        $datoNomina = Nomina::find($this->id_nomina);
        if($datoNomina)
        {            
            $meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
                4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
                10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];
            $nombreMes = $meses[$datoNomina->mes_periodo];
            $this->mes = $nombreMes;
            $this->anho = $datoNomina->anho_periodo;
        }
        
        $parametro = Parametro::find(1);
        \Log::info("Obtiene datos parametros " . $parametro);
        $this->ruc = $parametro->ruc;
        $this->empresa = $parametro->nombre_empresa;
    }

    public function exportarPdf()
    {
        $pdf = Pdf::loadView('pdf.planilla_nomina', [
            'resumen' => $this->resumen,
            'conceptosAgrupados' => $this->conceptosAgrupados,
            'empresa' => $this->empresa,
            'ruc' => $this->ruc,
            'mes' => $this->mes,
            'anho' => $this->anho,
        ])->setPaper([0, 0, 842, 895], 'landscape');

        return response()->streamDownload(fn() => print($pdf->output()), "planilla_nomina_{$this->id_nomina}.pdf");
    }

    public function render()
    {
        return view('livewire.reporte.planilla-index')->layout('layouts.app');
    }
}
