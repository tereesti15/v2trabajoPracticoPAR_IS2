<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Services\EmpleadoService;

final class Index extends Component
{
    public $showForm = false;
    public $empleadoIdToEdit = null;
    public $empleados = [];
    private $empleadoService;

    public $showSalary = false;
    public $empleadoIdForSalary = null;

    //protected string $layout = 'livewire.layouts.app';

    //protected $listeners = ['personaUpdated' => '$refresh'];
    protected $listeners = ['empleadoUpdated' => 'handleEmpleadoUpdated'];

    public function handleEmpleadoUpdated()
    {
        $this->showForm = false; // Cierra el formulario
        $this->reloadEmpleado();
    }

    public function edit($id)
    {
        $this->empleadoIdToEdit = $id;
        $this->showForm = true;
    }

    public function create()
    {
        $this->empleadoIdToEdit = null;
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->reloadEmpleado();
    }

    public function delete($id)
    {
        $this->empleadoService = new EmpleadoService();
        $this->empleadoService->delete($id);
        $this->reloadEmpleado();
    }

    public function reloadEmpleado()
    {
        $this->empleadoService = new EmpleadoService();
        $this->empleados = $this->empleadoService->index();
    }

    public function mount()
    {
        $this->reloadEmpleado();
    }

    public function editSalaryParameter($idEmpleado)
    {
        $this->empleadoIdForSalary = $idEmpleado;
        $this->showSalary = true;
        $this->showForm = false; // Cerrar formulario si estaba abierto
    }

    public function closeSalaryView()
    {
        $this->showSalary = false;
        $this->empleadoIdForSalary = null;
        $this->showSalary = false;
    }

    public function render()
    {
        return view('livewire.empleados.index')->layout('layouts.app');
    }
}