<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Personas;

final class Form extends Component
{
    public $personaId;
    public $nombre, $apellido, $ci, $fecha_nacimiento, $sexo, $direccion;

    public function mount($personaId = null)
    {
        if ($personaId) {
            $persona = Personas::findOrFail($personaId);
            $this->personaId = $personaId;
            $this->nombre = $persona->nombre;
            $this->apellido = $persona->apellido;
            $this->ci = $persona->ci;
            $this->fecha_nacimiento = $persona->fecha_nacimiento;
            $this->sexo = $persona->sexo;
            $this->direccion = $persona->direccion;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'ci' => 'required|unique:personas,ci,' . $this->personaId,
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required',
            'direccion' => 'nullable',
        ]);

        Personas::updateOrCreate(['id' => $this->personaId], $data);

        $this->dispatch('personaUpdated');
    }

    public function render()
    {
        return view('livewire.personas.form');
    }
}
