<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Models\Nomina;
use App\Models\Parametro;
use Barryvdh\DomPDF\Facade\Pdf;

class ListaRecibos extends Component
{
    public Nomina $nomina;
    public $id_registro;
    public $nombre_empresa;
    public $ruc_empresa;

    public function mount($id_nomina)
    {
        $nomina = Nomina::find($id_nomina);
        $this->id_registro = $id_nomina;
        $this->nomina = $nomina->load(
            'detalles.concepto',
            'detalles.empleado.persona',
            'detalles.empleado.cargo',
            'detalles.empleado.departamento'
        );
        $parametro = Parametro::find(1);
        if($parametro)
        {
            $this->nombre_empresa = $parametro->nombre_empresa;
            $this->ruc_empresa = $parametro->ruc;
        }
    }

    public function exportarPdf()
    {
        $pdf = Pdf::loadView('pdf.recibos', [
            'nomina' => $this->nomina,
            'nombre_empresa' => $this->nombre_empresa,
            'ruc_empresa' => $this->ruc_empresa,
        ])->setPaper('A4');

        return response()->streamDownload(fn() => print($pdf->output()), "recibos_nomina_{$this->nombre_empresa}.pdf");
    }

    public function render()
    {
        return view('livewire.reporte.lista-recibos')->layout('layouts.app');
    }
}
