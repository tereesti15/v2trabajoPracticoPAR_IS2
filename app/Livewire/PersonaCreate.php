<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;

class PersonaCreate extends Component
{
    public $nombre;
    public $apellido;
    public $documento;
    public $direccion;
    public $telefono;
    public $email;
    public $fecha_nacimiento;
//    public $discapacitado = false;
    
    public $personas = [];

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'documento' => 'required|string|max:20|unique:personas,documento',
        'direccion' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        //'fecha_nacimiento' => 'nullable|date',
  //      'discapacitado' => 'boolean',
    ];

    public function save()
    {
        logger('Antes de validar');
        $this->validate();
        $persona = Personas::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'documento' => $this->documento,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            //'fecha_nacimiento' => $this->fecha_nacimiento,
    //        'discapacitado' => $this->discapacitado,
        ]);
        session()->flash('message', 'Persona guardada correctamente.');

        $this->dispatch('cambiarVista', vista: 'persona-crud');
    }

    public function render()
    {
        logger('Renderizando componente persona-create');
        return view('livewire.persona-create');
    }

    public function mount()
    {
        logger('Renderizando mount componente persona-create');
        $this->personas = Personas::orderBy('apellido')->orderBy('nombre')->get();
    }
}
