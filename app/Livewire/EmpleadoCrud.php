<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleados;
use App\EstadoEmpleado;
use App\Services\EmpleadoService;

final class EmpleadoCrud extends Component
{
    public $empleados = [];
    public $estadosEmpleado = [];
    public $view = 'listado';
    protected $listeners = ['empleadoCreado' => 'volverAlListado'];

    public function mostrarFormularioCreacion()
    {
        $this->view = 'crear';
    }

    public function volverAlListado()
    {
        $this->view = 'listado';
    }

    public function mount()
    {
        $this->empleados = Empleados::with('persona')->get()->toArray();
    
        // Obtener los valores del Enum
        $this->estadosEmpleado = collect(EstadoEmpleado::cases())->pluck('value')->toArray();
    }
  
    public function deleteEmpleado($id)
    {
        $empleado = Empleados::find($id);
        if ($empleado) {
            $empleado->delete();
            $this->empleados = Empleados::select('id_empleado', 'id_persona', 'salario_base', 'estado_empleado')->get()->toArray();
            session()->flash('message', 'Empleado eliminado correctamente');
        } else {
            session()->flash('error', 'No se pudo eliminar el empleado');
        }
    }

    public function render()
    {
        return view('livewire.empleado-crud');
    }
}
