<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\NominaDetalleCuota;
use App\Models\Empleados;
use App\Models\ConceptoSalario;
use App\TipoConceptoNomina;

final class FormSalarioCuota extends Component
{

    public $id_empleado;
    public $id_registro;
    public $nombre_empleado = "";
    public $lista_conceptos = [];
    public $lista_tipos = [];

    public $id_concepto;
    public $detalle_concepto;
    public $cant_cuota;
    public $nro_cuota = 0;
    public $monto_concepto;
    public $tipo = 'descuento';

    private $empleado_detalle;

    public function grabar()
    {
        $data = $this->validate([
            'id_concepto' => 'required|exists:concepto_salario,id_concepto',
            'detalle_concepto' => 'required',
            'cant_cuota' => 'required|numeric|min:1|max:100',
            'monto_concepto' => 'required|numeric|min:1|max:100000000',
            'nro_cuota' => 'required|numeric|min:0|max:100',
        ]);

        // Guardar el concepto asignado al empleado, por ejemplo
        // ...

        NominaDetalleCuota::create([
            'id_nomina' => $this->id_empleado, 
            'id_concepto' => $data['id_concepto'],
            'detalle_concepto' => $data['detalle_concepto'],
            'cant_cuota' => $data['cant_cuota'],
            'nro_cuota' => $data['nro_cuota'],
            'monto_concepto' => $data['monto_concepto'],
        ]);

        session()->flash('message', 'Concepto agregado correctamente.');
    }

    public function editar()
    {

    }

    public function mount($id_empleado)
    {
        $this->id_empleado = $id_empleado;
        $this->empleado_detalle = Empleados::findOrFail($this->id_empleado);
        $this->nombre_empleado = $this->empleado_detalle->nombre_persona;
        $this->lista_conceptos = ConceptoSalario::conceptosDisponiblesParaSelect();
        $this->lista_tipos = collect(TipoConceptoNomina::cases());
    }

    public function render()
    {
        return view('livewire.salario.form-salario-cuota');
    }
}
