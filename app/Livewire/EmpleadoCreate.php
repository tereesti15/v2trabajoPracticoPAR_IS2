<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;
use App\Models\Empleados;
use App\EstadoEmpleado;

final class EmpleadoCreate extends Component
{
    public $id_persona, $salario_base, $estado_empleado, $personas;
    public $estados = [];
    
    public function mount()
    {
        $this->personas = Personas::all();
        $this->estados = collect(EstadoEmpleado::cases())->pluck('value')->toArray();
    }

    public function save()
    {
        $this->validate([
            'id_persona' => 'required|exists:personas,id',
            'salario_base' => 'required|numeric|min:0',
            'estado_empleado' => 'required|string'
        ]);

        Empleados::create([
            'id_persona' => $this->id_persona,
            'id_cargo' => 1, // temporal o ajusta según tu lógica
            'id_departamento' => 1,
            'fecha_ingreso' => now(),
            'salario_base' => $this->salario_base,
            'estado_empleado' => $this->estado_empleado
        ]);

        /*
        $this->emit('empleadoCreado');
        $this->dispatchBrowserEvent('cerrarFormulario'); // si usas Alpine para controlar visibilidad
        $this->emit('empleadoCreado');
        */
        $this->dispatch('cambiarVista', vista: 'empleado-crud');
    }

    public function render()
    {
        return view('livewire.empleado-create');
    }
}