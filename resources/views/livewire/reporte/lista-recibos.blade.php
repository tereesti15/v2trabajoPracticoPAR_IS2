<div class="container my-4">
    <h2 class="mb-4">
        Recibos Salariales
    </h2>

    @foreach ($nomina->detalles->groupBy('id_empleado') as $idEmpleado => $detallesEmpleado)
        @php
            $empleado = $detallesEmpleado->first()->empleado;
            $total = $detallesEmpleado->sum('monto_ajustado');

            // Calcular cantidad de días del mes del periodo
            $periodo = $nomina->periodo; // instancia Carbon o string de fecha
            $diasMes = \Carbon\Carbon::parse($periodo)->daysInMonth;
        @endphp

        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    {{ $nombre_empresa }} R.U.C. {{ $ruc_empresa }} <br>
                    {{ $empleado->nombre_persona }}  
                    <small class="d-block">
                        Documento: {{ $empleado->persona?->documento ?? 'N/D' }} <br>
                        {{ $empleado->nombre_cargo }} - {{ $empleado->nombre_departamento }}
                    </small>
                </h5>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <strong>Salario Base:</strong> {{ number_format($empleado->salario_base, 0, ',', '.') }} Gs
                    </div>
                    <div class="col">
                        <strong>Periodo:</strong> {{ $nomina->periodo_formateado }}
                    </div>
                    <div class="col">
                        <strong>Días trabajados:</strong> {{ $diasMes }}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Concepto</th>
                                <th>Detalle</th>
                                <th class="text-end">Monto (Gs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detallesEmpleado as $detalle)
                                <tr>
                                    <td>{{ $detalle->concepto?->nombre_concepto ?? 'N/A' }}</td>
                                    <td>{{ $detalle->detalle_concepto }}</td>
                                    <td class="text-end">
                                        {{ number_format($detalle->monto_ajustado, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <th colspan="2" class="text-end">Total Neto</th>
                                <th class="text-end">
                                    {{ number_format($total, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
