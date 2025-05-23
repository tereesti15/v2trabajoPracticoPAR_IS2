<div class="container my-4">
    <h3>Detalle de nomina para el periodo: {{ $periodo }}</h3>


    <div class="accordion" id="accordionNomina">
        @foreach($empleadosNomina as $index => $empleado)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        Empleado #{{ $empleado['id_empleado'] }} - {{ $empleado['nombre'] }} Total a cobrar {{ $empleado['total_acreditacion'] - $empleado['total_descuento'] }}
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}">
                    <div class="accordion-body">
                        @if(count($empleado['detalles']) > 0)
                            <ul class="list-group">
                                @foreach($empleado['detalles'] as $detalle)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $detalle['detalle_concepto'] }}
                                        <span class="badge bg-primary rounded-pill">${{ number_format($detalle['monto_concepto'], 2) }}</span>
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




































