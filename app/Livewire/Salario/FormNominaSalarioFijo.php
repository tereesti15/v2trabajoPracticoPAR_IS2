<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\ConceptoSalario;
use App\Models\NominaAdicionalFijo;

final class FormNominaSalarioFijo extends Component
{

    public $id_empleado;
    public $id_concepto;
    public $importe;
    public $concepto;
    public $conceptos = [];
    public $id_registro;

    public function save()
    {
        $data = $this->validate([
            'id_concepto' => 'required|exists:concepto_salario,id_concepto',
            'concepto' => 'required',
            'importe' => 'required|numeric|min:0',
        ]);

        // Guardar el concepto asignado al empleado, por ejemplo
        // ...

        NominaAdicionalFijo::updateOrCreate(['id' => $this->id_registro],
        [
            'id_nomina' => $this->id_empleado,
            'id_concepto' => $data['id_concepto'],
            'detalle_concepto' => $data['concepto'],
            'importe' => $data['importe'],
        ]);

        session()->flash('message', 'Concepto agregado correctamente.');
    }

    public function mount($id_empleado = null, $id_registro = null)
    {
        $this->id_empleado = $id_empleado;
        $this->conceptos = ConceptoSalario::conceptosDisponiblesParaSelect();
        if($id_registro)
        {
            $dato = NominaAdicionalFijo::findOrFail($id_registro);
            $this->id_registro = $id_registro;
            $this->id_concepto = $dato->id_concepto;
            $this->concepto = $dato->detalle_concepto;
            $this->importe = $dato->importe;
        }
        \Log::info("FormPorcentajeSalarioBase -> mount " . $this->id_empleado . " " . $this->conceptos);
    }


    public function render()
    {
        return view('livewire.salario.form-nomina-salario-fijo');
    }
}
