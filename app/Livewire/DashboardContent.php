<?php

namespace App\Livewire;

use Livewire\Component;
use ArielMejiaDev\LarapexCharts\LarapexChart;

final class DashboardContent extends Component
{
    public $currentView = 'home';

    protected $listeners = ['navigate' => 'loadView'];

    public function loadView($view)
    {
        $this->currentView = $view;
    }

    public function pie()
    {
        // Datos de ejemplo
        $categorias = ['Ventas', 'Gastos', 'Beneficios'];
        $valores    = [1200, 800, 400];

        $chart = (new LarapexChart)
            ->pieChart()
            ->setTitle('Resumen financiero')
            ->setLabels($categorias)
            ->setDataset($valores);

        return view('reports.pie', compact('chart'));
    }
    
    public function render()
    {
        return view('livewire.dashboard-content');
    }
}
