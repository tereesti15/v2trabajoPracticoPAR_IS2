<?php

namespace App\Livewire;

use Livewire\Component;

final class SidebarNavigation extends Component
{
    public function render()
    {
        return view('livewire.sidebar-navigation', [
            'user' => auth()->user()
        ]);
    }
}
