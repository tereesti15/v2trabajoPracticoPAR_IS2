<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Services\NominaService;

final class ProcesarIndex extends Component
{
    public $showForm;
    public $planilla_procesada;
    public $lista_planilla = [];
    
    private $nominaService;

    public function create()
    {
        $this->showForm = true;
    }

    public function mount()
    {
        $this->nominaService = new NominaService();
        $this->fill_data();
    }

    private function fill_data()
    {
        $this->lista_planilla = $this->nominaService->obtenerListadoNominas();
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.salario.procesar-index')->layout('layouts.app');
    }
}
