<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;

final class PersonaCrud extends Component
{
    public $personas = [];

    public function mount()
    {
        $this->personas = Personas::all()->toArray();
    }

    public function delete($id)
    {
        Personas::destroy($id);
        $this->personas = Personas::all()->toArray();
        session()->flash('message', 'Persona eliminada correctamente');
    }

    public function render()
    {
        return view('livewire.persona-crud');
    }
}
