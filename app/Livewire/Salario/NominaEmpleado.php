<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\Empleados;
use App\Models\NominaAdicionalFijo;
use App\Models\NominaPorcentualMinimo;
use App\Models\ConceptoSalario;
use App\Models\NominaPorcentajeSalarioBase;
use App\Models\NominaDetalleCuota;
use App\Models\NominaMensualTemporal;

final class NominaEmpleado extends Component
{

    public $empleadoId;
    public $empleado;
    public $id_registro_fijo;

    public $conceptoSalarialesFijos = [];
    public $porcentuales = [];
    public $porcentualesSalarioBase = [];
    public $salarioCuota = [];
    public $lista_conceptos_mensuales_temporales = [];

    public $modalSection = '';
    public $conceptos = [];
    public $nuevoConcepto = [
        'id_concepto' => '',
        'monto' => '',
    ];

    public $setFormPorcentajeSalarioBase = false;
    public $setSalarioFijo = false;
    public $setSalarioCuota = false;
    public $setSalarioTemporal = false;

    public $idSalarioCuota;
    public $id_salario_temporal;

    protected $listeners = ['closeForm' => 'closeForm'];

    public function closeForm()
    {
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = false;
        $this->setSalarioCuota = false;
        $this->setSalarioTemporal = false;
        $this->actualizaGrilla();
    }

    public function showSalarioTemporal($id)
    {
        $this->setSalarioTemporal = true;
    }

    public function editConceptoTemporal($id)
    {
        $this->id_salario_temporal = $id;
        $this->setSalarioTemporal = true;
    }

    public function deleteConceptoTemporal($id)
    {
        NominaMensualTemporal::destroy($id);
        $this->actualizaGrilla();
    }

    public function eliminarRegistroFijo($id)
    {
        NominaAdicionalFijo::destroy($id);
        $this->actualizaGrilla();
    }

    public function borrarSalarioCuota($id)
    {
        NominaDetalleCuota::destroy($id);
        $this->actualizaGrilla();
    }

    public function editSalarioCuota($id)
    {
        $this->idSalarioCuota = $id;
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = false;
        $this->setSalarioCuota = true;
        $this->setSalarioTemporal = false;
    }

    public function showSalarioFijo($id)
    {
        \Log::info("ENTRA FUNCION NominaEmpleado -> setSalarioFijo " . $id);
        $this->empleadoId = $id;
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = true;
        $this->setSalarioCuota = false;
        $this->setSalarioTemporal = false;
    }

    public function showPorcentajeSalarioBase($id) {
        \Log::info("ENTRA FUNCION NominaEmpleado -> setPorcentajeSalarioBase " . $id);
        $this->empleadoId = $id;
        $this->setFormPorcentajeSalarioBase = true;
        $this->setSalarioFijo = false;
        $this->setSalarioCuota = false;
        $this->setSalarioTemporal = false;
    }

    public function showSalarioCuota($id) {
        $this->empleadoId = $id;
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = false;
        $this->setSalarioCuota = true;
        $this->setSalarioTemporal = false;
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
        $this->actualizaGrilla();
    }

    public function actualizarRegistro($id)
    {
        \Log::info("ENTRA FUNCION actualizarRegistro " . $id);
        //$this->empleadoId = $id;
        $this->id_registro_fijo = $id;
        $this->setFormPorcentajeSalarioBase = false;
        $this->setSalarioFijo = true;
        $this->setSalarioCuota = false;
        $this->setSalarioTemporal = false;
    }

    private function actualizaGrilla()
    {
        
        $this->porcentualesSalarioBase = $this->empleado->nomina_porcentaje_salario_base;
        //\Log::info("$this->porcentualesSalarioBase " . $this->porcentualesSalarioBase);

        $this->conceptoSalarialesFijos = $this->empleado->nomina_fijo_salario;

        $this->lista_conceptos_mensuales_temporales = NominaMensualTemporal::with('concepto')
            ->where('id_empleado', $this->empleadoId)->get();
        $this->porcentuales = NominaPorcentualMinimo::with('concepto')
            ->where('id_nomina', $this->empleadoId)->get();

        $this->conceptos = ConceptoSalario::all();
        $this->salarioCuota = NominaDetalleCuota::with('concepto')
            ->where('id_empleado', $this->empleadoId)->get();
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
