<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hijo;

final class HijosCrud extends Component
{
    public $hijos = [];

    public function mount()
    {
        $this->hijos = Hijo::with('persona')->get()->toArray();
    }

    public function delete($id)
    {
        Hijo::destroy($id);
        $this->hijos = Hijo::with('persona')->get()->toArray();
        session()->flash('message', 'Hijo eliminado correctamente');
    }

    public function render()
    {
        return view('livewire.hijos-crud');
    }
}
