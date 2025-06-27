<div class="accordion my-3" id="accordionNomina">

    {{-- Sección Adicional Variables --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSalarioTemporal">
            <button class="accordion-button collapsed" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#collapseAdicionalTemporal" 
                    aria-expanded="false" aria-controls="collapseAdicionalTemporal">
                Conceptos Adicionales Variables
            </button>
        </h2>
        <div id="collapseAdicionalTemporal" class="accordion-collapse collapse" 
             aria-labelledby="headingSalarioTemporal">
            <div class="accordion-body">
                <p>Estos conceptos representan montos temporales aplicados al salario del empleado.</p>
                <button class="btn btn-success mt-2" wire:click="showSalarioTemporal({{ $empleado->id_empleado }})">Agregar Concepto</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Detalle</th>
                            <th>Periodo</th>
                            <th>Procesado</th>
                            <th>Importe</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_conceptos_mensuales_temporales as $item)
                            <tr>
                                <td>{{ $item->concepto->nombre_concepto }}({{ $item->concepto->tipo }})</td>
                                <td>{{ $item->detalle_concepto }}</td>
                                <td>{{ $item->mes_proceso }}/{{ $item->anho_proceso }}</td>
                                <td>@if($item->procesado == 0) No @else Si @endif</td>
                                <td>{{ number_format($item->monto_concepto, 0, ',', '.') }}</td>
                                <td>
                                    @if(!$item->procesado)
                                        <button class="btn btn-sm btn-warning" wire:click="editConceptoTemporal({{ $item->id }})">Editar</button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteConceptoTemporal({{ $item->id }})">Eliminar</button>
                                    @else
                                        Registro procesado
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                        
            </div>
        </div>
    </div>

    {{-- Sección Adicional Fijo --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSalarioFijo">
            <button class="accordion-button collapsed" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#collapseAdicionalFijo" 
                    aria-expanded="false" aria-controls="collapseAdicionalFijo">
                Conceptos Adicionales Fijos
            </button>
        </h2>
        <div id="collapseAdicionalFijo" class="accordion-collapse collapse" 
             aria-labelledby="headingSalarioFijo">
            <div class="accordion-body">
                <p>Estos conceptos representan montos fijos aplicados al salario del empleado.</p>
                <button class="btn btn-success mt-2" wire:click="showSalarioFijo({{ $empleado->id_empleado }})">Agregar Concepto</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>&nbsp;</th>
                            <th>Importe</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conceptoSalarialesFijos as $item)
                            <tr>
                                <td>{{ $item->detalle_concepto }}</td>
                                <td>&nbsp;</td>
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
            <button class="accordion-button collapsed" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#collapsePorCuota" 
                    aria-expanded="false" aria-controls="collapsePorCuota">
                Conceptos que se descontaran por cuotas
            </button>
        </h2>
        <div id="collapsePorCuota" class="accordion-collapse collapse" 
             aria-labelledby="headingSalarioPorCuota">
            <div class="accordion-body">
                <p>Estos conceptos representan montos que se descontaran en forma de cuotas fijas al empleado.</p>
                <button class="btn btn-success mt-2" wire:click="showSalarioCuota({{ $empleado->id_empleado }})">Agregar Concepto</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>&nbsp;</th>
                            <th>Cuotas</th>
                            <th>Importe</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salarioCuota as $item)
                            <tr>
                                <td>{{ $item->detalle_concepto }}</td>
                                <td>&nbsp;</td>
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
