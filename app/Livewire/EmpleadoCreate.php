<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;
use App\Models\Empleados;
use App\EstadoEmpleado;
use App\Services\EmpleadoService;
use Exception;
use App\Models\Cargo;
use App\Models\Departamento;

final class EmpleadoCreate extends Component
{
    public $id_persona, $salario_base, $estado_empleado;
    public $estados = [];

    public $id_cargo;
    public $id_departamento;

    public $personas = [];
    public $cargos = [];
    public $departamentos = [];
    
    public function mount()
    {
        $this->personas = Personas::all();
        $this->cargos = Cargo::all();
        $this->departamentos = Departamento::all();
        $this->estados = collect(EstadoEmpleado::cases())->pluck('value')->toArray();
    }

    public function save()
    {
        $this->validate([
            'id_persona' => 'required|exists:personas,id',
            'id_cargo' => 'required|exists:cargos,id_cargo',
            'id_departamento' => 'required|exists:departamentos,id',
            'salario_base' => 'required|numeric|min:0',
            'estado_empleado' => 'required|string'
        ]);

        try {
            $service = app(EmpleadoService::class);

            $service->store([
                'id_persona' => $this->id_persona,
                'id_cargo' => $this->id_cargo,
                'id_departamento' => $this->id_departamento,
                'fecha_ingreso' => now(),
                'salario_base' => $this->salario_base,
                'estado_empleado' => $this->estado_empleado
            ]);

            $this->dispatch('cambiarVista', vista: 'empleado-crud');

        } catch (Exception $e) {
            $this->addError('general', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.empleado-create');
    }
}