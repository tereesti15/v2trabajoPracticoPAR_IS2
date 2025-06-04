<?php

namespace App\Livewire\Config;

use Livewire\Component;
use App\Models\ConceptoSalario;
use App\TipoConceptoNomina;
use Illuminate\Validation\Rules\Enum;

final class SalarioConceptoForm extends Component
{

    public $id_concepto;
    public $nombre_concepto;
    public $tipo;
    public $agrupador;
    public $nro_orden;

    public $conceptos_salariales = [];
    public $tipo_concepto = [];
    
    public function mount($id_concepto = null)
    {
        \Log::info("SalarioConceptoForm ->  mount id " . $id_concepto);
        if($id_concepto) {
            $concepto = ConceptoSalario::findOrFail($id_concepto);
            \Log::info("SalarioConceptoForm ->  mount concepto " . $concepto);
            $this->nombre_concepto = $concepto->nombre_concepto;
            $this->tipo = $concepto->tipo;
            $this->agrupador = $concepto->agrupador;
            $this->nro_orden = $concepto->nro_orden;

        } else {
             $this->conceptos_salariales = ConceptoSalario::orderBy('nombre_concepto')->get();

            // Convierte el enum en un array asociativo
            
        }

        $this->tipo_concepto = collect(TipoConceptoNomina::cases())
                ->mapWithKeys(fn($case) => [$case->value => ucfirst($case->name)])
                ->toArray();
    }

    public function save()
    {
        $data = $this->validate([
            'nombre_concepto' => 'required',
            'tipo' => ['required', new Enum(TipoConceptoNomina::class)],
            'agrupador' => 'required',
            'nro_orden' => 'required|integer|min:0|max:100',
        ]);
        ConceptoSalario::updateOrCreate(['id_concepto' => $this->id_concepto], $data);

        $this->reset(); // Limpia las propiedades públicas
        $this->dispatch('conceptoSalarioUpdated'); // Notifica al padre
    }

    public function render()
    {
        return view('livewire.config.salario-concepto-form');
    }
}
