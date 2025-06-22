<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Services\EmpleadoService;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Personas;

final class Form extends Component
{
    private $empleadoService;

    public $empleadoId;
    public $id_persona;
    public $id_cargo;
    public $id_departamento;
    public $fecha_ingreso;
    public $salario_base;
    public $estado_empleado = "Activo";
    public $nombre_persona;

    public $lista_persona = [];
    public $lista_cargo = [];
    public $lista_departamento = [];

    public function mount($empleadoId = null)
    {
        $this->empleadoService = new EmpleadoService();
        $this->lista_persona = Personas::orderBy('apellido', 'asc')->get();
        $this->lista_cargo = Cargo::orderBy('nombre_cargo', 'asc')->get();
        $this->lista_departamento = Departamento::orderBy('nombre_departamento', 'asc')->get();
        if ($empleadoId) {
            $empleado = $this->empleadoService->show($empleadoId);
            \Log::info("DATO EMPLEADO " . $empleado);
            $nombre_persona = $this->empleadoService;
            $this->nombre_persona = $empleado->nombre_persona;
            $this->id_persona = $empleado->id_persona;
            $this->empleadoId = $empleadoId;
            $this->id_cargo = $empleado->id_cargo;
            $this->id_departamento = $empleado->id_departamento;
            $this->fecha_ingreso = $empleado->fecha_ingreso->format('Y-m-d');
            $this->salario_base = $empleado->salario_base;
        }
    }

    public function save()
    {
        //\Log::info("Entra Form->save ANTES DE TODO PROCESO");
        try
        {
            $this->empleadoService = new EmpleadoService();
            $data = $this->validate([
                'id_persona' => 'required',
                'id_cargo' => 'required',
                'id_departamento' => 'required',
                'fecha_ingreso' => 'required',
                'salario_base' => 'required',
                'estado_empleado' => 'required',
            ]);
            //\Log::info("Entra Form->save " . $data . " empleado=>" . $this->empleadoId);
            if($this->empleadoId)
            {
                $this->empleadoService->update($this->empleadoId, $data);
            }
            else
            {
                $this->empleadoService->store($data);
            }
            
            $this->reset(); // Limpia las propiedades públicas
            $this->dispatch('empleadoUpdated'); // Notifica al padre
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error("Error de validación: ", $e->errors());
        }
    }

    public function render()
    {
        return view('livewire.empleados.form')->layout('layouts.app');
    }
}
