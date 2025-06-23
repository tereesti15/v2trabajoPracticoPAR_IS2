<?php

namespace App\Livewire\Config;

use Livewire\Component;
use App\Models\ConceptoSalario;
use App\TipoConceptoNomina;

final class SalarioConceptoIndex extends Component
{
    public $conceptosSalariales = [];
    public $tipoConcepto = [];
    public $showForm = false;
    public $configToEdit;

    protected $listeners = ['conceptoSalarioUpdated' => 'handleconceptoSalarioUpdated',
                            'cerrarFormulario' => 'closeForm'];

    public function closeForm()
    {
        $this->showForm = false;
        $this->cargarConceptos();
        session()->flash('message', 'Concepto agregado correctamente.');
    }

    public function cargarConceptos()
    {
        $this->conceptosSalariales = ConceptoSalario::orderBy('nombre_concepto', 'asc')->get();
        $this->tipoConcepto = collect(TipoConceptoNomina::cases())
            ->mapWithKeys(fn($case) => [$case->value => ucfirst($case->name)])
            ->toArray();
    }

    public function create()
    {
        $this->configToEdit = null;
        $this->showForm = true;
    }

    public function handleconceptoSalarioUpdated()
    {
        $this->showForm = false; // Cierra el formulario
        $this->cargarConceptos();
        session()->flash('message', 'Concepto agregado correctamente.');
    }

    public function delete($id)
    {
        ConceptoSalario::findOrFail($id)->delete();
        $this->cargarConceptos();
    }

    public function edit($id)
    {
        $this->configToEdit = $id;
        $this->showForm = true;
    }

    public function mount()
    {
        $this->cargarConceptos();
    }

    public function render()
    {
        return view('livewire.config.salario-concepto-index')->layout('layouts.app');
    }
}
