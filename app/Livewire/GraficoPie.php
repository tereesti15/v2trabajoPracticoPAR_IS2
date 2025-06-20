<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleados;

final class GraficoPie extends Component
{
    public array $categorias = [];
    public array $valores = [];

    public function mount()
    {
        // Opcionalmente podés dejar esto vacío si todo se maneja en render()
    }

    public function contarPorSexo(): array
    {
        return Empleados::with('persona')
            ->get()
            ->groupBy(fn($empleado) => $empleado->persona->sexo)
            ->map(fn($grupo) => $grupo->count())
            ->toArray();
    }

    public function render()
    {
        $conteoSexo = $this->contarPorSexo();

        $categorias1 = array_keys($conteoSexo);
        $valores1 = array_values($conteoSexo);
        $total1 = array_sum($valores1);
        $porcentajes1 = array_map(fn($valor) => round($valor * 100 / max($total1, 1), 1), $valores1);

        $categorias2 = ['Horas extras', 'Bonos', 'Multas'];
        $valores2 = [20, 30, 10];
        $total2 = array_sum($valores2);
        $porcentajes2 = array_map(fn($valor) => round($valor * 100 / max($total2, 1), 1), $valores2);

        return view('livewire.grafico-pie', [
            'categorias1' => $categorias1,
            'valores1' => $valores1,
            'porcentajes1' => $porcentajes1,
            'totalSexo' => $total1, // 👈 Aquí está el totalizador

            'categorias2' => $categorias2,
            'valores2' => $valores2,
            'porcentajes2' => $porcentajes2,
        ]);
    }

}
