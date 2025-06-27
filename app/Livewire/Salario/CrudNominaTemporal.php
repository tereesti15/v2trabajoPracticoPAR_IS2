<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Models\ConceptoSalario;
use App\Models\NominaMensualTemporal;

final class CrudNominaTemporal extends Component
{

    public $id_registro;
    public $detalle_concepto;
    public $mes_proceso;
    public $anho_proceso;
    public $monto_concepto;
    public $procesado;
    public $id_empleado;
    public $id_concepto;
    public $tipo = 'Descuento';

    public $lista_concepto = [];

    public $mesSeleccionado;
    public $meses = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];

    public function save()
    {
        $data = $this->validate([
            'id_concepto' => 'required|exists:concepto_salario,id_concepto',
            'id_empleado' => 'required',
            'detalle_concepto' => 'required',
            'monto_concepto' => 'required|numeric|min:1|max:100000000',
            'mes_proceso' => 'required|numeric|min:1|max:12',
            'anho_proceso' => 'required|numeric|min:2020|max:2999',
        ]);

        NominaMensualTemporal::updateOrCreate(['id' => $this->id_registro], $data, );
        $this->reset(); // Limpia las propiedades públicas
        $this->dispatch('closeForm'); // Notifica al padre
    }

    public function mount($id_empleado, $id_registro = null)
    {
        $this->id_empleado = $id_empleado;
        $this->lista_concepto = ConceptoSalario::conceptosDisponiblesParaSelect();
        if($id_registro)
        {
            $dato = NominaMensualTemporal::findOrFail($id_registro);
            $this->id_registro = $id_registro;
            $this->id_concepto = $dato->id_concepto;
            $this->detalle_concepto = $dato->detalle_concepto;
            $this->monto_concepto = $dato->monto_concepto;
            $this->mes_proceso = $dato->mes_proceso;
            $this->anho_proceso = $dato->anho_proceso;
        }
    }

    public function render()
    {
        return view('livewire.salario.crud-nomina-temporal');
    }
}
