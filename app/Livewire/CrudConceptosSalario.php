<?php

namespace App\Livewire;

use Livewire\Component;

class CrudConceptosSalario extends Component
{
    public function mount()
    {
        abort_if(!auth()->user()->hasRole(['gerente', 'administrador']), 403);
    }
}
