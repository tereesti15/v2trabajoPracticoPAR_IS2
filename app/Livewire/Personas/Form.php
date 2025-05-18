<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Personas;

final class Form extends Component
{
    public $personaId;
    public $nombre, $apellido, $documento, $fecha_nacimiento, $email, $direccion, $telefono;

    public function mount($personaId = null)
    {
        if ($personaId) {
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
        return view('livewire.personas.form');
    }
}
