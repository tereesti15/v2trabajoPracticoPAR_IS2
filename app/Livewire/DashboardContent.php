<?php

namespace App\Livewire;

use Livewire\Component;

final class DashboardContent extends Component
{
    public $currentView = 'home';

    protected $listeners = ['navigate' => 'loadView'];

    public function loadView($view)
    {
        $this->currentView = $view;
    }

    public function render()
    {
        return view('livewire.dashboard-content');
    }
}
