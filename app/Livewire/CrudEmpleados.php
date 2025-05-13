<?php

namespace App\Livewire;

use Livewire\Component;

class CrudEmpleados extends Component
{
    public function mount()
    {
        abort_if(!auth()->user()->hasRole(['encargado rrhh', 'gerente', 'administrador']), 403);
    }
}
