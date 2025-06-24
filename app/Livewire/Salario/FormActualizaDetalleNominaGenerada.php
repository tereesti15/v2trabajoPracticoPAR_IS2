<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Services\NominaService;
use App\Models\DetalleNomina;

final class FormActualizaDetalleNominaGenerada extends Component
{
    public $id_detalle_nomina;
    public $detalle_nomina;
    public $nombre_concepto;
    public $detalle_concepto;
    public $monto_concepto;
    public $tipo_concepto;
    private $nominaService;

    public function mount($id_detalle_nomina)
    {
        if($id_detalle_nomina)
        {
            $this->nominaService = new NominaService();
            $this->id_detalle_nomina = $id_detalle_nomina;
            $this->detalle_nomina = $this->nominaService->obtenerDetalleNominaGeneradaPor($id_detalle_nomina);
            $this->nombre_concepto = $this->detalle_nomina->concepto->nombre_concepto;
            $this->tipo_concepto = $this->detalle_nomina->concepto->tipo;
            $this->detalle_concepto = $this->detalle_nomina->detalle_concepto;
            $this->monto_concepto = $this->detalle_nomina->monto_concepto;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'detalle_concepto' => 'required',
            'monto_concepto' => 'required|numeric|min:0',
        ]);

        // Guardar el concepto asignado al empleado, por ejemplo
        // ...

        DetalleNomina::updateOrCreate(['id_detalle_nomina' => $this->id_detalle_nomina],
        [
            'detalle_concepto' => $data['detalle_concepto'],
            'monto_concepto' => $data['monto_concepto'],
        ]);

        //session()->flash('message', 'Concepto agregado correctamente.');
        $this->dispatch('cerrarFormulario'); // Notifica al padre
    }

    public function render()
    {
        return view('livewire.salario.form-actualiza-detalle-nomina-generada');
    }
}
