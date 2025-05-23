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

    public $hijoIdActualizar;
    protected $listeners = ['hijoCreate' => 'closeForm'];

    public function closeForm()
    {
        $this->showForm = false;
        $this->reset(['hijoIdActualizar']);
        $this->loadHijos(); // Si tienes un método que vuelve a cargar la lista actualizada
    }

    public function loadHijos()
    {
        $this->listaHijos = Hijo::where('persona_id', $this->personaId)->get();
    }


    public function create()
    {
        $this->hijoIdActualizar = null;
        $this->showForm = true;
    }

     public function mount($personaId = null)
    {
        \Log::info("IndexHijos -> mount " . $personaId );
       
        if ($personaId) {
            $this->personaId = $personaId;
            //$this->listaHijos = Hijo::where('persona_id', $personaId)->get();
            $this->loadHijos();
        }
    }

    public function delete($id)
    {
        Hijo::destroy($id);
        $this->loadHijos();
    }

    public function edit($id)
    {
        $this->hijoIdActualizar = $id;
        $this->showForm = true;
    }

    public function render()
    {
        return view('livewire.personas.index-hijos');
    }
}
