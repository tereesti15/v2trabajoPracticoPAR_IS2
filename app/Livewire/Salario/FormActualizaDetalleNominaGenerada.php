<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\DetalleNomina;
use App\Services\NominaService;

final class FormActualizaDetalleNominaGenerada extends Component
{
    public $id_detalle_nomina;
    public $detalle_nomina;
    public $nombre_concepto;
    public $detalle_concepto;
    public $importe;
    public $tipo_concepto;
    
    private $nominaService;

    public function mount($id_detalle_nomina)
    {
        if($id_detalle_nomina)
        {
            $this->nominaService = new NominaService();
            $this->id_detalle_nomina = $id_detalle_nomina;
            $this->detalle_nomina = $this->nominaService->obtenerDetalleNominaGeneradaPor($id_detalle_nomina);
            $this->nombre_concepto = $this->detalle_nomina;
        }
    }

    public function render()
    {
        return view('livewire.salario.form-actualiza-detalle-nomina-generada');
    }
}
