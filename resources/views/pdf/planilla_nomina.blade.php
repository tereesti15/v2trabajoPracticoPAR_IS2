<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Planilla de Pago de Nómina</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #333;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .bg-success { background-color: #28a745 !important; color: white; }
        .bg-danger { background-color: #dc3545 !important; color: white; }
        .bg-primary { background-color: #007bff !important; color: white; }
        .text-start { text-align: left; }
        .text-end { text-align: right; }
    </style>
</head>
<body>
    <div style="padding-bottom: 1rem;">
        <h4 style="text-align: center; font-weight: bold;">Planilla de Pago de Nómina</h4>
        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
            <div><strong>Razón Social del Empleador:</strong> {{ $empresa }}</div>
            <div><strong>RUC:</strong> {{ $ruc }}</div>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <div><strong>Mes:</strong> {{ $mes }}</div>
            <div><strong>Año:</strong> {{ $anho }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Apellido, Nombre</th>
                <th rowspan="2">Documento</th>
                <th rowspan="2">Cargo</th>
                @foreach ($conceptosAgrupados as $tipo => $conceptosDelTipo)
                    <th colspan="{{ count($conceptosDelTipo) + 1 }}"
                        class="{{ $tipo === 'acreditacion' ? 'bg-success' : ($tipo === 'descuento' ? 'bg-danger' : '') }}">
                        {{ \App\TipoConceptoNomina::tryFrom($tipo)?->label() ?? strtoupper($tipo) }}
                    </th>
                @endforeach
                <th rowspan="2" class="bg-primary">Total Neto</th>
            </tr>
            <tr>
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
                    <td class="text-start">{{ $fila['nombre'] }}</td>
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
</body>
</html>
