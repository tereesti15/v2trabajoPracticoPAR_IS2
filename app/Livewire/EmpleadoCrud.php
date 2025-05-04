<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleados;

final class EmpleadoCrud extends Component
{
    public $empleados = [];

    public function mount()
    {
        $this->empleados = Empleados::with('persona')
            ->select('id_empleado', 'id_persona', 'salario_base', 'estado_empleado')
            ->get()
            ->map(function ($empleado) {
                return [
                    'id_empleado' => $empleado->id_empleado,
                    'nombre_completo' => $empleado->persona?->nombre . ' ' . $empleado->persona?->apellido,
                    'salario_base' => $empleado->salario_base,
                    'estado_empleado' => $empleado->estado_empleado,
                ];
            })->toArray();
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
