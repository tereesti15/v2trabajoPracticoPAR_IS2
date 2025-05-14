<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Personas;

final class Index extends Component
{
    public $showForm = false;
    public $personaIdToEdit = null;
    protected string $layout = 'livewire.layouts.app';

    protected $listeners = ['personaUpdated' => '$refresh'];

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
    }

    public function delete($id)
    {
        Personas::destroy($id);
    }

    public function render()
    {
        return view('livewire.personas.index', [
            'personas' => Personas::all(),
        ])->layout('layouts.app');
    }
}
