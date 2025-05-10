<?php

namespace App\Livewire;

use Livewire\Component;

final class DashboardPanel extends Component
{

    public string $vistaActiva = 'empleado-crud';
    public string $mensaje = '';
    public string $tipo_alerta = 'success';

    public $activeComponent = 'empleado-crud';
    protected $listeners = ['cambiarVista' => 'cambiarVista'];

    public function cambiarVista($vista, $mensaje = '', $tipo = 'success')
    {
        $this->activeComponent = $vista;
        $this->mensaje = $mensaje;
        $this->tipo_alerta = $tipo;
    }

    /*
    public function cambiarVista($vista)
    {
        $this->activeComponent = $vista;
    }
*/
    public function render()
    {
        return view('livewire.dashboard-panel');
    }
}
