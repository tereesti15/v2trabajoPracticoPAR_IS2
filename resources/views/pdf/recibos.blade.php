<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibos Salariales</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .card {
            border: 1px solid #000;
            margin-bottom: 20px;
            padding: 10px;
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            padding: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 4px;
        }
        .table th {
            background-color: #eee;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        .firma {
            margin-top: 60px;
            text-align: center;
        }
        .linea-firma {
            border-top: 1px solid #000;
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Recibos Salariales</h2>
</div>

@foreach ($nomina->detalles->groupBy('id_empleado') as $idEmpleado => $detallesEmpleado)
    @php
        $empleado = $detallesEmpleado->first()->empleado;
        $total = $detallesEmpleado->sum('monto_ajustado');
        $periodo = $nomina->periodo;
        $diasMes = \Carbon\Carbon::parse($periodo)->daysInMonth;
    @endphp

    <div class="card">
        <div class="card-header">
            <strong>{{ $nombre_empresa }} - R.U.C. {{ $ruc_empresa }}</strong><br>
            <strong>{{ $empleado->nombre_persona }}</strong><br>
            Documento: {{ $empleado->persona?->documento ?? 'N/D' }}<br>
            {{ $empleado->nombre_cargo }} - {{ $empleado->nombre_departamento }}
        </div>

        <div>
            <p>
                <strong>Periodo:</strong> {{ $nomina->periodo_formateado }} |
                <strong>Días trabajados:</strong> {{ $diasMes }} |
                <strong>Salario Base:</strong> {{ number_format($empleado->salario_base, 0, ',', '.') }} Gs
            </p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Detalle</th>
                        <th style="text-align: right;">Monto (Gs)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detallesEmpleado as $detalle)
                        <tr>
                            <td>{{ $detalle->concepto?->nombre_concepto ?? 'N/A' }}</td>
                            <td>{{ $detalle->detalle_concepto }}</td>
                            <td style="text-align: right;">
                                {{ number_format($detalle->monto_ajustado, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align: right;">Total Neto</th>
                        <th style="text-align: right;">
                            {{ number_format($total, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>

            <div class="firma">
                <div class="linea-firma"></div>
                <div>Firma del funcionario</div>
            </div>
        </div>
    </div>
@endforeach

</body>
</html>
