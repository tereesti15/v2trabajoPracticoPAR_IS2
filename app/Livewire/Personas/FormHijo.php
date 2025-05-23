<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Hijo;

final class FormHijo extends Component
{
    public $hijoId, $personaId;
    public $persona_id;
    public $nombre, $fecha_nacimiento, $documento, $discapacitado;
    public $successMessage = null;
    public $errorMessage = null;


    public function mount($hijoId = null, $personaId)
    {
        $this->personaId = $personaId;
        if ($hijoId) {
            $hijo = Hijo::findOrFail($hijoId);
            
            $this->hijoId = $hijoId;
            $this->nombre = $hijo->nombre;
            $this->fecha_nacimiento = $hijo->fecha_nacimiento;
            // FORMATO COMPATIBLE CON <input type="date">
            //$this->fecha_nacimiento = \Carbon\Carbon::parse($hijo->fecha_nacimiento)->format('dd-mm-yyyy');
            $this->documento = $hijo->documento;
            $this->discapacitado = $hijo->discapacitado;
        }
    }

    public function save()
    {
       try { 
            $data = $this->validate([
                //'personaId' => 'required',
                'nombre' => 'required',
                'fecha_nacimiento' => 'required',
                'documento' => 'required',
                'discapacitado' => 'required',
            ]);

            Hijo::updateOrCreate(['id' => $this->hijoId], [
            'persona_id' => $this->personaId,  // <-- Esto es importante
            'nombre' => $data['nombre'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'documento' => $data['documento'],
            'discapacitado' => $data['discapacitado'], // si estás usando este campo
            ]);
        /*
        Hijo::create([
            'persona_id' => $this->personaId,
            'nombre' => $this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'documento' => $this->documento,
            'discapacitado' => $this->discapacitado
        ]);
        */

            $this->reset(['nombre', 'fecha_nacimiento', 'documento', 'discapacitado', 'hijoId']); // Limpia las propiedades públicas
            $this->successMessage = 'Hijo guardado exitosamente.';
            $this->errorMessage = null;
            $this->dispatch('hijoCreate'); // Notifica al padre
        
        } catch (\Exception $e) {
        $this->errorMessage = 'Ocurrió un error inesperado al guardar el hijo.';
        $this->successMessage = null;
        // Opcional: puedes registrar el error para depuración
        // \Log::error($e);
    }

    }

    

    public function render()
    {
        return view('livewire.personas.form-hijo');
    }
}
