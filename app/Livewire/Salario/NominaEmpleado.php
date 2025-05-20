<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\Empleados;
use App\Models\NominaAdicionalFijo;
use App\Models\NominaPorcentualMinimo;
use App\Models\ConceptoSalario;
use App\Models\NominaPorcentajeSalarioBase;

final class NominaEmpleado extends Component
{

    public $empleadoId;
    public $empleado;

    public $conceptoSalarialesFijos = [];
    public $porcentuales = [];
    public $porcentualesSalarioBase = [];

    public $modalSection = '';
    public $conceptos = [];
    public $nuevoConcepto = [
        'id_concepto' => '',
        'monto' => '',
    ];

    public $setFormPorcentajeSalarioBase = false;
    public $setSalarioFijo = false;

    //protected $listeners = ['mostrarModalListener' => 'mostrarModal'];

    public function showSalarioFijo($id)
    {
        \Log::info("ENTRA FUNCION NominaEmpleado -> setSalarioFijo " . $id);
        $this->empleadoId = $id;
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = true;
    }


    public function showPorcentajeSalarioBase($id) {
        \Log::info("ENTRA FUNCION NominaEmpleado -> setPorcentajeSalarioBase " . $id);
        $this->empleadoId = $id;
        $this->setFormPorcentajeSalarioBase = true;
        $this->setSalarioFijo = false;
    }
/*
    public function mostrarModal($section)
    {
        \Log::info("Entra mostrar modal " . $section);
        $this->modalSection = $section;
        $this->reset('nuevoConcepto');
        $this->dispatch('mostrarModal');
    }
*/
    public function closeSalaryView()
    {
        $this->showSalary = false;
        $this->empleadoIdForSalary = null;
    }

    public function mount($empleadoId)
    {
        $this->empleadoId = $empleadoId;
        $this->empleado = Empleados::findOrFail($empleadoId);

        $this->porcentualesSalarioBase = $this->empleado->nomina_porcentaje_salario_base;
        //\Log::info("$this->porcentualesSalarioBase " . $this->porcentualesSalarioBase);

        $this->conceptoSalarialesFijos = $this->empleado->nomina_fijo_salario;

        $this->porcentuales = NominaPorcentualMinimo::with('concepto')
            ->where('id_nomina', $empleadoId)->get();

        $this->conceptos = ConceptoSalario::all();
    }
/*
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
        $this->dispatch('cerrarModal');
    }

    public function abrirModalAgregar($tipo)
    {
        \Log::info("abrirModalAgregar " . $tipo);
        $this->modalSection = $tipo;
        $this->nuevoConcepto = [
            'id_concepto' => '',
            'monto' => '',
        ];

        $this->dispatch('mostrarModal');
    }
*/
    public function render()
    {
        return view('livewire.salario.nomina-empleado');
    }
}
