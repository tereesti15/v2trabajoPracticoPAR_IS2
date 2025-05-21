<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Hijo;

final class FormHijo extends Component
{
    public $hijoId, $personaId;
    public $nombre, $fecha_nacimiento, $documento, $discapacitado;

    public function mount($hijoId = null, $id)
    {
        $this->personaId = $id;
        if ($hijoId) {
            $hijo = Hijo::findOrFail($hijoId);
            
            $this->hijoId = $hijoId;
            $this->nombre = $hijo->nombre;
            $this->fecha_nacimiento = $hijo->fecha_nacimiento;
            $this->documento = $hijo->documento;
            $this->discapacitado = $hijo->discapacitado;
        }
    }

    public function save()
    {
        
        $data = $this->validate([
            'personaId' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'documento' => 'required',
            'discapacitado' => 'required',
        ]);

        //Hijo::updateOrCreate(['id' => $this->hijoId], $data);
        Hijo::create([
            'persona_id' => $this->personaId,
            'nombre' => $this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'documento' => $this->documento,
            'discapacitado' => $this->discapacitado
        ]);

        $this->reset(); // Limpia las propiedades públicas
        $this->dispatch('personaUpdated'); // Notifica al padre
    }

    public function render()
    {
        return view('livewire.personas.form-hijo');
    }
}
