<?php

namespace App\Livewire\Reporte;

use Livewire\Component;
use App\Models\Nomina;

class ListaPlanillaIndex extends Component
{

    public $showRecibo = false;
    public $verificarPlanilla = false;
    public $id_planilla_procesada;

    public $lista_planilla = [];

    public function recibos($id)
    {
        $this->id_planilla_procesada = $id;
        $this->showRecibo = true;
    }

    private function refrescaDatos()
    {
        $this->lista_planilla = Nomina::confirmadas()
            ->orderBy('periodo', 'desc')
            ->get();
    }

    public function visualizar($id)
    {
        \Log::info('ENTRA PEDIDO PLANILLA ' . $id);
        $this->id_planilla_procesada = $id;
        $this->verificarPlanilla = true;
    }

    public function closeForm()
    {
        $this->verificarPlanilla = false;
    }

    public function closeListaRecibo()
    {
        $this->showRecibo = false;
    }

    public function mount()
    {
        $this->refrescaDatos();
    }

    public function render()
    {
        return view('livewire.reporte.lista-planilla-index')->layout('layouts.app');
    }
}
