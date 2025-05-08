<?php

namespace App\Livewire;

use Livewire\Component;

final class DashboardPanel extends Component
{
    public $activeComponent = 'empleado-crud';

    protected $listeners = ['cambiarVista' => 'cambiarVista'];

    public function cambiarVista($vista)
    {
        $this->activeComponent = $vista;
    }

    public function render()
    {
        return view('livewire.dashboard-panel');
    }
}
