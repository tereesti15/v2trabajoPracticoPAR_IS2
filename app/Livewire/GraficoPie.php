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
        // Obtener la última nómina confirmada
        $ultimaNomina = \App\Models\Nomina::confirmadas()
            ->orderByDesc('periodo')
            ->first();

        if (!$ultimaNomina) {
            // Si no hay nómina confirmada, devolvemos sin datos
            return view('livewire.grafico-pie', [
                'categorias1' => [],
                'valores1' => [],
                'porcentajes1' => [],
                'totalSexo' => 0,
                'categorias2' => [],
                'valores2' => [],
                'porcentajes2' => [],
                'tituloGrafico2' => 'Sin datos',
                'totalNomina' => 0
            ]);
        }

        // Obtener detalles de la nómina y agrupar por departamento
        $detalles = $ultimaNomina->detalles()
            ->with(['empleado.departamento', 'concepto'])
            ->get();

        $sumaPorDepartamento = [];

        foreach ($detalles as $detalle) {
            $departamento = $detalle->empleado->nombre_departamento ?? 'Sin departamento';
            $tipo = $detalle->concepto->tipo ?? 'acreditacion';
            $monto = ($tipo === 'acreditacion') 
                ? $detalle->monto_concepto 
                : -1 * $detalle->monto_concepto;

            if (!isset($sumaPorDepartamento[$departamento])) {
                $sumaPorDepartamento[$departamento] = 0;
            }

            $sumaPorDepartamento[$departamento] += $monto;
        }

        // Limpiamos los que tienen valor 0
        $sumaPorDepartamento = array_filter($sumaPorDepartamento, fn($valor) => $valor !== 0);

        $categorias2 = array_keys($sumaPorDepartamento);
        $valores2 = array_values($sumaPorDepartamento);
        $totalNomina = array_sum($valores2);
        $porcentajes2 = array_map(fn($valor) => round($valor * 100 / max($totalNomina, 1), 1), $valores2);

        // El gráfico 1 queda igual (por sexo)
        $conteoSexo = $this->contarPorSexo();
        $categorias1 = array_keys($conteoSexo);
        $valores1 = array_values($conteoSexo);
        $total1 = array_sum($valores1);
        $porcentajes1 = array_map(fn($valor) => round($valor * 100 / max($total1, 1), 1), $valores1);

        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
            4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
            10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];

        // Aseguramos que el periodo es un Carbon
        $periodo = \Carbon\Carbon::parse($ultimaNomina->periodo);

        $tituloGrafico2 = 'Distribución de costos - ' . $meses[$periodo->month] . ' ' . $periodo->year;

        return view('livewire.grafico-pie', [
            'categorias1' => $categorias1,
            'valores1' => $valores1,
            'porcentajes1' => $porcentajes1,
            'totalSexo' => $total1,

            'categorias2' => $categorias2,
            'valores2' => $valores2,
            'porcentajes2' => $porcentajes2,
            'tituloGrafico2' => $tituloGrafico2,
            'totalNomina' => $totalNomina
        ]);
    }
}
