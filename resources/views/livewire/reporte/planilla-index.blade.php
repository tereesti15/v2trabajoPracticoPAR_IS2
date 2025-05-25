<div class="py-4">
    <div class="row mb-3">
        <div class="col text-center">
            <h4 class="fw-bold">Planilla de Pago de Nómina</h4>
        </div>
    </div>
    <!-- Fila 1 de información adicional -->
    <div class="row mb-2">
        <div class="col-6 text-start">
            <strong>Razón Social del Empleador:</strong> {{ $empresa }}
        </div>
        <div class="col-6 text-end">
            <strong>Mes:</strong> {{ $mes }}
        </div>
    </div>

    <!-- Fila 2 de información adicional -->
    <div class="row mb-3">
        <div class="col-6 text-start">
            <strong>RUC:</strong> {{ $ruc }}
        </div>
        <div class="col-6 text-end">
            <strong>Año:</strong> {{ $anho }}
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead>
                <tr>
                    <th rowspan="2">Nombre</th>
                    <th rowspan="2">Documento</th>
                    <th rowspan="2">Cargo</th>

                    {{-- Agrupador: Tipo de concepto --}}
                    @foreach ($conceptosAgrupados as $tipo => $conceptosDelTipo)
                        <th colspan="{{ count($conceptosDelTipo) + 1 }}"
                            class="bg-{{ $tipo === 'acreditacion' ? 'success' : ($tipo === 'descuento' ? 'danger' : 'secondary') }} text-white">
                            {{ \App\TipoConceptoNomina::tryFrom($tipo)?->label() ?? strtoupper($tipo) }}
                        </th>
                    @endforeach

                    <th rowspan="2" class="bg-primary text-white">Total Neto</th>
                </tr>

                <tr>
                    {{-- Subconceptos bajo cada tipo --}}
                    @foreach ($conceptosAgrupados as $conceptosDelTipo)
                        @foreach ($conceptosDelTipo as $concepto)
                            <th>{{ $concepto->nombre_concepto }}</th>
                        @endforeach
                        <th><strong>Total</strong></th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($resumen as $fila)
                    <tr>
                        <td>{{ $fila['nombre'] }}</td>
                        <td>{{ $fila['documento'] }}</td>
                        <td>{{ $fila['cargo'] }}</td>

                        @foreach ($conceptosAgrupados as $tipo => $conceptosDelTipo)
                            @foreach ($conceptosDelTipo as $concepto)
                                <td>{{ number_format($fila[$tipo][$concepto->nombre_concepto] ?? 0, 0, ',', '.') }}</td>
                            @endforeach
                            <td><strong>{{ number_format($fila[$tipo]['total'] ?? 0, 0, ',', '.') }}</strong></td>
                        @endforeach

                        <td><strong>{{ number_format($fila['total_neto'], 0, ',', '.') }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
