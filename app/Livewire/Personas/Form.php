<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Personas;
use App\SexoPersona;

final class Form extends Component
{
    public $personaId;
    public $nombre, $apellido, $documento, $fecha_nacimiento, $email, $direccion, $telefono;
    public $sexo;
    public $lista_sexo = [];

    public function mount($personaId = null)
    {
        $this->lista_sexo = array_map(fn($sexo) => $sexo->value, SexoPersona::cases());
        if ($personaId) {
            $persona = Personas::findOrFail($personaId);
            $this->personaId = $personaId;
            $this->nombre = $persona->nombre;
            $this->apellido = $persona->apellido;
            $this->documento = $persona->documento;
            $this->sexo = $persona->sexo;
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
            'sexo' => 'required',
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
