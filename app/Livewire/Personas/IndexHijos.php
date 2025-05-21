<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Hijo;

class IndexHijos extends Component
{
    public $personaId;
    public $showForm;
    
    public $nombre, $fecha_nacimiento, $documento, $discapacitado;

    public $listaHijos = [];

     public function mount($personaId = null)
    {
        \Log::info("IndexHijos -> mount " . $personaId );
        /*
        if ($personaId) {
            $listaHijos = Hijo::findOrFail($personaId);
            
            $this->personaId = $personaId;
            $this->nombre = $hijo->nombre;
            $this->fecha_nacimiento = $hijo->fecha_nacimiento;
            $this->documento = $hijo->documento;
            $this->discapacitado = $hijo->discapacitado;
        }
            */
        if ($personaId) {
            $this->personaId = $personaId;
            $this->listaHijos = Hijo::where('persona_id', $personaId)->get();
        }
    }

    public function render()
    {
        return view('livewire.personas.index-hijos');
    }
}
