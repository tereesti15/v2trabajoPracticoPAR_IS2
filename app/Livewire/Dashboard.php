<?php

namespace App\Livewire;

use Livewire\Component;

final class Dashboard extends Component
{
    public $activeComponent = 'empleado-crud';

    protected $listeners = ['cambiarVista' => 'setVista'];

    public function setVista($vista)
    {
        $this->activeComponent = $vista;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
