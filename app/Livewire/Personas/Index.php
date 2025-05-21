<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Personas;

final class Index extends Component
{
    public $showForm = false;
    public $personaIdToEdit = null;
    public $personas = [];
    //protected string $layout = 'livewire.layouts.app';

    public $showFormHijos = false;

    //protected $listeners = ['personaUpdated' => '$refresh'];
    protected $listeners = ['personaUpdated' => 'handlePersonaUpdated'];

    public function handlePersonaUpdated()
    {
        $this->showForm = false; // Cierra el formulario
         $this->showFormHijos = false;
    }

    public function abrirHijos($id)
    {
        $this->personaIdToEdit = $id;
        $this->showFormHijos = true;
    }

    public function edit($id)
    {
        $this->personaIdToEdit = $id;
        $this->showForm = true;
    }

    public function create()
    {
        $this->personaIdToEdit = null;
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->showFormHijos = false;
    }

    public function delete($id)
    {
        Personas::destroy($id);
    }

    public function mount()
    {
        $this->personas = Personas::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        \Log::info("App\Livewire\Personas\Index render " . $this->showForm);
        \Log::info("App\Livewire\Personas\Index render " . $this->personas);
        return view('livewire.personas.index')->layout('layouts.app');
    }
}
