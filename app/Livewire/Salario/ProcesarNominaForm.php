<?php

namespace App\Livewire\Salario;

use Livewire\Component;
use App\Services\NominaService;
use App\Models\NominaAdicionalFijo;

final class ProcesarNominaForm extends Component
{

    private $nominaService;

    public $mesSeleccionado;
    public $anho, $mes;

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
            'anho' => 'required',
            'mes' => 'required'
        ]);
        $this->nominaService = new NominaService();
        $this->nominaService->procesarPlanilla($data['mes'], $data['anho']);
    }

    public function mount()
    {
        $this->nominaService = new NominaService();
    }

    public function render()
    {
        return view('livewire.salario.procesar-nomina-form');
    }
}
