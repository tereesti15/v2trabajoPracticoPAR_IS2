<div class="container my-4">
    
    @if ($setFormPorcentajeSalarioBase)
        @livewire('salario.form-porcentaje-salario-base', ['id_empleado' => $empleadoId], key($empleadoId))
    @elseif ($setSalarioFijo)
        @livewire('salario.form-nomina-salario-fijo', ['id_empleado' => $empleadoId], key($empleadoId))
    @else
        <h3>Gestión de Nómina para: {{ $empleado->nombre_persona }}</h3>

        <div class="accordion my-3" id="accordionNomina">
            {{-- Sección Porcentaje Salario Base --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSalarioPorcentualBase">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePorcentajeBase">
                        Conceptos en porcentaje sobre salario base
                    </button>
                </h2>
                <div id="collapsePorcentajeBase" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <p>Estos conceptos representan montos en porcentaje aplicados al SALARIO BASE del empleado.</p>

                        <!-- Tabla para mostrar los conceptos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Detalle Concepto</th>
                                    <th scope="col">Porcentaje</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($porcentualesSalarioBase as $item)
                                    <tr>
                                        <td>{{ $item->detalle_concepto }}</td>
                                        <td>{{ $item->porcentaje }}%</td> <!-- Mostrar el porcentaje seguido de '%' -->
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" wire:click="">Modificar</button>
                                            <button class="btn btn-sm btn-danger" wire:click="">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Botón para agregar un nuevo concepto -->
                        <button class="btn btn-success mt-2" wire:click="showPorcentajeSalarioBase({{ $empleado->id_empleado }})">Agregar Concepto</button>
                    </div>
                </div>
            </div>

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
                                        <td>{{ number_format($item->importe, 0, ',', '.') }}</td> <!-- Mostrar el porcentaje seguido de '%' -->
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" wire:click="">Modificar</button>
                                            <button class="btn btn-sm btn-danger" wire:click="">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-success mt-2" wire:click="showSalarioFijo({{ $empleado->id_empleado }})">Agregar Concepto</button>
                    </div>
                </div>
            </div>

            {{-- Sección Porcentual Mínimo --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPorcentual">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePorcentual">
                        Conceptos Porcentuales Mínimos
                    </button>
                </h2>
                <div id="collapsePorcentual" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <p>Estos conceptos se aplican como un porcentaje sobre el salario base del empleado.</p>

                        <ul class="list-group">
                            @foreach($porcentuales as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->concepto->titulo ?? 'Concepto' }}
                                    <input type="number" step="0.01" class="form-control w-25" wire:model.defer="porcentuales.{{ $loop->index }}.porcentaje">
                                    <div>
                                        <button class="btn btn-sm btn-primary">Modificar</button>
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <button class="btn btn-success mt-2" wire:click="abrirModalAgregar('porcentual')">Agregar Concepto</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para agregar concepto --}}
        <div wire:ignore.self class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="agregarConcepto">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Concepto {{ $modalSection }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label>Concepto Salarial</label>
                            <select class="form-select" wire:model="nuevoConcepto.id_concepto">
                                <option value="">Seleccione...</option>
                                @foreach($conceptos as $concepto)
                                    <option value="{{ $concepto->id_concepto }}">{{ $concepto->titulo }}</option>
                                @endforeach
                            </select>

                            <label class="mt-3">Monto (importe o %)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="nuevoConcepto.monto">

                            <small class="text-muted d-block mt-2">
                                Aquí va una breve descripción del concepto seleccionado para que el usuario entienda su función.
                            </small>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
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