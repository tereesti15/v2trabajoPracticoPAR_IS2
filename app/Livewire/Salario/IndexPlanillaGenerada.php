<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Services\NominaService;
use App\Services\EmpleadoService;

final class IndexPlanillaGenerada extends Component
{

    private $nominaService;
    private $empleadoService;

    public $periodo;
    public $id_nomina;
    public $lista_empleados = [];
    public $lista_nomina = [];
    public $empleadosNomina;
    public $actualiza_detalle_salario;
    public $id_detalle_nomina;
    public $showForm = false;

    public function closeForm()
    {
        $this->actualiza_detalle_salario = false;
    }

    public function edit($id)
    {
        $this->actualiza_detalle_salario = true;
        $this->id_detalle_nomina = $id;
    }

    public function mount($id_nomina)
    {
        $this->actualiza_detalle_salario = false;
        $this->nominaService = new NominaService();
        $this->empleadoService = new EmpleadoService();
        if ($id_nomina)
        {
            //$this->lista_empleados = $this->nominaService->empleadosActivos();
            $data = $this->nominaService->show($id_nomina);
            $this->periodo = $data->periodo_formateado;
            $this->empleadosNomina = $this->nominaService->obtenerDetallesAgrupadosPorEmpleado($id_nomina);
        }
    }

    public function render()
    {
        return view('livewire.salario.index-planilla-generada');
    }
}
