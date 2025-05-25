<?php

namespace App\Livewire\Config;

use Livewire\Component;
use App\Models\Parametro as Parametricas;

final class Parametro extends Component
{
    public $nombre_empresa;
    public $ruc;
    public $salario_minimo;
    public $max_salario_minimo_bonif_familiar;
    public $porcentaje_bonificacion_familiar;

    public function save()
    {
        $data = $this->validate([
            'nombre_empresa' => 'required|string',
            'ruc' => 'required|string',
            'salario_minimo' => 'required|numeric|min:1',
            'max_salario_minimo_bonif_familiar' => 'required|min:1',
            'porcentaje_bonificacion_familiar' => 'required',
        ]);

        Parametricas::updateOrCreate(['id_parametro' => 1], $data);
        $this->reloadAllData();
    }

    private function reloadAllData()
    {
        $data = Parametricas::find(1);
        $this->nombre_empresa = $data->nombre_empresa;
        $this->ruc = $data->ruc;
        $this->salario_minimo = $data->salario_minimo;
        $this->max_salario_minimo_bonif_familiar = $data->bonificacion_familiar_max_salario_minimo;
        $this->porcentaje_bonificacion_familiar = $data->bonificacion_familiar_porcentaje;
    }

    public function mount()
    {
        $this->reloadAllData();
    }

    public function render()
    {
        return view('livewire.config.parametro')->layout('layouts.app');
    }
}
