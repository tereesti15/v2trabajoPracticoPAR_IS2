<div class="container mt-4">
    <div class="row">
        {{-- Primer gráfico --}}
        <div class="col-md-6 text-start">
            <h5>Distribuci&oacute;n por sexo</h5>
            <p><strong>Total empleados:</strong> {{ $totalSexo }}</p>
            <canvas id="graficoTorta1" width="300" height="300"></canvas>

            {{-- Etiquetas con porcentaje --}}
            <ul class="mt-3 list-unstyled text-start">
                @foreach ($categorias1 as $i => $cat)
                    <li>
                        <span style="display:inline-block; width:12px; height:12px; background-color: {{ ['#4bc0c0','#ff6384','#ffce56','#9966ff','#36a2eb'][$i] ?? '#000' }}; margin-right:8px;"></span>
                        {{ $cat }}: <strong>{{ $porcentajes1[$i] }}%</strong>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Segundo gráfico --}}
        <div class="col-md-6 text-start">
            <h5>{{ $tituloGrafico2 }}</h5>
            <p><strong>Total nómina:</strong> ${{ number_format($totalNomina, 2) }}</p>
            <canvas id="graficoTorta2" width="300" height="300"></canvas>

            <ul class="mt-3 list-unstyled text-start">
                @foreach ($categorias2 as $i => $cat)
                    <li>
                        <span style="display:inline-block; width:12px; height:12px; background-color: {{ ['#4bc0c0','#ff6384','#ffce56','#9966ff','#36a2eb'][$i] ?? '#000' }}; margin-right:8px;"></span>
                        {{ $cat }}: <strong>{{ $porcentajes2[$i] }}%</strong>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>

@push('scripts')
    {{-- Carga de Chart.js desde CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const crearTorta = (canvasId, labels, data) => {
                const canvas = document.getElementById(canvasId);
                if (!canvas) {
                    console.warn(`Canvas ${canvasId} no encontrado`);
                    return;
                }

                const ctx = canvas.getContext('2d');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                display: true
                            },
                            title: {
                                display: true,
                            }
                        }
                    }
                });
            };

            // Cargar los gráficos con datos del backend
            crearTorta('graficoTorta1', @json($categorias1), @json($valores1));
            crearTorta('graficoTorta2', @json($categorias2), @json($valores2));
        });
    </script>
@endpush
