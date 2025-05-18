<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Services\EmpleadoService;

final class Form extends Component
{

    private $empleadoService;
    public $empleadoId;
    public $nombre, $apellido, $documento, $fecha_nacimiento, $email, $direccion, $telefono;

    public function mount($empleadoId = null)
    {
        $this->empleadoService = new EmpleadoService();
        if ($empleadoId) {
            $persona = Personas::findOrFail($personaId);
            $this->personaId = $personaId;
            $this->nombre = $persona->nombre;
            $this->apellido = $persona->apellido;
            $this->documento = $persona->documento;
            $this->email = $persona->email;
            $this->telefono = $persona->telefono;
            $this->direccion = $persona->direccion;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'documento' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'nullable',
        ]);

        Personas::updateOrCreate(['id' => $this->personaId], $data);

        $this->reset(); // Limpia las propiedades públicas
        $this->dispatch('personaUpdated'); // Notifica al padre
    }

    public function render()
    {
        return view('livewire.empleados.form')->layout('layouts.app');
    }
}
