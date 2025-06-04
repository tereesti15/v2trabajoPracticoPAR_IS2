<div class="container my-4">
    <h3>Detalle de nomina para el periodo: {{ $periodo }}</h3>
    <div class="accordion" id="accordionNomina">
        @foreach($empleadosNomina as $index => $empleado)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    @php
                        $total = $empleado['total_acreditacion'] - $empleado['total_descuento'];
                        $claseTotal = $total >= 0 ? 'bg-success' : 'bg-danger';
                    @endphp
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        <div class="container-fluid d-flex justify-content-between align-items-center px-0">
                            <div class="text-start">
                                {{ $empleado['id_empleado'] }} - {{ $empleado['nombre'] }}
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $claseTotal }} fw-bold">
                                    Total a cobrar Gs. {{ number_format($total, 0, '.', ',') }}
                                </span>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}">
                    <div class="accordion-body">
                        @if(count($empleado['detalles']) > 0)
                            <ul class="list-group">
                                @foreach($empleado['detalles'] as $detalle)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $detalle['nombre_concepto']}} - {{ $detalle['detalle_concepto'] }}
                                        @if ($detalle['tipo'] == 'acreditacion')
                                            <span class="badge bg-primary bg-success fw-bold">Gs. {{ number_format($detalle['monto_concepto'], 0, '.', ',') }}</span>
                                        @else
                                            <span class="badge bg-primary bg-danger fw-bold">Gs. {{ number_format($detalle['monto_concepto'], 0, '.', ',') }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay detalles disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>




































