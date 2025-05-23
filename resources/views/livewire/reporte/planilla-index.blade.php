<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Cargo</th>
            @foreach ($conceptos as $concepto)
                <th>{{ $concepto->nombre_concepto }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($resumen as $fila)
            <tr>
                <td>{{ $fila['nombre'] }}</td>
                <td>{{ $fila['documento'] }}</td>
                <td>{{ $fila['cargo'] }}</td>
                @foreach ($conceptos as $concepto)
                    <td>{{ number_format($fila[$concepto->nombre_concepto], 2) }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
