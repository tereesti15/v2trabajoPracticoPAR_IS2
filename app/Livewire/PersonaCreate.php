<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;

class PersonaCreate extends Component
{
    public $nombre, $apellido, $documento, $direccion, $telefono, $email;
    public $personas;
    
    public function save()
    {
        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'documento' => 'required|unique:personas',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'nullable|email',
        ]);

        Personas::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'documento' => $this->documento,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Persona creada exitosamente');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.persona-create');
    }

    public function mount()
    {
        $this->personas = Personas::orderBy('apellido')->orderBy('nombre')->get();
    }
}
