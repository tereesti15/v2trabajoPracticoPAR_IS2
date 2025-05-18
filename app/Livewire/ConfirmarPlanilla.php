<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmarPlanilla extends Component
{
    public function mount()
    {
        abort_if(!auth()->user()->hasRole(['gerente', 'administrador']), 403);
    }
}
