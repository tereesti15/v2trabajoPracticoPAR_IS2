<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\ConceptoSalario;
use App\Models\NominaPorcentajeSalarioBase;

final class FormPorcentajeSalarioBase extends Component
{
    public $id_empleado;
    public $id_concepto;
    public $porcentaje;
    public $concepto;
    public $conceptos = [];

    public function update()
    {

    }

    public function save()
    {
        $data = $this->validate([
            'id_concepto' => 'required|exists:concepto_salario,id_concepto',
            'concepto' => 'required',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        // Guardar el concepto asignado al empleado, por ejemplo
        // ...

        NominaPorcentajeSalarioBase::create([
            'id_nomina' => $this->id_empleado, 
            'id_concepto' => $data['id_concepto'],
            'detalle_concepto' => $data['concepto'],
            'porcentaje' => $data['porcentaje'],
        ]);

        session()->flash('message', 'Concepto agregado correctamente.');
    }

    public function mount($id_empleado = null)
    {
        $this->id_empleado = $id_empleado;
        $this->conceptos = ConceptoSalario::orderBy('nombre_concepto', 'desc')->get();
        \Log::info("FormPorcentajeSalarioBase -> mount " . $this->id_empleado . " " . $this->conceptos);
    }

    public function render()
    {
        return view('livewire.salario.form-porcentaje-salario-base');
    }
}
