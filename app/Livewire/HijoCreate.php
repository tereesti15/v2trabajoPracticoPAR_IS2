<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Hijo;
use App\Models\Personas;
use Carbon\Carbon;

class HijoCreate extends Component
{
    public $persona_id, $nombre, $fecha_nacimiento, $documento, $discapacitado = false;
    public $personas;

    public function mount()
    {
        $this->personas = Personas::orderBy('apellido')->get();
    }

    public function save()
    {
        $this->validate([
            'persona_id' => 'required|exists:personas,id',
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'documento' => 'required|string|unique:hijos',
            'discapacitado' => 'boolean',
        ]);

        Hijo::create([
            'persona_id' => $this->persona_id,
            'nombre' => $this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'documento' => $this->documento,
            'discapacitado' => $this->discapacitado,
        ]);

        session()->flash('message', 'Hijo registrado correctamente');
        $this->reset(['persona_id', 'nombre', 'fecha_nacimiento', 'documento', 'discapacitado']);
    }

    public function render()
    {
        return view('livewire.hijo-create');
    }
}
