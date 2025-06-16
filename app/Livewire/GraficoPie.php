<?php

namespace App\Livewire;

use Livewire\Component;

final class GraficoPie extends Component
{
    public array $categorias = [];
    public array $valores = [];


    public function mount()
    {
        $this->categorias = ['Acreditaciones', 'Descuentos'];
        $this->valores = [1500, 600];
    }

    public function render()
    {
        $categorias1 = ['Acreditación', 'Descuento'];
        $valores1 = [60, 40];
        $total1 = array_sum($valores1);
        $porcentajes1 = array_map(fn($valor) => round($valor * 100 / $total1, 1), $valores1);

        $categorias2 = ['Horas extras', 'Bonos', 'Multas'];
        $valores2 = [20, 30, 10];
        $total2 = array_sum($valores2);
        $porcentajes2 = array_map(fn($valor) => round($valor * 100 / $total2, 1), $valores2);

        return view('livewire.grafico-pie', [
            'categorias1' => $categorias1,
            'valores1' => $valores1,
            'porcentajes1' => $porcentajes1,

            'categorias2' => $categorias2,
            'valores2' => $valores2,
            'porcentajes2' => $porcentajes2,
        ]);
    }
}
