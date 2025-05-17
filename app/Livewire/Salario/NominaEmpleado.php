<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\Empleados;
use App\Models\NominaAdicionalFijo;
use App\Models\NominaPorcentualMinimo;
use App\Models\ConceptoSalario;

final class NominaEmpleado extends Component
{
    public $empleadoId;
    public $empleado;

    public $adicionales = [];
    public $porcentuales = [];

    public $modalSection = '';
    public $conceptos = [];
    public $nuevoConcepto = [
        'id_concepto' => '',
        'monto' => '',
    ];

    protected $listeners = ['mostrarModal'];

    public function mount($empleadoId)
    {
        $this->empleadoId = $empleadoId;
        $this->empleado = Empleados::findOrFail($empleadoId);

        $this->adicionales = NominaAdicionalFijo::with('concepto')
            ->where('id_nomina', $empleadoId)->get();

        $this->porcentuales = NominaPorcentualMinimo::with('concepto')
            ->where('id_nomina', $empleadoId)->get();

        $this->conceptos = ConceptoSalario::all();
    }

    public function mostrarModal($section)
    {
        $this->modalSection = $section;
        $this->reset('nuevoConcepto');
        $this->dispatchBrowserEvent('mostrarModal');
    }

    public function agregarConcepto()
    {
        if ($this->modalSection === 'adicional') {
            NominaAdicionalFijo::create([
                'id_concepto' => $this->nuevoConcepto['id_concepto'],
                'id_nomina' => $this->empleadoId,
                'detalle_concepto' => 'Texto de ejemplo para concepto adicional fijo.',
                'importe' => $this->nuevoConcepto['monto'],
            ]);
        } elseif ($this->modalSection === 'porcentual') {
            NominaPorcentualMinimo::create([
                'id_concepto' => $this->nuevoConcepto['id_concepto'],
                'id_nomina' => $this->empleadoId,
                'detalle_concepto' => 'Texto de ejemplo para concepto porcentual mínimo.',
                'porcentaje' => $this->nuevoConcepto['monto'],
            ]);
        }

        $this->mount($this->empleadoId); // Refrescar datos
        $this->dispatchBrowserEvent('cerrarModal');
    }

    public function render()
    {
        return view('livewire.salario.nomina-empleado');
    }
}
