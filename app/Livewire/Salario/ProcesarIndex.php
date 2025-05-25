<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Services\NominaService;

final class ProcesarIndex extends Component
{
    public $showForm;
    public $verificarPlanilla;
    public $planilla_procesada;
    public $lista_planilla = [];
    public $id_nomina;
    
    
    private $nominaService;

    public function visualizar($id)
    {
        $this->id_nomina = $id;
        $this->verificarPlanilla = true;
    }
    
    public function delete($id)
    {
        $this->nominaService = new NominaService();
        $this->nominaService->borrarPlanillaPorId($id);
    }

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
        $this->showForm = false;
        $this->verificarPlanilla = false;
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
