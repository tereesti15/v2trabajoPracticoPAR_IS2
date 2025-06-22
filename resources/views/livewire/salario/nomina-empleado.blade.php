<div class="container my-4">
    
    @if ($setSalarioFijo)
        @livewire('salario.form-nomina-salario-fijo', ['id_empleado' => $empleadoId, 'id_registro' => $id_registro_fijo], key($empleadoId))
    @elseif ($setSalarioCuota)
        @livewire('salario.form-salario-cuota', ['id_empleado' => $empleadoId, 'id_registro' => $idSalarioCuota], key($empleadoId))
    @else
        <h3>Gestión de Nómina para: {{ $empleado->nombre_persona }}</h3>

        <div class="accordion my-3" id="accordionNomina">
            
            {{-- Sección Adicional Fijo --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSalarioFijo">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdicional">
                        Conceptos Adicionales Fijos
                    </button>
                </h2>
                <div id="collapseAdicional" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <p>Estos conceptos representan montos fijos aplicados al salario del empleado.</p>
                        <button class="btn btn-success mt-2" wire:click="showSalarioFijo({{ $empleado->id_empleado }})">Agregar Concepto</button>
                        <!-- Tabla para mostrar los conceptos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Detalle Concepto</th>
                                    <th scope="col">Importe</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conceptoSalarialesFijos as $item)
                                    <tr>
                                        <td>{{ $item->detalle_concepto }}</td>
                                        <td>{{ number_format($item->importe, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" wire:click="actualizarRegistro({{ $item->id }})">Modificar</button>
                                            <button class="btn btn-sm btn-danger" wire:click="eliminarRegistroFijo({{ $item->id }})">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>

            {{-- Sección Descuentos por cuota --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSalarioPorCuota">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePorCuota">
                        Conceptos que se descontaran por cuotas
                    </button>
                </h2>
                <div id="collapsePorCuota" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <p>Estos conceptos representan montos que se descontaran en forma de cuotas fijas al empleado.</p>
                        <!-- Botón para agregar un nuevo concepto -->
                        <button class="btn btn-success mt-2" wire:click="showSalarioCuota({{ $empleado->id_empleado }})">Agregar Concepto</button>
                        <!-- Tabla para mostrar los conceptos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Detalle Concepto</th>
                                    <th scope="col">Cuotas</th>
                                    <th scope="col">Importe</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salarioCuota as $item)
                                    <tr>
                                        <td>{{ $item->detalle_concepto }}</td>
                                        <td>{{ $item->nro_cuota }}/{{ $item->cant_cuota }}</td>
                                        <td>Gs. {{ number_format($item->monto_concepto, 0, ',', '.' ) }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" wire:click="editSalarioCuota({{ $item->id }})">Modificar</button>
                                            <button class="btn btn-sm btn-danger" wire:click="borrarSalarioCuota({{ $item->id }})">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
</div>

{{-- Scripts --}}
@push('scripts')
<script>
    window.addEventListener('mostrarModal', () => {
        let modal = new bootstrap.Modal(document.getElementById('modalAgregar'));
        modal.show();
    });

    window.addEventListener('cerrarModal', () => {
        let modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregar'));
        modal.hide();
    });
</script>
@endpush